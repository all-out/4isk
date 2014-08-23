<!doctype html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <title>4isk</title>
</head>
<body>

    @include('partials.nav')

    @foreach ($errors->all() as $error)
        @include('partials.error', array('error' => $error))
    @endforeach

    <div class="container">
        @yield('content')
    </div>

</body>
</html>