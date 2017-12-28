@extends("layout.main_layout")

@section("title")
    <title>لوحة التحكم - الرسائل</title>
@endsection

@section("content")
    <div class="ui sixteen wide column">
        <div class="ui segment">
            <div class="ui grid">
                <div class="four wide column">
                    <div class="ui vertical teal fluid tabular menu">
                        <a class="item">
                            Bio
                        </a>
                        <a class="item">
                            Pics
                        </a>
                        <a class="item active">
                            Companies
                        </a>
                        <a class="item">
                            Links
                        </a>
                    </div>
                </div>
                <div class="twelve wide stretched column">
                    <div class="ui segment">
                        This is an stretched grid column. This segment will always match the tab height
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>

    </script>
@endsection