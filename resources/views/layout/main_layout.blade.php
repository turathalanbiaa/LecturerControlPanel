<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

@yield("title")

<!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Stylesheet -->
    <link href="{{asset('css/semantic.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/snackbar.css')}}" rel="stylesheet" type="text/css">

    <!-- Script -->
    <script src="{{asset("js/jquery.min.js")}}"></script>
    <script src="{{asset("js/semantic.min.js")}}"></script>
    <script src="{{asset("js/snackbar.js")}}"></script>

    <style>
        #sidebar, #courses-sidebar
        {
            direction: ltr;
        }
    </style>
</head>

<body>
    <div class="ui right vertical inverted sidebar labeled icon menu" id="sidebar">
        <a class="item" href="/">
            <i class="home icon"></i>
            <span>الرئيسية</span>
        </a>
        <a class="item" onclick="$('#courses-sidebar.ui.sidebar').sidebar('toggle');">
            <i class="cubes icon" ></i>
            <span>الدورات</span>
        </a>
        <a class="item" onclick="$('#message-sidebar.ui.sidebar').sidebar('toggle');">
            <i class="mail icon"></i>
            <span>الرسائل</span>
        </a>
    </div>

    <div class="ui right vertical inverted sidebar labeled menu" id="courses-sidebar">
        <div class="item" style="text-align: right;">
            <h3 class="ui inverted header">
                <span>الدورات</span>
            </h3>
            <div class="menu" style="font-size: 16px;">
                <?php $courses = $lecturer->Courses; ?>
                @foreach($courses as $course)
                    <a class="item" href="/course?id={{$course->ID}}" style="text-align: right;">{{$course->Name}}</a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="ui right vertical inverted sidebar labeled menu" id="messages-sidebar">
        <div class="item" style="text-align: right;">
            <h3 class="ui inverted header">
                <span>الطلاب</span>
            </h3>
            <div class="menu" style="font-size: 16px;">
                <?php $courses = $lecturer->Courses; ?>
                @foreach($courses as $course)
                    <a class="item" href="/course?id={{$course->ID}}" style="text-align: right;">{{$course->Name}}</a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="pusher">
        <div class="ui fixed inverted menu">
            <div class="ui container">
                <div class="item">
                    <h3 class="ui large inverted right aligned header">لوحة التحكم - معهد تراث الأنبياء(ع)</h3>
                </div>
                <a class="left item" onclick="$('#sidebar.ui.sidebar').sidebar('toggle');">
                    <div class="ui inverted icon button">
                        <i class="sidebar icon"></i>
                    </div>
                </a>
            </div>
        </div>
        <div class="ui container" style="margin-top: 60px;">
            <div class="ui segment">
                @yield("content")
            </div>
            @yield("extra-content")
        </div>
    </div>
    @yield("script")
</body>
</html>
