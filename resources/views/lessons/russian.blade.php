@extends('layout.app')

@section('title', 'Омузиши забони Руси Онлайн - Ибораҳои забони Руси барои нав омузон')
@section('description', ' Онлайн омузиши забони Руси бо талафузи калимаҳо осон ва сода. Шумо бо машқ забони русиро мемузед. Ибораҳои забони Руси барои суҳбат кардан. ')
@section('keywords', 'Омузишӣ забони Русӣ, Забонӣ Руси, Дарсҳои забони Руси, Онлайн забони русӣ')
@section('image', asset('images/russian.png'))
@section('url', route('russian'))

@section('content')
    <section id="russian-description" class="english page">
    <div class="container max-width">
        <h1>Омузиши забони Руси Онлайн</h1>
        <div class="content-description">
            <h3>Тарзи истифода бурдан!</h3>
            <p class="desc">Интихоб кунед чанто машқ мекунед 10, 20 ё беохир. Дар машқҳо ҷумлаҳои ноҷоро ҷобаҷой карда як ҷумлаи дуруст месозед ва мефаҳмед ки луғатҳо дар
                ҷумла чигуна истифода мешаванд. Баъди ба итмом расонидани машқ мефаҳмед чанто дуруст ва чанто нодуруст ҷавоб додаед. Ва ҳаминхел шумо метавонед фикру назарҳои худро гузоред (коммент) агар хатогии
                бошад метавонед дар ҷумлаҳо нависед мо ислоҳ мекунем</p>
            <div class="choose">
                <a  onclick="howManyTask(10)" class="btn-a">10 Машқ</a>
                <a onclick="howManyTask(20)" class="btn-a">20 Машқ</a>
                <a  onclick="howManyTask('infinity', this)" class="btn-a infinity">Беохир</a>
            </div>
        </div>
    </div>
    </section>
    <section class="learning hidden" id="russian-exercise">
        <div class="container p-sm2-0">
            <div class="content">
                <div class="counter">
                    <div class="percent"></div>
                </div>
                <h3 id="demo-text-tajik">Hoops something wrong</h3>
                <div class="demo-real" id="demo-real">
                    <div class="words" id="choice-demo-words">
                        {{--      Demo for real words  buttons          --}}
                    </div>
                </div>
                <div class="demo-random" id="demo-random">
                    <div class="words" id="random-demo-words">
                        {{--      Demo for random words buttons            --}}
                    </div>
                </div>
                <p class="message" style="margin-top: 10px;">
                    <br>
                </p>
                <div class="demo-btn">
                    <div class="next-show">
                        <button id="show" class="show btn-tsk activeBtn">Ҷавоб</button>
                        <button id="next" class="next btn-tsk">Баъди</button>
                    </div>
                    <div class="finishedBtn hidden">
                        <button id="showAllAnswer" class="show btn-tsk activeBtn">Дидани ҷавобҳо</button>
                        <button id="newTask" class="next btn-tsk activeBtn">Аз нав!</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="showAllAnswer hidden">
            <div class="box">
                <h3 class="center white">Ҷавобҳои дурст!</h3>
                <div class="answers-demo p-10" id="allAnswer">
                    {{--   Load here from js --}}
                </div>
            </div>
            <button  class="btn-b" style="margin: 5px;" onclick="closeAllAnswer()">Пушидан</button>
        </div>
    </section>


    {{-- question section --}}
    <x-questions-section :questions="$questions" :text="'Саволҳо аз з. Русӣ'"></x-questions-section>

@endsection

@section('js_bottom')
    <script src="{{asset('js/lessons/russian.js')}}"></script>
@endsection
