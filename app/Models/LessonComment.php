<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonComment extends Model
{
    protected $table = "lesson_comment";
    protected $primaryKey = "ID";
    public $timestamps = false;

    public function Student()
    {
        return $this->hasOne('App\Models\Student', 'ID', 'Student_ID');
    }

    public function Lecturer()
    {
        return $this->hasOne('App\Models\Lecturer', 'ID', 'Lecturer_ID');
    }
}
