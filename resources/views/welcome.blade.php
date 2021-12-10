@extends('layout.app')

@section('content')

    {{-- Description of website--}}
    <section class="welcome" id="description-site">
        <div class="container">
           <div class="row">
               <div class="col-lg-6 d-flex justify-center align-center">
                   <div class="center">
                       <h1 class="title-welcome">Хуш омадед ба сомонаи Тоҷик Академия</h1>
                       <p class="col-lg-10 m-auto text">
                           <strong>Тоҷик Академия</strong> яке аз сомонаи бузургтарини дарсии Тоҷикистон мебошад. Ҳадаф аз кушодани
                           сомоно кумак ба шахсоне аст, ки мехоҳанд дарсҳои пешрафтаин даруни ва дунёро биомузанд.
                       </p>
                   </div>
               </div>
               <div class="col-lg-6">
                   <img src="{{ asset('images/logo.png') }}" alt="Тоҷик Академия" width="60%" class="logo-welcome">
               </div>
           </div>
        </div>
    </section>


    {{--  Some link to main products  --}}
    <section class="products">
        <div class="container">
            <h2 class="section-title">Бо мо биомуз</h2>
            <div class="boxes">
                <div class="card">
                    <h3 class="center">Забони Руси</h3>
                    <p>
                        Дар сомонаи мо шумо забони руси онлайн меомузед.
                        Ҳамаи луғатҳо ва ибораҳоро метавонед талафузашро гуш кунед. Луғатҳо бо категорияҳо мебошад.
                    </p>
                    <div class="links">
                        <a class="link"  href="">
                            Омузиши Луғатҳо
                        </a>
                        <a class="link"  href="">
                            Омузиши Ибораҳо
                        </a>
                    </div>
                </div>
                <div class="card">
                    <h3 class="center">Забони Англиси</h3>
                    <p>
                        Дар сомонаи мо шумо забони Англисиро низ онлайн ва бо категорияҳои лозими меомузед.
                        Ҳамат луғатҳо ва ибораҳоро метавонед тарзи талафузашро гуш кунед.
                    </p>
                    <div class="links">
                        <a class="link"  href="">
                            Омузиши Луғатҳо
                        </a>
                        <a class="link"  href="">
                            Омузиши Ибораҳо
                        </a>
                    </div>
                </div>
                <div class="card">
                    <h3 class="center">Саволу ҷавоб</h3>
                    <p>
                        Саволу ҷавоб ин беҳтарин роҳ барои рушди дониш мебошад.
                        Дар сомонаи мо метавонед савол гузоред ва ба саволҳо ҷавоб диҳед.
                        Саволҳо категорияи худашро доранд
                    </p>
                    <div class="links">
                        <a class="link-1"  href="">
                            Саҳифаи Саволҳо
                        </a>
                    </div>
                </div>
                <div class="card">
                    <h3 class="center">Мавзӯҳои дарсӣ</h3>
                    <p>
                        Мавзуҳои гунугуни дарси дар сомонаи мо нашр мешава содда фаҳмонда.
                        Мавзуҳо аз категорияҳо иборат мебошанд ба монанди Математика, Руси, Англиси
                        ва ғайра
                    </p>
                    <div class="links">
                        <a class="link-1"  href="">
                            Саҳифаи мавзӯҳо
                        </a>
                    </div>
                </div>
                <div class="card">
                    <h3 class="center">Хабарҳои нав</h3>
                    <p>
                        Дар сомона хабарҳои нави аз сомона, тоҷикистон ва дунё нашр мешавад.
                        Мо талош мекунем ки хабарҳои навро ба шумо расон аз дунёи илму техналогия.
                    </p>
                    <div class="links">
                        <a class="link-1"  href="">
                            Саҳифаи Хабарҳо
                        </a>
                    </div>
                </div>
                <div class="card">
                    <h3 class="center">Тестҳои ММТ</h3>
                    <p>
                        Дар сомоно тестҳои маркази миллии тести гузошта мешавад. Шумо метавонед онлайн тестҳо кор кунед
                        ва балҳои худро бубинед. Тестҳо аз ҳамаи фанҳо мебошад.
                    </p>
                    <div class="links">
                        <a class="link-1"  href="">
                           Саҳифаи тестҳо
                        </a>
                    </div>
                </div>

                <div class="card">
                    <h3 class="center">Видеоҳои дарсӣ</h3>
                    <p>
                        Мо видеоҳои дарси дар шабака мегузорем. Мо низ youtube канал дорем дар онҷо низ
                        видеоҳои дарси гузошта мешавад. Видеҳо низ категорияҳои худашро дорад.
                    </p>
                    <div class="links">
                        <a class="link-1"  href="">
                            Саҳифаи тестҳо
                        </a>
                    </div>
                </div>


                <div class="card">
                    <h3 class="center">Бозиҳои ҷолиб</h3>
                    <p>
                        Дар шабака мо бозиҳои ҷолиб тартиб медиҳем ба монанди тестҳо ва ҷаводиҳандаҳои беҳтарин ва ба
                        шахсоне ки ҷойҳои хубро ишғол карданд туҳфаҳо дода мешавад.
                    </p>
                    <div class="links">
                        <a class="link-1"  href="">
                            Саҳифаи тестҳо
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>




    {{--    Serive (our work)--}}
    <section class="service" id="service">
        <div class="container">
            <h2 class="section-title">Корҳои мо</h2>
            <div class="row justify-between">
                <div class="long-cart col-lg-6 col-sm-12" data-0="left: -1000px; transition: 0.4s" data-700="left: 0">
                    <div class="text-cart">
                        <a href="https://www.youtube.com/c/tojikacademy">
                            <h3 class="cart-title red">Youtube</h3>
                        </a>
                        <p>
                            Моро дар ютуб зиёда аз 12 500 нафар тамошо мекунад ва аз дарсҳои мо бениҳоят хушҳол ва сипосгузоранд. Шумо низ бо мо бипайвандед то аз дарсҳои нав огаҳ бошед.
                            Ба тугмаи поён зер кунеду ба шабакаи мо дар youtube обуна шавед.
                        </p>
                        <a href="https://www.youtube.com/c/tojikacademy" class="btn-a">Youtube-и мо</a>
                    </div>
                    <a href="https://www.youtube.com/c/tojikacademy"   class="block-img">
                        <img src="{{ asset('images/youtobe.png') }}" alt="Тоҷик Академия омузиши дарсҳо">
                    </a>
                </div>

                <div class="long-cart col-lg-6 col-sm-12" data-100="left: 1000px;  transition: 0.4s" data-1000="left: 0px; transition: 0.4s">
                    <div class="text-cart" >
                        <a href="https://www.instagram.com/tojikacademy">
                            <h3 class="cart-title"><span style="color:  #bc1888">Instagram</span></h3>
                        </a>
                        <p>
                            Дар инстаграмм мо видеоҳои хурд ва аксҳои дарси дорем.
                            Бо обуна шудан дар Инстаграми мо шумо луғатҳои нав меомузед бо аксҳои ҷолиб.
                            Луғатҳои забони Русӣ ва Англисӣ мегузорем дар онҷо.
                        </p>
                        <a href="https://www.instagram.com/tojikacademy" class="btn-a ins">instagram-и мо</a>
                    </div>
                    <a href="https://www.instagram.com/tojikacademy"   class="block-img">
                        <img src="{{ asset('images/insta.png') }}" alt="">
                    </a>
                </div>

                <div class="long-cart col-lg-6 col-sm-12" data-0="left: -1000px; transition: 0.4s" data-700="left: 0">
                    <div class="text-cart">
                        <a href="{{ route('english') }}"><h3 class="cart-title">Забони Англисӣ</h3></a>
                        <p>
                            Як аз корҳои ассоси мо ин дарсҳои забони Англисӣ мебошад.
                            Мо дарсҳои онлайни дорем, ки шумо метавонед биомузед ва талаффузи калимаҳоро
                            гуш кунед. Луғат омузи ва ибора омузи айни ҳол омода  барои истифода аст.
                        </p>
                        <div class="d-flex" style="z-index: 111;">
                            <a href="{{ route('english-words') }}" class="btn-a ang">Омузиши Луғатҳо</a>
                            <a href="{{ route('english') }}" class="btn-a ang">Омузиши Ибораҳо</a>
                        </div>
                    </div>
                    <a href="{{ route('english') }}"   class="block-img">
                        <img src="{{ asset('images/english.png') }}" alt="">
                    </a>
                </div>

                <div class="long-cart col-lg-6 col-sm-12" data-center-center="opacity: 1; top: 0;  transition: 0.5s" data-0-bottom="top: 1000px; opacity: 1; transition: 0.4s">
                    <div class="text-cart">
                        <a href="{{ route('russian') }}"><h3 class="cart-title">Забони Русӣ</h3></a>
                        <p>
                            Омузиши забони Русӣ дар сомонаи мо осон ва бо категорияҳои лозима сохта шудааст.
                            Дар сомона луғатҳо ва ибораҳои забони Русиро онлайн ва бо машқҳо меомузед.
                            Ҳангоми анҷом додани машқҳо шумо метавонед талаффузҳои калимаҳоро гуш кунед.
                        </p>
                        <div class="d-flex" style="z-index: 111;">
                            <a href="{{ route('russian') }}" class="btn-a ru">Омузиши Луғатҳо</a>
                            <a href="{{ route('russian-words') }}" class="btn-a ru">Омузиши Ибораҳо</a>
                        </div>
                    </div>
                    <a href="#youtube"   class="block-img">
                        <img src="{{ asset('images/russian.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{--   OUR SPONSORS  --}}
    <section class="dark">
        <div class="container">
            <h2 class="section-title">Сарпарастони мо</h2>
            <p  class="white">Дустоне ки барои пешрафти шабакаи дарси саҳми худро мегузоранд!</p>
            <br>
            <div class="content">
                <div class="owl-carousel owl-theme">
                    @for($i = 0; $i < 6; $i++)
                        <div>
                            <div class="sponsor">
                                <div class="name-img">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/1024px-User_icon_2.svg.png" alt="">
                                    <a href="#instagram">Name LastName</a>
                                </div>
                                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, blanditiis earum expedita
                                perspiciatis repellendus voluptates. Beatae consequatur cum
                            </span>
                                <a href="#instagram" class="btn-a ins">Instagram</a>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="all-sponsor-btn">
                    <a href="#all" class="btn-a light">Ҳамаи спонсорҳо</a>
                </div>
            </div>
        </div>
    </section>

    {{--    Client say about us--}}
    <section class="clients-sey">
        <div class="container max-width">
            <h2 class="section-title">Истифода барандагони  мо чи мегуянд</h2>
            <div class="content">
                @for($i = 0; $i < 4; $i++)
                    <div class="told">
                        <div class="name-img">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/1024px-User_icon_2.svg.png" alt="">
                            <h4>Юлия С</h4>
                        </div>
                        <p>Спасибо! Подсела на ваш канал,😊👍. У вас милый акцент. Я пытаюсь учить язык Дари по учебнику Островского Б.на котором говорят в Афганистане ,трудно,но интересно)) А теперь смотрю ваши видео и  замечаю много знакомых слов, которые успела выучить,мне это даже помогает.</p>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    {{--    Мавзуъҳо--}}
    <section class="articles">
        <div class="container">
            <h2 class="section-title">Хабарҳои нав</h2>
            <div class="content row">
                @forelse($articles as $article)
                    <div class="col-lg-6">
                        @foreach($article as $articleData)
                            <div class="article row">
                                <div class="img col-lg-3 col-md-5"
                                     style="border-right: 1px solid #ccc; padding: 0;"
                                >
                                    <a href="/articles/{{ $articleData->slug }}">
                                        <img src="{{ $articleData->smallImage() }}" alt="{{ Str::limit($articleData->title, 50, '...') }}">
                                    </a>
                                </div>
                                <div class="text col-lg-9 col-md-7 p-0">
                                    <a href="/articles/{{ $articleData->slug }}" class="article-title upper mb-6"><h4>{{ $articleData->title }}</h4></a>
                                    <p class="des">{{ Str::limit($articleData->description, 100, '...') }}</p>
                                    <div class="d-flex justify-between p-5 mt-6">
                                        <a href="/articles/{{ $articleData->slug }}" class="btn-article">Муфассал</a>
                                        <small>{{ $articleData->date->format('d-m-Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p>Ҳоло мавзуъҳо нест</p>
                @endforelse
            </div>
        </div>
    </section>

    {{--    Answer and question --}}
    <x-questions-section :questions="$questions" :link="true"></x-questions-section>
@endsection
