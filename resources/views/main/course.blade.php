@extends("layout.main_layout")

@section("title")
    <title>لوحة التحكم - {{$course->Name}}</title>
@endsection

@section("content")
    @if(count($lessons) > 0)
        <h3 class="ui right aligned dividing green header">
            <span>جميع دروس - </span>
            <span>{{$course->Name}}</span>
        </h3>

        <div class="ui right aligned relaxed grid">
            @foreach($lessons as $lesson)
                <div class="eight wide mobile four wide computer column">
                    <a href="/lesson?id={{$lesson->ID}}" class="ui fluid button">{{$lesson->Title}}</a>
                </div>
            @endforeach
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

    </script>
@endsection