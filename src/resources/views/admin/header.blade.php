<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel').' Admin' }}</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <header style="width: 100%; display: flex;">
            <h2 style="margin-right: 10px;">{{ config('app.name', 'Laravel').' Admin' }}</h1>
            <h2 style="margin-right: 10px;">
                <a href="{{ route('admin.articles.index') }}">記事管理</a>
            </h2>
            <h2 style="margin-right: 10px;">
                <a href="#">画像管理</a>
            </h2>
            <div style="margin: 0 0 0 auto;">
                <form method="post" action="{{ route('admin.auth.logout') }}">
                    @csrf
                    <button type="submit">ログアウト</button>
                </form>
            </div>
        </header>
        @if (session('admin_flash_message'))
            <div>
                <b>{{ session('admin_flash_message') }}</b>
            </div>
        @endif
        <main>
            @yield('content')
        </main>
    </body>
</html>