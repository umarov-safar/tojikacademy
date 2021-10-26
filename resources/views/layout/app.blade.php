<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ Session::token() }}">

    <meta name="keywords" content="@yield('keywords','Омузиши забони руси, омузиши забони англиси, тоҷикистон')">
    <meta name="author" content="@yield('author', 'Баҳромзода Сафарбек')">
    <meta name="description" content="@yield('description', 'Тоҷик Академия шабакаи дарси')">
    <meta name="page-type" content="Blogging">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{asset('css/mobile.css')}}">
    @yield('cssfiles')
    <title>@yield('title', 'Тоҷик Академия')</title>
</head>

<body>
<div class="wrapper">
    <div class="menu-wrapper">
        <div class="menu">
            <header class="header">
                <div class="main-link  destop-menu">
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
                                <li class="catalog-menu">
                                    <a href="" class="parent-item">Англиси <i class="fas fa-angle-down"></i></a>
                                    <div class="child-items">
                                        <ul class="link-list">
                                            <li class="item"><a href="">Машқҳо</a></li>
                                            <li class="item"><a href="#">Омузиши луғатҳо</a></li>
                                            <li class="item"><a href="#">Дарсҳо</a></li>
                                            <li class="item"><a href="#">Видеоҳо</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="catalog-menu ">
                                    <a href="" class="parent-item">Руси <i class="fas fa-angle-down"></i></a>
                                    <div class="child-items">
                                        <ul class="link-list">
                                            <li class="item"><a href="">Машқҳо</a></li>
                                            <li class="item"><a href="#">Омузиши луғатҳо</a></li>
                                            <li class="item"><a href="#">Дарсҳо</a></li>
                                            <li class="item"><a href="#">Видеоҳо</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="catalog-menu ">
                                    <a href="" class="parent-item">Савол ва Ҷавоб<i class="fas fa-angle-down"></i></a>
                                    <div class="child-items">
                                        <ul class="link-list">
                                            <li class="item"> <a href="">Савол додан</a></li>
                                            <li class="item"><a href="">Саволҳо</a></li>
                                            <li class="item"><a href="#">Дарсҳо</a></li>
                                            <li class="item"><a href="#">Видеоҳо</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="catalog-menu ">
                                    <a href="#" class="parent-item">Дарсҳои охирин <i class="fas fa-angle-down"></i></a>
                                    <div class="child-items">
                                        <ul class="link-list">
                                            <li class="item"><a href="#">Машқҳо</a></li>
                                            <li class="item"><a href="#">Омузиши луғатҳо</a></li>
                                            <li class="item"><a href="#">Дарсҳо</a></li>
                                            <li class="item"><a href="#">Видеоҳо</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <nav>
                        <div class="d-flex align-center justify-center">
                            @auth
                                <a class="btn-account" href="/account/profile"><i class="far fa-user-circle"></i> <span>{{ auth()->user()->name }}</span></a>
                                <a class="btn-account p-3 mr-6" href="{{ route('logout') }}"><i class="fas fa-sign-in-alt"></i> </a>
                            @endauth
                            @guest
                                <a class="btn-account p-3 mr-6" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> </a>
                                <a class="btn-account p-3 ml-6" href="{{ route('register') }}"><i class="fas fa-user-plus"></i></a>
                            @endguest
                        </div>
                    </nav>
                </div>
                <div class="mobile-menu w-80">
                    <ul class="menu-items-mobile" >
                        @auth
                            <li class="catalog-menu-mobile mb-3">
                                <a class="parent-item-mobile" href="/account/profile"><span>{{ auth()->user()->name }}</span><i class="far fa-user-circle"></i></a>
                            </li>
                            <li class="catalog-menu-mobile mb-3">
                                <a class="parent-item-mobile" href="/account/logout"><span>Баромадан</span><i class="fas fa-door-open"></i></a>
                            </li>
                        @endauth
                        @guest
                            <li class="catalog-menu-mobile">
                                <a class="parent-item-mobile mb-3" href="">Воридшудан<i class="fas fa-sign-in-alt"></i></a>
                            </li>
                            <li class="catalog-menu-mobile mb-3">
                                <a class="parent-item-mobile" href="">Бақайдгири<i class="fas fa-user-plus"></i></a>
                            </li>
                        @endguest
                    </ul>
                    <br>
                    <ul class="menu-items-mobile" >
                        <li class="catalog-menu-mobile">
                            <a class="parent-item-mobile upper">
                                <span>Англиси</span>
                                <i class="fas fa-angle-right"></i>
                            </a>
                            <div class="child-items-mobile">
                                <ul class="link-list-mobile">
                                    <li class="item-mobile"><a href="">Машқҳо</a></li>
                                    <li class="item-mobile"><a href="#">Омузиши луғатҳо</a></li>
                                    <li class="item-mobile"><a href="#">Дарсҳо</a></li>
                                    <li class="item-mobile"><a href="#">Видеоҳо</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="catalog-menu-mobile">
                            <a href="#" class="parent-item-mobile upper">
                                <span>Русси</span>
                                <i class="fas fa-angle-right"></i>
                            </a>
                            <div class="child-items-mobile">
                                <ul class="link-list-mobile">
                                    <li class="item-mobile"><a href="">Машқҳо</a></li>
                                    <li class="item-mobile"><a href="#">Омузиши луғатҳо</a></li>
                                    <li class="item-mobile"><a href="#">Дарсҳо</a></li>
                                    <li class="item-mobile"><a href="#">Видеоҳо</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="catalog-menu-mobile">
                            <a href="#" class="parent-item-mobile upper">
                                <span>Саволу Ҷавоб</span>
                                <i class="fas fa-angle-right"></i>
                            </a>
                            <div class="child-items-mobile">
                                <ul class="link-list-mobile">
                                    <li class="item-mobile"><a href="">Саволҳо</a></li>
                                    <li class="item-mobile"><a href="">Савол пурсидан</a></li>
                                    <li class="item-mobile"><a href="">Саволҳо аз англиси</a></li>
                                    <li class="item-mobile"><a href="#">Видеоҳо</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="catalog-menu-mobile">
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
                        </li>
                    </ul>
                </div>
            </header>
        </div>
    </div>

    {{-- Content of html is here --}}
    <main style="min-height: 80vh">
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
    </footer>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('js/main.js')}}"></script>

@yield('jsfiles')
</body>
</html>
