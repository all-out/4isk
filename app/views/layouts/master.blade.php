<!doctype html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script>
        $(".alert").alert();
    </script>
    <meta charset="utf-8">
    <title>4isk</title>
</head>
<body>

    @include('partials.nav')

    <div class="container">
        @include('partials.errors')
        @include('partials.flashes')

        @yield('content')
    </div>

</body>
</html>