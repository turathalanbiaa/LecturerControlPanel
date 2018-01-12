@extends("layout.main_layout")

@section("title")
    <title>لوحة التحكم - {{$course->Name}}</title>
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
    @if(count($lessons) > 0)
        <h3 class="ui right aligned dividing green header">
            <span>جميع دروس - </span>
            <span>{{$course->Name}}</span>
        </h3>

        <div class="ui right aligned relaxed grid">
            @foreach($lessons as $lesson)
                <div class="eight wide mobile eight wide tablet four wide computer column">
                    <a href="/lesson?id={{$lesson->ID}}&c=ShowPopularComments" class="ui fluid button">{{$lesson->Title}}</a>
                </div>
            @endforeach

            <div class="row">
               <div class="sixteen wide teal column" id="pagination">
                   {{$lessons->links()}}
               </div>
            </div>
        </div>

    @else
        <div class="ui one column grid">
            <div class="column">
                <div class="ui segment">
                    <div class="lg-space"></div>
                    <div class="lg-space"></div>
                    <h4 class="ui center aligned header">هذه المادة لاتحتوي على اي درس !!!</h4>
                    <div class="lg-space"></div>
                    <div class="lg-space"></div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section("script")
    <script>
        var ul = $('ul.pagination');
        ul.addClass('ui right aligned pagination menu');
        ul.css({'padding':'0','font-size':'15px'});
        ul.find('li').addClass('item');
        var items = ul.find('li');
        for (var i = 0; i < items.length; ++i) {
            if(items[i].className == "item")
            {
                var aTag = items[i].firstChild;
                aTag.setAttribute("href",aTag.getAttribute("href") + "&id={{$course->ID}}");
            }
        }
    </script>
@endsection