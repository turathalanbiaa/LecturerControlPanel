@extends("layout.main_layout")

@section("title")
    <title>لوحة التحكم - الرسائل</title>
@endsection

@section("content")
    <div class="ui one column grid">
        <div class="column">
            <form class="ui form" method="get" action="/message">
                <div class="inline fields" style="margin-bottom: 0;">
                    <div class="fourteen wide field" style="padding: 0!important;">
                        <div class="ui search selection dropdown" style="width: 100%;">
                            <input type="hidden" name="studentId" id="student_Id">
                            <i class="dropdown icon"></i>
                            <input class="search">
                            <div class="default text">بحث عن طالب ... </div>
                            <div class="menu">
                                @foreach($students as $student)
                                    <div class="item" data-value="{{$student->ID}}">{{$student->Name}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="two wide field">
                        <button type="submit" class="ui positive fluid button" style="margin: 0!important;">اختيار</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="column">
            <div class="ui grid">
                <div class="four wide computer only column">
                    <div class="ui vertical teal fluid  menu" style="max-height: 750px; overflow-y: scroll; overflow-x: hidden;">
                        @foreach($students as $student)
                            <a class="item" href="/message?studentId={{$student->ID}}">
                                {{$student->Name}}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="sixteen wide mobile sixteen wide tablet twelve wide computer stretched column">
                    @if(is_null($currentStudent))
                        <div class="ui segment">
                            <div class="ui dimmer">
                                <div class="content">
                                    <div class="center">
                                        <h2 class="ui inverted icon header">
                                            <i class="comments icon"></i>
                                            <span>أختر جهة لعرض الرسائل</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>$('.ui.dimmer').dimmer('show');</script>
                    @else
                        <div class="ui segment" style="max-height: 686px; overflow-x: hidden; overflow-y: scroll;">
                            @if(count($messages) == 0)
                                <div class="lg-space"></div>
                                <div class="lg-space"></div>
                                <h2 class="ui center aligned icon header">
                                    <i class="comments icon"></i>
                                    <span>لا توجد رسائل سابقه لعرضها</span>
                                </h2>
                            @else
                                <div class="ui list" id="messages-list">
                                    @foreach($messages as $message)
                                        <div class="right item" style="padding-bottom: 5px;">
                                            @if($message->SenderType == 1)
                                                <img class="ui avatar image" src="{{asset("/image/student.png")}}">
                                                <div class="content">
                                                    <a class="header">{{$currentStudent->Name}}</a>
                                                    <div class="description">{{$message->Message}}</div>
                                                </div>
                                            @else
                                                <img class="ui avatar image" src="{{asset("/image/lecturer.jpg")}}">
                                                <div class="content">
                                                    <a class="header">{{$lecturer->Name}}</a>
                                                    <div class="description">{{$message->Message}}</div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div style="max-height: 50px;">
                            <div class="ui big form" dir="rtl">
                                {!! csrf_field() !!}
                                <input type="hidden" name="id" value="{{$currentStudent->ID}}">
                                <div class="inline fields" style="margin: 0;">
                                    <div class="sixteen wide field" style="padding:0;">
                                        <input type="text" name="message" placeholder="اكتب هنا..." style="margin: 0 !important; border-radius: 0 .28571429rem .28571429rem 0;">
                                        <div class="ui positive icon button" id="send-new-message" style="padding: 17px; border-radius: .28571429rem 0 0 .28571429rem;">
                                            <i class="plus icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $('.ui.selection.dropdown').dropdown();
        $('#messages-list').parent().scrollTop($('#messages-list').outerHeight());
        $("#send-new-message").click(function() {
            var _token = $("input[type='hidden'][name='_token']").val();
            var studentId = $("input[type='hidden'][name='id']").val();
            var message = $("input[type='text'][name='message']").val();
            var messageList = $('#messages-list');
            $("#send-new-message").addClass("loading");

            $.ajax({
                type: "POST",
                url: '/send-new-message',
                data: {_token:_token, studentId:studentId, message:message},
                datatype: 'json',
                success: function(result) {
                    if (result["success"] == false)
                        snackbar("لم يتم ارسال الرسالة." , 3000 , "error");

                    else if (result["success"] == true)
                    {
                        var imageItem = "<img class='ui avatar image' src='{{asset("/image/lecturer.jpg")}}'>";
                        var headerContentItem = "<a class='header'> {{$lecturer->Name}} </a>";
                        var descriptionContentItem = "<div class='description'>" + result["message"] + "</div>";
                        var contentItem = "<div class='content'>" + headerContentItem + descriptionContentItem + "</div>";
                        var newItem = "<div class='item'>" + imageItem + contentItem + "</div>";
                        messageList.append(newItem);
                    }
                },
                error: function() {
                    snackbar("تحقق من الاتصال بالانترنت" , 3000 , "error");
                } ,
                complete : function() {
                    $('#messages-list').parent().scrollTop($('#messages-list').outerHeight());
                    $("#send-new-message").removeClass("loading");
                    $("input[type='text'][name='message']").val('');
                }
            });
        });

    </script>
@endsection