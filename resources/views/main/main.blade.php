@extends("layout.main_layout")

@section("title")
    <title>لوحة التحكم - الرئيسية</title>
@endsection

@section("style")
    <style>
        #pagination
        {
            margin-right: 6px;
            margin-left: 6px;
            text-align: center;
        }
    </style>
@endsection


@section("content")
    <div class="ui grid">
        @if(count($unwatchedMessages) > 0)
            <div class="ui sixteen wide column">
                <div class="ui right aligned green header">آحدث الرسائل</div>
                <div class="ui segments">
                    @foreach($unwatchedMessages as $unwatchedMessage)
                        <div class="ui segment">
                            <div class="ui list">
                                <div class="right item">
                                    <img class="ui avatar image" src="{{asset("image/student.png")}}">
                                    <div class="content">
                                        <a class="header" href="message?studentId={{$unwatchedMessage->Sender}}">{{$unwatchedMessage->Name}}</a>
                                        <div class="description">{{$unwatchedMessage->Message}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="ui center aligned teal segment">
                        {{$unwatchedMessages->links()}}
                    </div>
                </div>
            </div>
        @else
            <div class="sixteen wide column">
                <div class="ui info message">
                    <div class="lg-space"></div>
                    <h2 class="ui center aligned header">لاتوجد رسائل جديدة</h2>
                    <div class="lg-space"></div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section("script")
    <script>
        var ul = $('ul.pagination');
        ul.addClass('ui right aligned pagination menu');
        ul.css({'padding':'0','font-size':'15px'});
        ul.find('li').addClass('item');
    </script>
@endsection