<div class="sixteen wide column">
    <div class="ui segment">
        <div class="ui form">
            <div class="field">
                <div class="ui left icon input">
                    {!! csrf_field() !!}
                    <input type="hidden" name="lesson_id" value="{{$lesson->ID}}">
                    <input type="text" name="comment" placeholder="أكتب تعليقك هنا ..." onkeypress="sendComment(event)" style="text-align: right;">
                    <i class="send icon"></i>
                </div>
            </div>
        </div>

        <div class="ui divider"></div>

        <div class="header">
            <span style="float: right;"><a href="/lesson?id={{$lesson->ID}}&c=ShowPopularComments">ابرز التعليقات</a></span>
            <span style="float: left;"><a href="/lesson?id={{$lesson->ID}}&c=ShowAllComments">كل التعليقات</a></span>
        </div>

        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>

        <div class="ui relaxed list" id="comment-list">
            @if(count($comments) == 0)
                <div class="ui large info center aligned message" id="comment-message">
                    <p class="ui center aligned header">لاتوجد تعليقات</p>
                </div>
            @else
                @foreach($comments as $comment)
                    @if($comment->Student_ID  != null)
                        <div class="item">
                            <img class="ui avatar image" src="{{asset("/image/student.png")}}">
                            <div class="content">
                                <a class="header">{{$comment->Student->Name}}</a>
                                <div class="description">
                                    <span>{{$comment->Text}}</span>
                                    <span><b class="delete-comment" data-action="delete-comment" data-content="{{$comment->ID}}">حذف التعليق</b></span>
                                </div>
                                <div class="description"><b>{{$comment->Time}}</b></div>
                            </div>
                        </div>
                    @elseif($comment->Lecturer_ID  != null)
                        <div class="item">
                            <img class="ui avatar image" src="{{asset("/image/lecturer.jpg")}}">
                            <div class="content">
                                <a class="header">{{$comment->Lecturer->Name}}</a>
                                <div class="description">
                                    <span>{{$comment->Text}}</span>
                                    <span><b class="delete-comment" data-action="delete-comment" data-content="{{$comment->ID}}">حذف التعليق</b></span>
                                </div>
                                <div class="description"><b>{{$comment->Time}}</b></div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>

<script>
    function sendComment(event) {
        var char = event.which || event.keyCode;
        if (char == 13)
        {
            var lesson_id = $("input[type='hidden'][name='lesson_id']").val();
            var _token = $("input[type='hidden'][name='_token']").val();
            var comment = $("input[type='text'][name='comment']").val();

            $.ajax({
                type: "POST",
                url: '/send-new-comment',
                data: {lesson_id:lesson_id, _token:_token, comment:comment},
                datatype: 'json',
                success: function(result) {
                    if (result["lesson"] == "Not Found")
                    {
                        snackbar("حدثت مشكلة ما، قم بتحديث الصفحة.", 3000, "error");
                    }
                    else if (result["success"] == false)
                        snackbar("لم يتم ارسال التعليق، أعد المحاولة." , 3000 , "error");
                    else if (result["success"] == true)
                    {
                        var commentTextDescriptionContentItem = "<span>" + result["comment"]["Text"] + "</span>";
                        var commentActionDescriptionContentItem = "<span>" + "<b class='delete-comment' data-action='delete-comment' data-content='" + result["comment"]["ID"] + "'>" + "حذف التعليق" + "</b>" + "</span>";
                        var commentDescriptionContentItem = "<div class='description'>" + commentTextDescriptionContentItem + commentActionDescriptionContentItem + "</div>";
                        var timeDescriptionContentItem = "<div class='description'><b>" + result["comment"]["Time"] + "</b></div>";
                        var headerContentItem = "<a class='header'> {{$lecturer->Name}} </a>";
                        var contentItem = "<div class='content'>" + headerContentItem + commentDescriptionContentItem + timeDescriptionContentItem + "</div>";
                        var imageItem = "<img class='ui avatar image' src='{{asset("/image/lecturer.jpg")}}'>";
                        var newItem = "<div class='item'>" + imageItem + contentItem + "</div>";
                        $("#comment-list").prepend(newItem);
                    }
                },
                error: function() {
                    snackbar("تحقق من الاتصال بالانترنت" , 3000 , "error");
                } ,
                complete : function() {
                    $("input[type='text'][name='comment']").val('');
                    $("#comment-message").css({"display":"none"});
                }
            });
        }
    }

    $('b[data-action="delete-comment"]').click(function() {
        var lesson_id = $("input[type='hidden'][name='lesson_id']").val();
        var _token = $("input[type='hidden'][name='_token']").val();
        var comment_id = $(this).data("content");
        var item = $(this).parent().parent().parent().parent();
        $.ajax({
            type: "POST",
            url: '/delete-comment',
            data: {lesson_id:lesson_id, _token:_token, comment_id:comment_id},
            datatype: 'json',
            success: function(result) {
                if (result["comment"] == "Not Found")
                {
                    snackbar("حدثت مشكلة ما، قم بتحديث الصفحة.", 3000, "error");
                }
                else if (result["success"] == false)
                    snackbar("لم يتم حذف التعليق، أعد المحاولة." , 3000 , "error");
                else if (result["success"] == true)
                {
                    //do no think
                }
            },
            error: function() {
                snackbar("تحقق من الاتصال بالانترنت" , 3000 , "error");
            } ,
            complete : function() {
                item.css({"display":"none"});
            }
        });
    });
</script>