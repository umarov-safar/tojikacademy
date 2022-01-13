<!DOCTYPE HTML>
<html lang="tg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ Session::token() }}">


    <title>@yield('title', 'Тоҷик Академия - сомонаи дарсии Тоҷикон')</title>


    <meta name="description" content="@yield('description', 'Тоҷик Академия - яке аз бузургтарин сомонаи дарсии Тоҷикон мебошад. Дар ин сомона шумо метавонед дарсҳои хуб ва пешрафтро биомузед бо роҳҳои осон.')">
    <meta name="keywords" content="@yield('keywords','Тоҷик Академия, Точик Академия, Омузиши забони руси, омузиши забони англиси, дарсҳои Тоҷики, Тестҳои ММТ, тоҷикистон')">
    <meta name="author" content="@yield('author', 'Баҳромзода Сафарбек')">

    @yield('metas')

    <meta property="og:image" content="@yield('image', asset('uploads/logo.jpg'))">
    <meta property="og:title" content="@yield('title', 'Тоҷик Академия - сомонаи дарсии Тоҷикон')">
    <meta property="og:url" content="@yield('url', 'http://www.tojikacademy.com')">
    <meta property="og:description" content="@yield('description', 'Тоҷик Академия - яке аз бузургтарин сомонаи дарсии Тоҷикон мебошад. Дар ин сомона шумо метавонед дарсҳои хуб ва пешрафтро биомузед бо роҳҳои осон.')">
    <meta property="og:site_name" content="Тоҷик Академия">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="tg_Tj">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.layout.css') }}">
    @yield('css')

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js_head')
</head>

{{-- menu of header the function is in the helpers.php file --}}
@php
    $menuTree = menuHeader();
@endphp

<body>
<div class="wrapper">
    <div class="menu-wrapper">
        <div class="menu" id="desktop-menu">
            <header class="header">
                <div class="main-link  desktop-menu">
                    <div id="bar">
                        <i class="fas fa-bars"></i>
                    </div>
                    <div class="left-header" >
                        <div class="logo">
                            <a href="/" class="upper">
                                Тоҷик<span class="red">Академия</span>
                            </a>
                        </div>
                        <nav class="ml-4 nav-menu">
                            <ul class="d-flex menu-items">
                                @foreach ($menuTree as $menu)
                                    <li class="catalog-menu">
                                        <a  href="#" class="parent-item">{{ $menu->name }} <i class="fas fa-angle-down"></i></a>
                                        <div class="child-items">
                                            <ul class="link-list">
                                                @foreach ($menu->children as $item)
                                                    <li class="item"><a href="{{ $item->url() }}">{{ $item->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach

                                {{--
                                <li class="catalog-menu ">
                                    <a href="#" class="parent-item">Дарсҳои охирин <i class="fas fa-angle-down"></i></a>
                                    <div class="child-items">
                                        <ul class="link-list">
                                            <li class="item"><a href="{{ route('tutorials') }}">Мавзуҳои Дарси</a></li>
                                            <li class="item"><a href="#">Омузиши луғатҳо</a></li>
                                            <li class="item"><a href="#">Дарсҳо</a></li>
                                            <li class="item"><a href="#">Видеоҳо</a></li>
                                        </ul>
                                    </div>
                                </li> --}}
                            </ul>
                        </nav>
                    </div>
                    <nav>
                        <div class="d-flex align-center justify-center" id="account-icons">
                            @auth()
                                <a class="nav-icon" href="{{ route('users.show', [auth()->id()]) }}"><span class="far fa-user-circle"></span></a>
                                <a class="nav-icon" href="{{ route('logout') }}"><i class="fas fa-door-open"></i></a>
                            @endauth
                            @guest
                                    <a class="nav-icon" href="{{ route('register') }}" ><i class="fas fa-user-plus"></i></a>
                                    <a class="nav-icon" href="{{ route('login') }}" ><i class="fas fa-sign-in-alt"></i></a>
                            @endguest
                        </div>
                    </nav>
                </div>

                {{-- mobile menu --}}
                <div class="mobile-menu w-80">
                    <ul class="menu-items-mobile" >
                        @auth
                            <li class="catalog-menu-mobile mb-3">
                                <a class="parent-item-mobile" href="{{ route('users.show', [auth()->id()]) }}"><span>{{ auth()->user()->fullName() }}</span><i class="far fa-user-circle"></i></a>
                            </li>
                            <li class="catalog-menu-mobile mb-3">
                                <a class="parent-item-mobile" href="/account/logout"><span>Баромадан</span><i class="fas fa-door-open"></i></a>
                            </li>
                        @endauth
                        @guest
                            <li class="catalog-menu-mobile">
                                <a class="parent-item-mobile mb-3" href="{{ route('login') }}">Воридшудан<i class="fas fa-sign-in-alt"></i></a>
                            </li>
                            <li class="catalog-menu-mobile mb-3">
                                <a class="parent-item-mobile" href="{{ route('register') }}">Бақайдгири<i class="fas fa-user-plus"></i></a>
                            </li>
                        @endguest
                    </ul>
                    <br>
                    <ul class="menu-items-mobile" >
                        @foreach ($menuTree as $menu)
                            <li class="catalog-menu-mobile">
                                <a class="parent-item-mobile upper">
                                    <span>{{ $menu->name }}</span>
                                    <i class="fas fa-angle-right"></i>
                                </a>
                                <div class="child-items-mobile">
                                    <ul class="link-list-mobile">
                                        @foreach ($menu->children as $item)
                                            <li class="item-mobile"><a href="{{ $item->url() }}">{{ $item->name }}</a></li>
                                         @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endforeach

                        {{--<li class="catalog-menu-mobile">
                            <a href="#" class="parent-item-mobile upper">
                                <span>Дарсҳои охирин</span>
                                <i class="fas fa-angle-right"></i>
                            </a>
                            <div class="child-items-mobile">
                                <ul class="link-list-mobile">
                                    <li class="item-mobile"><a href="#">Мавзуҳо</a></li>
                                    <li class="item-mobile"><a href="#">Мавзуҳо </a></li>
                                    <li class="item-mobile"><a href="#">Дарсҳо</a></li>
                                    <li class="item-mobile"><a href="#">Видеоҳо</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="catalog-menu-mobile">
                            <a href="#" class="parent-item-mobile upper">
                                <span>Англиси</span>
                                <i class="fas fa-angle-right"></i>
                            </a>
                            <div class="child-items-mobile">
                                <ul class="link-list-mobile">
                                    <li class="item-mobile"><a href="#">Машқҳо</a></li>
                                    <li class="item-mobile"><a href="#">Омузиши луғатҳо</a></li>
                                    <li class="item-mobile"><a href="#">Дарсҳо</a></li>
                                    <li class="item-mobile"><a href="#">Видеоҳо</a></li>
                                </ul>
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </header>
        </div>
    </div>

    {{-- Content of html is here --}}
    <main style="min-height: 80vh" id="main">
        @yield("content")
    </main>

    {{--  footer starts  --}}
    <footer class="dark">
        <div class="container max-width">
            <div class="content">
                <div class="items first">
                    <h3>Маълумот</h3>
                    <a href="#about">Дар бораи мо</a>
                    <a href="#about">Спонсорҳо</a>
                    <a href="#about">Мо дар ютуб</a>
                    <a href="#about">Видеоҳо</a>
                </div>
                <div class="items first">
                    <h3>Дарсҳо</h3>
                    <a href="#about">Руси</a>
                    <a href="#about">Англиси</a>
                    <a href="#about">Мавзуъҳо</a>
                    <a href="#about">Савол Ҷавоб</a>
                </div>
                <div class="items first">
                    <h3>Шабакаҳои иҷтимои</h3>
                    <a href="#"><i class="fab fa-youtube youtube"></i></a>
                    <a href="#"><i class="fab fa-facebook-square facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram instagram"></i></a>
                    <a href="#"><i class="fab fa-odnoklassniki okclass"></i></a>
                    <a href="#"><i class="fab fa-vk vk"></i></a>
                </div>
            </div>
        </div>

        <script src="{{asset('js/main.js')}}"></script>

        @yield('js_bottom')

    </footer>
</div>

</body>
</html>
