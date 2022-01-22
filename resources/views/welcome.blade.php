@extends('layout.app')

@section('content')
{{-- Description of website--}}
<section class="welcome" id="description-site">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex justify-center align-center">
                <div class="center">
                    <h1 class="title-welcome">Хуш омадед ба сомонаи Тоҷик Академия</h1>
                    <p class="col-lg-10 m-auto text" style="line-height: 2rem">
                        <strong>Тоҷик Академия</strong> яке аз сомонаи бузургтарини дарсӣ дар Тоҷикистон мебошад.
                        Ҳадаф аз кушадани ин сомона кумак кардан ба шахсоне аст, ки мехоҳан забонҳои хориҷӣ, дарсҳои гуногун, ва хабарҳои навро
                        хонанду аз худ кунанд. Ин чунин дар сомона шумо метавонед бо ҳамдигар саволу ҷавоб кунед.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/logo.png') }}" alt="Тоҷик Академия" width="60%" class="logo-welcome" />
            </div>
        </div>
    </div>
</section>

{{-- Some link to main products --}}
<section class="products">
    <div class="container p-sm2-0" >
        <h2 class="section-title ml-7">Бо мо биомуз</h2>
        <div class="boxes">

            <div class="card">
                <h3 class="center">Забони Руси</h3>
                <p>
                    Дар сомонаи мо шумо забони руси онлайн меомузед. Ҳамаи луғатҳо ва ибораҳоро метавонед
                    талафузашро гуш кунед. Луғатҳо бо категорияҳо мебошад.
                </p>
                <div class="links">
                    <a class="link" href="{{ route('russian-words') }}">
                        Омузиши Луғатҳо
                    </a>
                    <a class="link" href="{{ route('russian') }}">
                        Омузиши Ибораҳо
                    </a>
                </div>
            </div>

            <div class="card">
                <h3 class="center">Забони Англиси</h3>
                <p>
                    Дар сомонаи мо шумо забони Англисиро низ онлайн ва бо категорияҳои лозими меомузед.
                    Ҳамаи луғатҳо ва ибораҳоро метавонед тарзи талафузашро гуш кунед.
                </p>
                <div class="links">
                    <a class="link" href="{{ route('english-words') }}">
                        Омузиши Луғатҳо
                    </a>
                    <a class="link" href="{{ route('english') }}">
                        Омузиши Ибораҳо
                    </a>
                </div>
            </div>

            <div class="card">
                <h3 class="center">Саволу ҷавоб</h3>
                <p>
                    Саволу ҷавоб ин беҳтарин роҳ барои рушди дониш мебошад. Дар сомонаи мо метавонед савол
                    гузоред ва ба саволҳо ҷавоб диҳед. Саволҳо категорияи худашро доранд
                </p>
                <div class="links">
                    <a class="link-1" href="{{ route('questions.index') }}">
                        Саҳифаи Саволҳо
                    </a>
                </div>
            </div>

            <div class="card">
                <h3 class="center">Мавзӯҳои дарсӣ</h3>
                <p>
                    Мавзуҳои гунугуни дарси дар сомонаи мо нашр мешава содда фаҳмонда. Мавзуҳо аз категорияҳо иборат
                    мебошанд ба монанди Математика, Руси, Англиси ва ғайра
                </p>
                <div class="links">
                    <a class="link-1" href="{{ route('tutorials') }}">
                        Саҳифаи мавзӯҳо
                    </a>
                </div>
            </div>

            <div class="card">
                <h3 class="center">Хабарҳои нав</h3>
                <p>
                    Дар сомона хабарҳои нави аз сомона, тоҷикистон ва дунё нашр мешавад. Мо талош мекунем
                    ки хабарҳои навро ба шумо расон аз дунёи илму техналогия.
                </p>
                <div class="links">
                    <a class="link-1" href="">
                        Саҳифаи Хабарҳо
                    </a>
                </div>
            </div>

            <div class="card">
                <h3 class="center">Тестҳои ММТ</h3>
                <p>
                    Дар сомоно тестҳои маркази миллии тести гузошта мешавад. Шумо метавонед онлайн
                    тестҳо кор кунед ва балҳои худро бубинед. Тестҳо аз ҳамаи фанҳо мебошад.
                </p>
                <div class="links">
                    <a class="link-1" href="">
                        Саҳифаи тестҳо
                    </a>
                </div>
            </div>

            <div class="card">
                <h3 class="center">Видеоҳои дарсӣ</h3>
                <p>
                    Мо видеоҳои дарси дар шабака мегузорем. Мо низ youtube канал дорем дар онҷо низ видеоҳои
                    дарси гузошта мешавад. Видеҳо низ категорияҳои худашро дорад.
                </p>
                <div class="links">
                    <a class="link-1" href="">
                        Саҳифаи тестҳо
                    </a>
                </div>
            </div>

            <div class="card">
                <h3 class="center">Бозиҳои ҷолиб</h3>
                <p>
                    Дар шабака мо бозиҳои ҷолиб тартиб медиҳем ба монанди тестҳо ва ҷаводиҳандаҳои беҳтарин ва
                    ба шахсоне ки ҷойҳои хубро ишғол карданд туҳфаҳо дода мешавад.
                </p>
                <div class="links">
                    <a class="link-1" href="">
                        Саҳифаи тестҳо
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Serive (our work)--}}
<section class="service" id="service">
    <div class="container">
        <h2 class="section-title">Корҳои мо</h2>
        <div class="row justify-between">
            <div class="long-cart col-lg-6 col-sm-12">
                <div class="text-cart">
                    <a href="https://www.youtube.com/c/tojikacademy" target="_blank">
                        <h3 class="cart-title red">Youtube</h3>
                    </a>
                    <p>
                        Моро дар ютуб зиёда аз 12 500 нафар тамошо мекунад ва аз дарсҳои мо бениҳоят хушҳол ва
                        сипосгузоранд. Шумо низ бо мо бипайвандед то аз дарсҳои нав огаҳ бошед. Ба тугмаи поён зер
                        кунеду ба шабакаи мо дар youtube обуна
                        шавед.
                    </p>
                    <a href="https://www.youtube.com/c/tojikacademy" target="_blank" class="btn-a">Youtube-и мо</a>
                </div>
                <a href="https://www.youtube.com/c/tojikacademy"  target="_blank" class="block-img">
                    <img src="{{ asset('images/youtobe.png') }}" alt="Тоҷик Академия омузиши дарсҳо" />
                </a>
            </div>

            <div class="long-cart col-lg-6 col-sm-12">
                <div class="text-cart">
                    <a href="https://www.instagram.com/tojikacademy" target="_blank">
                        <h3 class="cart-title"><span style="color: #bc1888;">Instagram</span></h3>
                    </a>
                    <p>
                        Дар инстаграмм мо видеоҳои хурд ва аксҳои дарси дорем. Бо обуна шудан дар Инстаграми мо шумо
                        луғатҳои нав меомузед бо аксҳои ҷолиб. Луғатҳои забони Русӣ ва Англисӣ мегузорем дар онҷо.
                    </p>
                    <a href="https://www.instagram.com/tojikacademy" target="_blank" class="btn-a ins">Instagram-и мо</a>
                </div>
                <a href="https://www.instagram.com/tojikacademy" class="block-img" target="_blank">
                    <img src="{{ asset('images/insta.webp') }}" alt="" />
                </a>
            </div>

            <div class="long-cart col-lg-6 col-sm-12">
                <div class="text-cart">
                    <a href="{{ route('english') }}"><h3 class="cart-title">Забони Англисӣ</h3></a>
                    <p>
                        Як аз корҳои ассоси мо ин дарсҳои забони Англисӣ мебошад. Мо дарсҳои онлайни дорем, ки
                        шумо метавонед биомузед ва талаффузи калимаҳоро гуш кунед. Луғат омузи ва ибора омузи
                        айни ҳол омода барои истифода аст.
                    </p>
                    <div class="d-flex" style="z-index: 111;">
                        <a href="{{ route('english-words') }}" class="btn-a ang">Омузиши Луғатҳо</a>
                        <a href="{{ route('english') }}" class="btn-a ang">Омузиши Ибораҳо</a>
                    </div>
                </div>
                <a href="{{ route('english') }}" class="block-img">
                    <img src="{{ asset('images/english.webp') }}" alt="" />
                </a>
            </div>

            <div class="long-cart col-lg-6 col-sm-12">
                <div class="text-cart">
                    <a href="{{ route('russian') }}"><h3 class="cart-title">Забони Русӣ</h3></a>
                    <p>
                        Омузиши забони Русӣ дар сомонаи мо осон ва бо категорияҳои лозима сохта шудааст.
                        Дар сомона луғатҳо ва ибораҳои забони Русиро онлайн ва бо машқҳо меомузед.
                        Ҳангоми анҷом додани машқҳо шумо метавонед талаффузҳои
                        калимаҳоро гуш кунед.
                    </p>
                    <div class="d-flex" style="z-index: 111;">
                        <a href="{{ route('russian') }}" class="btn-a ru">Омузиши Луғатҳо</a>
                        <a href="{{ route('russian-words') }}" class="btn-a ru">Омузиши Ибораҳо</a>
                    </div>
                </div>
                <a href="{{ route('russian') }}" class="block-img">
                    <img src="{{ asset('images/russian.png') }}" alt="" />
                </a>
            </div>
        </div>
    </div>
</section>

{{-- OUR SPONSORS --}}
<section class="dark">
    <div class="container">
        <h2 class="section-title">Сарпарастони мо</h2>
        <p class="white">Дӯстоне ки барои пешрафти сомоно саҳми худро гузоштанд!</p>
        <br />
        <div class="content">
            <div class="owl-carousel owl-theme">
                @foreach($sponsors as $sponsor)
                    <div>
                        <div class="sponsor">
                            <div class="name-img">
                                <img src="{{ asset($sponsor->image) }}" alt="" />
                                <a href="#instagram">{{ $sponsor->name }}</a>
                            </div>
                            <span>{{ $sponsor->about }}</span>
                            @if($sponsor->type_link == 'youtube')
                                <a href="{{ $sponsor->link }}" target="_blank" class="btn-a ins">Youtube</a>
                            @elseif($sponsor->type_link == 'instagram')
                                <a href="{{ $sponsor->link }}" target="_blank" class="btn-a ins">Instagram</a>
                            @else
                                <a href="#instagram" class="btn-a ins">Instagram</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="all-sponsor-btn">
                <br>
                <a href="{{ route('sponsors') }}" class="btn-a light m-3">Ҳамаи спонсорҳо</a>
            </div>
        </div>
    </div>
</section>

{{-- Client say about us--}}
{{-- <section class="clients-sey">
    <div class="container max-width">
        <h2 class="section-title">Истифода барандагони мо чи мегуянд</h2>
        <div class="content">
            @for($i = 0; $i < 4; $i++)
                <div class="told">
                    <div class="name-img">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/1024px-User_icon_2.svg.png" alt="" />
                        <h4>Юлия С</h4>
                    </div>
                    <p>
                        Спасибо! Подсела на ваш канал,😊👍. У вас милый акцент. Я пытаюсь учить
                        язык Дари по учебнику Островского Б.на котором говорят в Афганистане ,трудно,но интересно))
                        А теперь смотрю ваши видео и замечаю много знакомых
                        слов, которые успела выучить,мне это даже помогает.
                    </p>
                </div>
            @endfor
        </div>
    </div>
</section> --}}

{{-- Мавзуъҳо--}}
<section class="articles">
    <div class="container  p-sm2-0">
        <div class="content row">
            <div class="col-lg-6">
                <h2 class="section-title">Хабарҳои нав</h2>
                @forelse($news as $article)
                    <div class="article row">
                        <div class="text p-0">
                            <a href="{{ route('news-content', ['category' => $article->cat_slug, 'slug' => $article->slug ]) }}"
                                class="article-title upper mb-6">
                                <h4>{{ $article->title }}</h4>
                            </a>
                            <div>
                                @php
                                    $image  = json_decode($article->image_sizes, true);
                                @endphp
                                <a href="{{ route('news-content', ['category' => $article->cat_slug, 'slug' => $article->slug ]) }}">
                                    <img src="/{{ $image['200x200'] ?? $article->image }}" alt="{{ $article->title }}" />
                                </a>

                                <p class="des">{{ Str::limit($article->description, 100, '...') }}</p>
                            </div>
                            <div class="d-flex justify-between p-5 mt-6">
                                <a href="{{ route('news-content', ['category' => $article->cat_slug, 'slug' => $article->slug ]) }}" class="btn-article">Муфассал</a>
                                <small>{{ $article->date }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Ҳоло хабаре нест</p>
                @endforelse
            </div>

            <div class="col-lg-6">
                <h2 class="section-title">Дарсҳои нав</h2>
                @forelse($tutorials as $tutorial)
                    <div class="article row">
                        <div class="text p-0">
                            <a href="/tutorials/{{ $tutorial->category->slug }}/{{ $tutorial->slug }}" class="article-title upper mb-6"><h4>{{ $tutorial->title }}</h4></a>
                            <div>
                                <a href="/tutorials/{{ $tutorial->category->slug }}/{{ $tutorial->slug }}">
                                    <img src="/{{ $tutorial->image_sizes['200x200'] ?? $tutorial->image }}" alt="{{ $tutorial->title }}" />
                                </a>

                                <p class="des">{{ Str::limit($tutorial->description, 100, '...') }}</p>
                            </div>
                            <div class="d-flex justify-between p-5 mt-6">
                                <a href="/tutorials/{{ $tutorial->category->slug }}/{{ $tutorial->slug }}" class="btn-article">Муфассал</a>
                                <small>{{ $tutorial->date }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Ҳоло мавзуъҳо нест</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- Answer and question --}}
<x-questions-section :questions="$questions" :link="true"></x-questions-section>

@endsection
