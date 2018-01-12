@extends("layout.main_layout")

@section("title")
    <title>لوحة التحكم - {{$course->Name}}</title>
@endsection

@section("style")
    <style>
        .delete-comment {margin-right: 5px; color: #4183c4;}
        .delete-comment:hover, #delete-comment:focus {cursor: pointer; text-decoration: underline;}
    </style>
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
                <div class="ui lesson embed" data-source="youtube" data-id="{{$lesson->YoutubeVideoId}}" data-placeholder="{{asset("/image/turath-logo.png")}}">
                    <i class="video play icon" style="background: cadetblue;"></i>
                    <img class="placeholder" src="{{asset("/image/turath-logo.png")}}">
                </div>
            </div>
        </div>

        @include("includes.add_question")

        @include("includes.comments")
    </div>
@endsection

@section("script")
    <script>
        $('.ui.lesson.embed').embed();
    </script>
@endsection