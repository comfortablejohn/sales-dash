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
        <div class="header">
            <nav class="header__nav">
                <ul>
                    <a href="/dashboard">Dashboard</a>
                    <a href="/data">Data Grid</a>
                </ul>
            </nav>
            <div class="header__logo">
                <h3>AG Sales</h3>
            </div>
        </div>
        <div id="app">
            <div>
                @yield('body')
            </div>
        </div>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
