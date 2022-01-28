<!DOCTYPE html>
<html lang="tg">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ Session::token() }}" />
    <meta name="yandex-verification" content="86988634e2c620cf" />
    <meta name="yandex-verification" content="86988634e2c620cf" />

    <title>@yield('title', 'Тоҷик Академия - сомонаи дарсии Тоҷикон')</title>

    <meta name="description" content="@yield('description', 'Точик Академия - яке аз бузургтарин сомонаи дарсии Тоҷикон мебошад. Дар ин сомона шумо метавонед забонҳои хориҷиро ва дарсҳои хубу пешрафтро биомузед бо роҳҳои осон. Ин чунин саволу ҷавоб дар сайти мо онлайн аст')" />
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

    @laravelPWA

    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @yield('css')

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js_head')
</head>

{{-- menu of header the function is in the helpers.php file --}}
@php $menuTree = menuHeader(); @endphp

<body>
<div class="wrapper">
    <div class="menu-wrapper">
        <div class="menu" id="desktop-menu">
            <header class="header">
                <div class="main-link desktop-menu">
                    <div id="bar">
                        <i class="fas fa-bars"></i>
                    </div>
                    <div class="left-header">
                        <div class="logo">
                            <a href="/" class="upper bold"> Тоҷик <span class="red">Академия</span> </a>
                        </div>
                        <nav class="ml-4 nav-menu">
                            <ul class="d-flex menu-items">
                                @foreach ($menuTree as $menu)
                                    <li class="catalog-menu">
                                        <a href="#" class="parent-item">{{ $menu->name }} <i class="fas fa-angle-down"></i></a>
                                        <div class="child-items">
                                            <ul class="link-list">
                                                @foreach ($menu->children as $item) @if($item->type === "external_link")
                                                    <li class="item"><a href="{{ $item->url() }}" target="_blank">{{ $item->name }}</a></li>
                                                @else
                                                    <li class="item"><a href="{{ $item->url() }}">{{ $item->name }}</a></li>
                                                @endif @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                    <nav>
                        <div class="d-flex align-center justify-center" id="account-icons">
                            @auth()
                                <a class="nav-icon" href="{{ route('users.show', [auth()->id()]) }}"><span class="far fa-user-circle"></span></a>
                                <a class="nav-icon" href="{{ route('logout') }}"><i class="fas fa-door-open"></i></a>
                            @endauth @guest
                                <a class="nav-icon" href="{{ route('register') }}"><i class="fas fa-user-plus"></i></a>
                                <a class="nav-icon" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i></a>
                            @endguest
                        </div>
                    </nav>
                </div>

                {{-- mobile menu --}}
                <div class="mobile-menu w-80">
                    <ul class="menu-items-mobile">
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
                    <br />
                    <ul class="menu-items-mobile">
                        @foreach ($menuTree as $menu)
                            <li class="catalog-menu-mobile">
                                <a class="parent-item-mobile upper">
                                    <span>{{ $menu->name }}</span>
                                    <i class="fas fa-angle-right"></i>
                                </a>
                                <div class="child-items-mobile">
                                    <ul class="link-list-mobile">
                                        @foreach ($menu->children as $item) @if($item->type === "external_link")
                                            <li class="item-mobile"><a href="{{ $item->url() }}" target="_blank">{{ $item->name }}</a></li>
                                        @else
                                            <li class="item-mobile"><a href="{{ $item->url() }}">{{ $item->name }}</a></li>
                                        @endif @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="p-10">
                        <h3 class="m-5">Таммос бо мо</h3>
                        <li class="m-5">Email: <a href="mailto:info@tojikacademy.com" style="color: #ccc">info@tojikacademy.com</a></li>
                    </ul>
                    <div class="socials">
                        <a href="https://youtube.com/c/tojikacademy" target="_blank"><i class="fab fa-youtube youtube"></i></a>
                        <a href="https://instagram.com/tojikacademy" target="_blank"><i class="fab fa-instagram instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook-square facebook"></i></a>
                        <a href="#"><i class="fab fa-odnoklassniki okclass"></i></a>
                        <a href="#"><i class="fab fa-vk vk"></i></a>
                    </div>
                </div>

            </header>
        </div>
    </div>

    {{-- Content of html is here --}}
    <main style="min-height: 80vh;" id="main">
        @yield("content")
    </main>

    {{-- footer starts --}}
    <footer>
        <div class="container-fluid dark" style="padding: 20px 0">
            <div class="container">
                <div class="content">
                    <div class="items first socials" style="display: unset;">
                        <h4>Тоҷик Академия</h4>
                        <a href="/about">Дарбораи сомона</a>
                        <a href="#" target="_blank">Ютуби мо <i class="fab fa-youtube youtube" style="color: red;"></i></a>
                        <a href="#" target="_blank">Инстаграми мо <i class="fab fa-instagram instagram"></i></a>
                        <a href="#" target="_blank">Facebook <i class="fab fa-facebook-square facebook"></i></a>
                        <a href="https://t.me/tojikacademy" target="_blank">Telegram <i class="fab fa-telegram"></i></a>
                        <a href="#" target="_blank">Одноклассник <i class="fab fa-odnoklassniki okclass"></i></a>
                    </div>
                    @foreach ($menuTree as $menu)
                        <div class="items first">
                            <h4>{{ $menu->name }}</h4>
                            @foreach ($menu->children as $item) @if($item->type === "external_link")
                                <a href="{{ $item->url() }}" target="_blank">{{ $item->name }}</a>
                            @else
                                <a href="{{ $item->url() }}">{{ $item->name }}</a>
                            @endif @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container-fluid" id="footer" >
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <h3 class="white">Таммос бо мо</h3>
                        <br>
                        <div>
                            <div class="m-6">
                                <span class="white bold">Email:</span>
                                <a href="mailto:info@tojikacademy.com" class="info">info@tojikacademy.com</a>
                            </div>
                            <div class="m-6">
                                <span class="white bold">Telegram:</span>
                                <a target="_blank" href="https://t.me/tojikacademy" class="info"> Тоҷик Академия</a>
                            </div>
                            <p class="white" style="line-height: 1.4rem">
                                Истифода барандагони азиз! Агар хоҳед бо мо тамос гиред лутфан дар почтаи боло зикршуда нависед
                                ва ё бо тарқи сомона ба мо паём фиристед. Мо бо камоли майл паём ва пешниҳодҳои шуморо мехоне
                                ва ҷавоб медиҳем
                            </p>
                            <br>
                            <div class="socials" style="justify-content: flex-start; gap: 15px">
                                <a href="https://youtube.com/c/tojikacademy" target="_blank"><i class="fab fa-youtube youtube"></i></a>
                                <a href="https://instagram.com/tojikacademy" target="_blank"><i class="fab fa-instagram instagram"></i></a>
                                <a href="#"><i class="fab fa-facebook-square facebook"></i></a>
                                <a href="#"><i class="fab fa-odnoklassniki okclass"></i></a>
                                <a href="#"><i class="fab fa-vk vk"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="white">Паём фиристодан</h3>
                        <br>
                        <p class="success m-3">{{ \Illuminate\Support\Facades\Session::get('responseMessage') }}</p>
                        <form id="register-form" method="POST" action="{{ route('sendMessage') }}">
                            @csrf
                            <div class="form-item">
                                <label for="name" class="input-label white">Номи шумо</label>
                                <input type="text" id="name" class="input @error('name') border-red @enderror" value="{{ old('name') }}" name="name" placeholder="Номатонро нависед..." >
                                @error('name')
                                <p class="red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-item">
                                <label for="email" class="input-label white">Почта эл. ё шумораи телефон</label>
                                <input type="text" class="input @error('contact') border-red @enderror" name="contact" id="email" value="{{ auth()->check() ? auth()->user()->email : old('email')}}" placeholder="example@gmail.com">
                                @error('contact')
                                <p class="red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-item">
                                <label for="message" class="input-label white">Паёми шумо</label>
                                <textarea
                                    class="textarea"
                                    name="message"
                                    id="message"
                                    placeholder="Паёматонро нависед дар инҷо..."
                                    rows="5">{{old('message')}}</textarea>
                                @error('message') <p class="red d-block">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-item">
                                <button type="submit"
                                        id="register-btn"
                                        class="btn-a bold pointer">Фиристодан</button>
                            </div>
                        </form>
                    </div>
                </div>

                <br>
                <br>
                <br>
                <p class="white p-5">© {{ date('Y') }} Тоҷик Академия. <br> Ҳамаи ҳуқуқҳо ҳифз шудаанд.</p>
            </div>
        </div>

        <script src="{{asset('js/main.js')}}"></script>
        @yield('js_bottom')
    </footer>
</div>
</body>
</html>
