@extends('layout.app')

@section('content')

    {{-- Description of website--}}
    <section class="page home">
        <div class="opacity">
            <div class="container max-width">
                <h1>Хуш омадед ба Тоҷик Академия</h1>
                <h3>Тоҷик Акдемия яке аз бузургтарин шабакаи дарсии дар Тоҷикистон мебошад!</h3>
                <p>Дар ин шабаки дарси шумо метавонед бисёр дарсҳои лозимаро биомузед аз ҷумла
                    <a href="{{ '/' }}"><span class="imp">Руси</span></a>,
                    <a href="{{ '/' }}"><span class="imp">Англиси</span></a>,
                    <a href=""><span class="imp">Информатика</span></a>,
                    <a href=""><span class="imp">Барномасози</span></a>,
                    <a href=""><span class="imp">Алгебра</span></a>
                    ва ғайра. Дар шабка мавзуҳои дарси ворид карда мешавад дар қисми <a href="#mavzuho"><span class="imp">Мавзуъҳо</span></a>.
                </p>
                <div class="links">
                    <a  href="{{ '/' }}" class="btn-a light">Руси</a>
                    <a href="{{ '/' }}" class="btn-a light">Англиси</a>
                    <a href="" class="btn-a light">Видеоҳо</a>
                    <a href="{{ '/' }}" class="btn-a light">С&Ҷ</a>
                </div>
                <div class="scroll">
                    <a href="#service">
                        Поён <br>
                        <i class='fas fa-arrow-down'></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{--    Serive (our work)--}}
    <section class="service" id="service">
        <div class="container max-width">
            <h2>Корҳои мо</h2>
            <div class="long-cart" data-0="left: -1000px; transition: 0.4s" data-700="left: 0">
                <div class="text-cart">
                    <a href="https://www.youtube.com/c/tojikacademy"><h3 class="cart-title">Мо дар <span class="imp">youtube</span> бисёр дарсҳои ҷолибу корбурд дорем.</h3></a>
                    <p>Моро дар ютуб зиёда аз 5020 нафар тамошо мекунад ва бениҳоят  рози ҳастанд аз дарсҳои  мо. Ту низ бо  мо бош ва аз дарсҳои мо бохабар бош. Ба тугмаи поён зеп кунеду ба канали мо равед.</p>
                    <a href="https://www.youtube.com/channel/UCgoPupJNkZPnAUPJvtPasdw" class="btn-a">Youtube-и мо</a>
                </div>
                <a href="https://www.youtube.com/c/tojikacademy"   class="block-img">
                    <img src="https://www.kindpng.com/picc/m/277-2770831_icon-social-media-and-icono-youtube-logo-png.png" alt="">
                </a>
            </div>

            <div class="long-cart" data-100="left: 1000px;  transition: 0.4s" data-1000="left: 0px; transition: 0.4s">
                <div class="text-cart" >
                    <a href="#youtube"><h3 class="cart-title">Мо дар <span class="imp">instagram</span> низ бисёр дарсҳо ва аксҳои  хубу дорем.</h3></a>
                    <p>Дар инстаграмм мо видеоҳои хурди дарси ва аксҳои дарси ки сохти худамон ҳаст пешниҳод мекунем.
                        Бисёр вақт луғатҳои нав меомузед бо мисол ва фаҳмондани хуб. Бо мо бош ва биомуз! Ссылкаи поён
                    </p>
                    <a href="#youtube" class="btn-a ins">instagram-и мо</a>
                </div>
                <a href="#youtube"   class="block-img">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDUBN_66LSw_yGYwuBWBCqIqCFHMA5b-e8oA&usqp=CAU" alt="">
                </a>
            </div>

            <div class="long-cart" data-0="left: -1000px; transition: 0.4s" data-700="left: 0">
                <div class="text-cart">
                    <a href="#youtube"><h3 class="cart-title">Яке аз асоси тарин дарсҳои мо ин дарси <span class="imp">Англиси</span> мебошад</h3></a>
                    <p>Мо дарсҳои Англиси бисёр хуб омода мекунем фаҳмо ва одди, аксари истифода барандагони шабакаи мо аз дарсҳо
                        бисёр рози ҳастанд. Мо зуд-зуд дар шабакаи <a href="#youtube"><span class="imp">youtube</span></a> худамон видео мегузорем ва низ дар инстаграму ин сайт</a>
                    </p>
                    <a href="#youtube" class="btn-a ang">Саҳифаи Аслӣ</a>
                </div>
                <a href="#youtube"   class="block-img">
                    <img src="https://m.media-amazon.com/images/S/aplus-media/vc/d2f0f91c-00c7-4345-bc04-2b792f6659b0.__CR0,0,970,300_PT0_SX970_V1___.png" alt="">
                </a>
            </div>

            <div class="long-cart" data-center-center="opacity: 1; top: 0;  transition: 0.5s" data-0-bottom="top: 1000px; opacity: 1; transition: 0.4s">
                <div class="text-cart">
                    <a href="#englsih"><h3 class="cart-title">Дарси забони <span class="imp">Руси</span> дар шабакаи мо</h3></a>
                    <p>Ногуфта намонад забони Руси ин яке лозиматарин забон барои мардуми мо мебошад барои кору тиҷораташон ва ҳамин хел мо низ барои
                        шумо дарсҳои руси омода кардаем одди ва лозими. Шумо дарсҳои моро метавонед дарю ютуб ва ҳам дар сайт бихонед ва биомузед.
                    </p>
                    <a href="#youtube" class="btn-a ru">Саҳифаи Аслӣ</a>
                </div>
                <a href="#youtube"   class="block-img">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcxv7d5T6VfTEnAjb_KXtD1lb7Uz8b6EDMmDcbl8u64csLhxNv4isKKIKbhEUxNPv7o1Q&usqp=CAU" alt="">
                </a>
            </div>
        </div>
    </section>

    {{--   OUR SPONSOR  --}}
    <section class="dark">
        <div class="container max-width">
            <h2>Спонсрҳои мо:)</h2>
            <p class="des">Дустоне ки барои пешрафти шабакаи дарси саҳми худро мегузоранд!</p>
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
            <h2>Истифода барандагони  мо чи мегуянд</h2>
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
        <div class="container max-width">
            <h2>Мавзуъҳо</h2>
            <div class="content">
                @for($i = 0; $i < 6; $i++)
                    <div class="article">
                        <div class="name-img">
                            <a href=""><img src="https://russkieslova.ru/wp-content/uploads/2020/10/idti.jpg" alt=""></a>
                            <a href="mavzuho/2133" class="title"><h3>ГЛАГОЛЫ ДВИЖЕНИЯ, урок 1 – ИДТИ-ХОДИТЬ, ЕХАТЬ-ЕЗДИТЬ</h3></a>
                        </div>
                        <p class="des">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci commodi culpa dicta dignissimos dolorem dolores, doloribus ea et facere in laboriosam laudantium minus, neque obcaecati odio quae rem sunt vitae.</p>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    {{--    Answer and question --}}
    <section id="questions" class="question">
        <div class="container max-width">
            <h2>Саволҳои охирин</h2>
            <div class="content">
                @forelse($questions as $question)
                    <div class="asked">
                        <div class="name-img">
                            <img src="{{ asset('avatars/' . $question->user->avatar) }}" alt="">
                            <h4><a href="#">{{$question->user->name}} {{$question->user->lastname}}</a></h4>
                        </div>
                        <div><a href="questions/{{$question->id}}" class="ques"><p>{{ $question->title  }}</p></a></div>
                        <div class="icons">
                            {{-- like section --}}
                            @if(Auth::check())
                                @if($question->likes->contains('user_id', Auth::user()->id))
                                    <a class="like-btn green" href="/like/remove/question/{{ $question->id }}">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span class="like-count">{{ $question->likes->count() }}</span>
                                    </a>
                                @else
                                    <a class="like-btn" href="/like/question/{{ $question->id }}">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span class="like-count">{{ $question->likes->count() }}</span>
                                    </a>
                                @endif
                                @if($question->dislikes->contains('user_id', Auth::user()->id))
                                    <a class="like-btn red" href="/like/remove/question/{{ $question->id }}">
                                        <i class="fas fa-thumbs-down"></i>
                                        <span class="like-count">{{ $question->dislikes->count() }}</span>
                                    </a>
                                @else
                                    <a class="like-btn" href="/dislike/question/{{ $question->id }}">
                                        <i class="fas fa-thumbs-down"></i>
                                        <span class="like-count">{{ $question->dislikes->count() }}</span>
                                    </a>
                                @endif
                            @else
                                <a class="like-btn not-allow">
                                    <i class="fas fa-thumbs-up"></i>
                                    <span class="like-count">{{ $question->likes->count() }}</span>
                                </a>
                                <a class="like-btn not-allow">
                                    <i class="fas fa-thumbs-down"></i>
                                    <span class="like-count">{{ $question->dislikes->count() }}</span>
                                </a>
                            @endif
                            <a href="{{ '/' }}/{{$question->id}}" class="comment">
                                <i class="fas fa-comment"></i>
                                <span class="answers-count">{{ $question->answers()->count() }}</span>
                            </a>
                            <a class="answer-btn" href="{{ '/' }}/{{$question->id}}">Ҷавоб додан</a>
                        </div>
                    </div>
                @empty
                    <p>Not quesitons are here</p>
                @endforelse
                <br>
                <a class="btn-b" href="{{ '/' }}">Ҳамаи саволҳо</a>
            </div>
        </div>
    </section>
@endsection
