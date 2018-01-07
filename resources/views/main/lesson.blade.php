@extends("layout.main_layout")

@section("title")
    <title>لوحة التحكم - {{$course->Name}}</title>
@endsection

@section("content")
    <h3 class="ui right aligned dividing green header">
        <span>{{$course->Name}}</span>
        <span> - </span>
        <span>{{$lesson->Title}}</span>
    </h3>
    <div class="ui right aligned grid">
        <div class="sixteen wide column">
            <div class="ui inverted segment">
                <div class="ui embed" data-source="youtube" data-id="{{$lesson->YoutubeVideoId}}" data-placeholder="{{asset("/image/turath-logo.png")}}">
                    <i class="video play icon" style="background: cadetblue;"></i>
                    <img class="placeholder" src="{{asset("/image/turath-logo.png")}}">
                </div>
            </div>
        </div>
        <div class="sixteen wide column">

            @if(count($comments) == 0)
                <div class="ui large info center aligned message">
                    <p class="ui center aligned header">لاتوجد تعليقات</p>
                </div>
            @else
                <div class="ui segment">
                    <div class="ui form">
                        <div class="field">
                            <div class="ui left icon input">
                                <input class="prompt" type="text" placeholder="Common passwords...">
                                <i class="search icon"></i>
                            </div>

                            <input type="text" name="comment" placeholder="أكتب تعليقك هنا ..." onkeypress="sendComment(event)">
                        </div>
                    </div>

                    <div class="ui divider"></div>

                    <div class="header">
                        <span style="float: right;"><a href="/lesson?id={{$lesson->ID}}&c=ShowPopularComments">ابرز التعليقات</a></span>
                        <span style="float: left;"><a href="/lesson?id={{$lesson->ID}}&c=ShowAllComments">كل التعليقات</a></span>
                    </div>

                    <div class="ui hidden divider"></div><div class="ui hidden divider"></div>

                    <div class="ui relaxed list">
                        @foreach($comments as $comment)
                            @if($comment->Student_ID  != null)
                                <div class="item">
                                    <img class="ui avatar image" src="{{asset("/image/student.png")}}">
                                    <div class="content">
                                        <a class="header">{{$comment->Student->Name}}</a>
                                        <div class="description">{{$comment->Text}}</div>
                                        <div class="description"><a>{{$comment->Time}}</a></div>
                                    </div>
                                </div>
                            @elseif($comment->Lecturer_ID  != null)
                                <div class="item">
                                    <img class="ui avatar image" src="{{asset("/image/lecturer.jpg")}}">
                                    <div class="content">
                                        <a class="header">{{$comment->Lecturer->Name}}</a>
                                        <div class="description">{{$comment->Text}}</div>
                                        <div class="description"><a>{{$comment->Time}}</a></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section("script")
    <script>
        function sendComment(event) {
            var char = event.which || event.keyCode;
            if (char == 13)
            {
                console.log(char)
            }
        }
    </script>
@endsection