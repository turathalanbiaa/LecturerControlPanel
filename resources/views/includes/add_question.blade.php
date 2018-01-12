<div class="sixteen wide brown column">
    @if(session("AddQuestionMessage"))
        <div class="ui large message">
            <h2 class="ui center aligned green header">{{session("AddQuestionMessage")}}</h2>
        </div>
    @endif

    <div class="ui add question fluid inverted accordion">
        <h3 class="ui inverted header title" style="margin-bottom: 0;">
            <i class="dropdown icon"></i>
            <span>أضافة سؤال حول هذا الدرس</span>
        </h3>
        <div class="content">
            @if(count($errors))
                <div class="ui error message" id="message">
                    <ul class="list">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="ui form" method="post" action="/add-question">
                {!! csrf_field() !!}
                <input type="hidden" name="lessonID" value="{{$lesson->ID}}">
                <div class="ui grid">
                    <div class="sixteen wide column">
                        <h3>السؤال</h3>
                        <textarea name="question" rows="5" title="question">{{old("question")}}</textarea>
                    </div>

                    <div class="sixteen wide tablet eight wide computer column">
                        <div class="field">
                            <label style="color: white;">الأختيارات</label>
                            <div class="ui segment">
                                <div class="inline fields">
                                    <div class="three wide field">
                                        <label>الأختيار الأول</label>
                                    </div>
                                    <div class="thirteen wide field">
                                        <input type="text" name="option-1" value="{{old("option-1")}}">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="three wide field">
                                        <label>الأختيار الثاني</label>
                                    </div>
                                    <div class="thirteen wide field">
                                        <input type="text" name="option-2" value="{{old("option-2")}}">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="three wide field">
                                        <label>الأختيار الثالث</label>
                                    </div>
                                    <div class="thirteen wide field">
                                        <input type="text" name="option-3" value="{{old("option-3")}}">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="three wide field">
                                        <label>الأختيار الرابع</label>
                                    </div>
                                    <div class="thirteen wide field">
                                        <input type="text" name="option-4" value="{{old("option-4")}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sixteen wide tablet eight wide computer column">
                        <div class="field">
                            <label style="color: white;">أختر رقم الجواب الصحيح</label>
                            <div class="ui segment">
                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="answer" value="1" checked="checked" class="hidden">
                                            <label>الأختيار الأول</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="answer" value="2" class="hidden">
                                            <label>الأختيار الثاني</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="answer" value="3" class="hidden">
                                            <label>الأختيار الثالث</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="answer" value="4" class="hidden">
                                            <label>الأختيار الرابع</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sixteen wide column">
                        <button class="ui fluid large black button" type="submit">حفظ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.ui.checkbox').checkbox();
    $('.ui.add.question.accordion').accordion();
</script>