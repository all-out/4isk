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
<div class="container">
    <div>
        <h1>{{ link_to('/', '4isk') }}</h1>
        <p class="lead">Eve Online Gaming Platform</p>
    </div>
    <div class="row">
        <div class="col-sm-12 blog-main">@yield('content')</div>
    </div>
</div>
</body>

</html>