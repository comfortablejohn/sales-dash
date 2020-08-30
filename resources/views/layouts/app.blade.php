<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title></title>

        <link href="/css/app.css" rel="stylesheet">
    </head>
    <body>
        @yield('body')
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
