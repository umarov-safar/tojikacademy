<!DOCTYPE html>
<html lang="tg">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ Session::token() }}" />
    <meta name="yandex-verification" content="86988634e2c620cf" />
    
    @laravelPWA

    <title>@yield('title', 'Тоҷик Академия - сомонаи дарсии Тоҷикон')</title>

    <meta name="description" content="@yield('description', 'Тоҷик Академия - яке аз бузургтарин сомонаи дарсии Тоҷикон мебошад. Дар ин сомона шумо метавонед дарсҳои хуб ва пешрафтро биомузед бо роҳҳои осон.')" />
    <meta name="keywords" content="@yield('keywords','Тоҷик Академия, Точик Академия, Омузиши забони руси, омузиши забони англиси, дарсҳои Тоҷики, Тестҳои ММТ, тоҷикистон')" />
    <meta name="author" content="@yield('author', 'Баҳромзода Сафарбек')" />

    @yield('metas')

    <meta property="og:image" content="@yield('image', asset('uploads/logo.jpg'))" />
    <meta property="og:title" content="@yield('title', 'Тоҷик Академия - сомонаи дарсии Тоҷикон')" />
    <meta property="og:url" content="@yield('url', 'http://www.tojikacademy.com')" />
    <meta property="og:description" content="@yield('description', 'Тоҷик Академия - яке аз бузургтарин сомонаи дарсии Тоҷикон мебошад. Дар ин сомона шумо метавонед дарсҳои хуб ва пешрафтро биомузед бо роҳҳои осон.')" />
    <meta property="og:site_name" content="Тоҷик Академия" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="tg_Tj" />

    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @yield('css')

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js_head')
</head>

{{-- menu of header the function is in the helpers.php file --}}
<body>
<div class="wrapper">
    {{-- Content of html is here --}}
    <main style="min-height: 90vh;" id="main">
        @yield("content")
    </main>

    {{-- footer starts --}}
    <footer>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                <p class="p-5">© {{ date('Y') }} Тоҷик Академия. <br> Ҳамаи ҳуқуқҳо ҳифз шудаанд.</p>
            </div>
        </div>

        <script src="{{asset('js/main.js')}}"></script>
        @yield('js_bottom')
    </footer>
</div>
</body>
</html>
