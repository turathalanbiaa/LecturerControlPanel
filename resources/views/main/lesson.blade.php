@extends("layout.main_layout")

@section("title")
    <title>لوحة التحكم - {{$lesson->Title}}</title>
@endsection

@section("content")
    <h3 class="ui right aligned dividing green header">
        <span>{{$lesson->Title}}</span>
    </h3>

    <div class="ui right aligned grid">
        <div class="sixteen wide column">
            <div class="ui inverted segment">
                <div class="ui embed" data-source="youtube" data-id="{{$lesson->YoutubeVideoId}}" data-placeholder="/images/image-16by9.png">
                    <i class="video play icon"></i>
                    <img class="placeholder" src="/images/image-16by9.png">
                </div>

                <h3 class="ui right aligned dividing header">
                    <span style="float: right;">عدد المشاهدات : <small>395</small></span>
                    <span style="float: left;">عدد التعليقات : <small>16</small></span>
                </h3>

                <h3 class="ui right aligned dividing header">الرابط على الموقع : <a target="_blank" href="http://turathalanbiaa.com/lesson/269" style="color: red;">http://turathalanbiaa.com/lesson/269</a></h3>
            </div>
        </div>
        <div class="sixteen wide mobile six wide tablet four wide computer column">
            <div class="ui segment">
                12
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>

    </script>
@endsection