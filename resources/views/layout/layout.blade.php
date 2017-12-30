<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

@yield("title")

<!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Stylesheet -->
    <link href="{{asset('css/semantic.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/snackbar.css')}}" rel="stylesheet" type="text/css">

    <!-- Script -->
    <script src="{{asset("js/jquery.min.js")}}"></script>
    <script src="{{asset("js/semantic.min.js")}}"></script>
    <script src="{{asset("js/snackbar.js")}}"></script>
</head>

<body>

    <div class="ui container">
        @yield("content")

        @yield("extra-content")
    </div>

    @yield("script")

</body>
</html>
