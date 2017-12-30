@extends("layout.main_layout")

@section("title")
    <title>لوحة التحكم - الرسائل</title>
@endsection

@section("content")
    <div class="ui sixteen wide column">
        <div class="ui segment">
            <div class="ui grid">

                <div class="row">
                    <div class="sixteen wide column">
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
                                    <button type="submit" class="ui positive fluid button" style="margin: 0!important;">بحث</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="four wide column">
                        <div class="ui vertical teal fluid  menu" style="max-height: 750px; overflow-y: scroll; overflow-x: hidden;">
                            @foreach($students as $student)
                                <a class="item" href="/message?studentId={{$student->ID}}">
                                    {{$student->Name}}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="twelve wide stretched column">
                        <div class="ui segment">
                            ff
                        </div>

                        <div style="max-height: 100px; margin-bottom: 20px;">
                            <h4 class="ui top attached dividing right aligned teal header">أضافة رسالة</h4>
                            <div class="ui attached segment">
                                <form class="ui big form"  dir="rtl" id="add-message">
                                    <div class="ui left icon input" style="width: 100%; text-align: right;">
                                        <input type="text" placeholder="اكتب هنا..." name="studentMessage" style="text-align: right;">
                                        <i class="search icon"></i>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $('.ui.selection.dropdown').dropdown();
        $("#add-message").submit(function( event ) {
            
        });

    </script>
@endsection