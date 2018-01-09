<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Lesson;
use App\Models\LessonComment;
use App\Models\Message;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class MainController extends Controller
{
    public function login()
    {
        if (!self::haveCookie())
            return view("main.login");

        return redirect("/");
    }

    public function loginValidation(Request $request)
    {
        $email = Input::get("email");
        $password = Input::get("password");

        $this->validate($request, [
            'email' => 'required|exists:lecturer,email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'يرجى ادخال البريد الإلكتروني.',
            'email.exists' => 'البريد الإلكتروني غير موجود.',
            'password.required' => 'يرجى أدخال كلمة المرور.',
            'password.min' => 'يجب ان تكون كلمة المرور لاتقل عن 6 حروف.',
        ]);

        $lecturer = Lecturer::where('Email','=', $email)->where('Password','=', md5($password))->first();

        if (!$lecturer)
            return redirect('/login')->with('ErrorRegisterMessage', 'البريد الإلكتروني وكلمة المرور غير متطابقتين.');

        $lecturer->SessionID = md5($lecturer->ID.$lecturer->Email.uniqid());
        $success = $lecturer->save();

        if (!$success)
            return redirect('/login')->with('ErrorRegisterMessage', 'حدثت مشكلة اثناء تسجيل الدخول ! يرجى أعادة المحاولة.');

        self::saveSession($lecturer->ID, $lecturer->Email, $lecturer->SessionID, $lecturer->Name);
        self::setCookie($lecturer->SessionID);

        return redirect("/");
    }

    public function logout()
    {
        $lecturer = Lecturer::where("SessionID", $_COOKIE["SESSION_ID"])->first();
        unset($_SESSION["LECTURER_ID"]);
        unset($_SESSION["SESSION_NAME"]);
        unset($_SESSION["LECTURER_EMAIL"]);
        unset($_SESSION["SESSION_ID"]);
        setcookie("SESSION_ID" , null , time()-3600 , '/');
        $lecturer->SessionID = null;
        $success = $lecturer->save();
        if ($success)
            return redirect("/login");
        return redirect("/");
    }

    public function index()
    {
//            $unwatchedMessages = DB::table('student')
//                ->leftJoin('message', 'student.ID', '=', 'message.Sender')
//                ->where('message.Target',$lecturer->ID)
//                ->where('message.SenderType',1)
//                ->where('message.Watched',0)
//                ->get();

        if (self::haveCookie())
        {
            $lecturer = Lecturer::find($_SESSION["LECTURER_ID"]);

            return view("main.main")->with([
                "lecturer"=>$lecturer
            ]);
        }

        return redirect("/login");
    }

    public function showMessages()
    {
        if (self::haveCookie())
        {
            $lecturer = Lecturer::find($_SESSION["LECTURER_ID"]);
            $students = Student::orderBy("ID","ASC")->get();
            $currentStudent = null;
            $messages = [];

            if (!is_null(Input::get("studentId")))
            {
                $currentStudent = Student::find(Input::get("studentId"));

                $messages = DB::table('message')
                    ->where('Sender',Input::get("studentId"))
                    ->where('Target',$lecturer->ID)
                    ->where('SenderType',1)
                    ->orWhere(function ($query) {
                        $query->where('Sender', $_SESSION["LECTURER_ID"])
                            ->where('Target', Input::get("studentId"))
                            ->where('SenderType',2);
                    })
                    ->orderBy('ID')
                    ->get();
            }

            return view("main.messages")->with([
                "lecturer" => $lecturer,
                "students" => $students,
                "currentStudent" => $currentStudent,
                "messages" => $messages
            ]);
        }

        return redirect("/login");
    }

    public function sendMessage()
    {
        if (self::haveCookie())
        {
            $message = new Message();
            $message->Message = Input::get("message");
            $message->Time = date("Y-m-d h:i:s");
            $message->Sender = $_SESSION["LECTURER_ID"];
            $message->Target = Input::get("studentId");
            $message->SenderType = 2;
            $message->Watched = 0;
            $success = $message->save();

            if (!$success)
                return ["success" => false];

            return ["success" => true, "message"=>Input::get("message")];
        }

        return redirect("/login");
    }

    public function courseInfo()
    {
        if (self::haveCookie())
        {
            $lecturer = Lecturer::find($_SESSION["LECTURER_ID"]);
            $course = Course::find(Input::get("id"));
            $lessons = Lesson::where("Course_ID",Input::get("id"))->orderBy("ID","ASC")->paginate(20);

            return view("main.course")->with(["lecturer"=>$lecturer, "course"=>$course, "lessons"=>$lessons]);
        }

        return redirect("/login");
    }

    public function lessonInfo()
    {
        if (self::haveCookie())
        {
            $lecturer = Lecturer::find($_SESSION["LECTURER_ID"]);
            $lesson = Lesson::find(Input::get("id"));
            $course = Course::find($lesson->Course_ID);

            if (Input::get("c") == "ShowPopularComments")
                $comments = LessonComment::where("Lesson_ID", Input::get("id"))->orderBy("ID","DESC")->take(20)->get();

            if (Input::get("c") == "ShowAllComments")
                $comments = LessonComment::where("Lesson_ID", Input::get("id"))->orderBy("ID","DESC")->get();

            return view("main.lesson")->with(["lecturer"=>$lecturer, "course"=>$course, "lesson"=>$lesson, "comments"=>$comments]);
        }

        return redirect("/login");
    }

    public function sendComment(){
        if (self::haveCookie())
        {
            $lesson = Lesson::find(Input::get("lesson_id"));
            if ($lesson)
            {
                $comment = new LessonComment();
                $comment->Text = Input::get("comment");
                $comment->Lesson_ID = $lesson->ID;
                $comment->Student_ID = null;
                $comment->Lecturer_ID = $_SESSION["LECTURER_ID"];
                $comment->Time = date("Y-m-d h:i:s");
                $success = $comment->save();
                if (!$success)
                    return ["success"=>false];
                return ["success"=>true, "comment"=>$comment];
            }
            return ["lesson"=>"Not Found"];
        }

        return redirect("/login");
    }

    public function deleteComment(){
        if (self::haveCookie())
        {
            $comment = LessonComment::where("ID",Input::get("comment_id"))
                ->where("Lesson_ID",Input::get("lesson_id"))
                ->first();
            if ($comment)
            {
                $success = $comment->delete();
                if (!$success)
                    return ["success"=>false];
                return ["success"=>true];
            }
            return ["comment"=>"Not Found"];
        }

        return redirect("/login");
    }

    public function addQuestion()
    {
        dd(Input::all());
    }

    public static function haveCookie()
    {
        if (isset($_COOKIE["SESSION_ID"]))
            return self::loginWithCookie();
        return false;
    }

    public static function loginWithCookie()
    {
        $lecturer = Lecturer::where("SessionID", $_COOKIE["SESSION_ID"])->first();
        if (!$lecturer)
            return redirect("/login");

        return self::saveSession($lecturer->ID, $lecturer->Email, $lecturer->SessionID, $lecturer->Name);
    }

    public static function saveSession($id, $email, $session, $name)
    {
        $_SESSION["LECTURER_ID"] = $id;
        $_SESSION["LECTURER_NAME"] = $name;
        $_SESSION["LECTURER_EMAIL"] = $email;
        $_SESSION["SESSION_ID"] = $session;
        return true;
    }

    public static function setCookie($session)
    {
        $time = time() + (86400 * 30 * 30);
        $_COOKIE["SESSION_ID"] = $session;
        setcookie("SESSION_ID" , $session , $time , "/");
        return true;
    }
}
