<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <header>
            <h1><a href="{{ route('articles.index') }}">{{ config('app.name', 'Laravel') }}</a></h1>
        </header>
        <main>
            @yield('content')
        </main>
    </body>
</html>