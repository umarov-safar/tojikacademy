@extends('layout.app')

@section('content')
            {{-- description section --}}
            <section id="english-description" class="english page" >
                <div class="container max-width">
                    <h1>Омузиши забони Англиси Онлайн</h1>
                    <div class="content-description">
                        <h3>Истифода бурдан!</h3>
                        <p class="desc">Интихоб кунед чанто машқ мекунед 10, 20 ё беохир. Дар машқҳо ҷумлаҳои ноҷоро ҷобаҷой карда як ҷумлаи дуруст месозед ва мефаҳмед ки луғатҳо дар
                            ҷумла истифода мешаванд. Баъд ба итмом расонидани машқ мефаҳмед чанто дуруст ва чанто нодуруст ҷавоб додаед. Ва ҳаминхел шумо метавонед фикру назарҳои худро гузоред (коммент) агар хатогии
                            бошад метавонед дар ҷумлаҳо нависед мо ислоҳ мекунем</p>
                        <div class="choose">
                            <a id="english10" onclick="howManyTask(10)" class="btn-a">10 Машқ</a>
                            <a id="english20"  onclick="howManyTask(20)" class="btn-a">20 Машқ</a>
                            <a id="englishInfinity" onclick="howManyTask('infinity', this)" class="btn-a infinity">Беохир</a>
                        </div>
                    </div>
                </div>
            </section>

            {{-- exercies section --}}
            <section class="learning hidden" id="english-exercise" oncut="return false">
                <div class="container max-width">
                    <div class="content">
                        <h3 id="demo-text-tajik">Hoops something wrong</h3>
                        <div class="demo-real" id="demo-real">
                            <div class="words" id="choice-demo-words">
                                {{--      Demo for choice words         --}}
                            </div>
                        </div>
                        <div class="demo-random" id="demo-random">
                            <div class="words" id="random-demo-words">
                            {{--      Demo for random words         --}}
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
                                <button id="newTask" class="btn-tsk activeBtn" >Аз нав!</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="showAllAnswer hidden">
                    <div class="box">
                        <h3 class="center">Ҷавобҳои дурст!</h3>
                        <div class="answers-demo p-10" id="allAnswer">
                        {{--   Load here from js --}}
                        </div>
                    </div>
                    <button  class="btn-b" style="margin: 5px;" onclick="closeAllAnswer()">Пушидан</button>
                </div>
            </section>
            
            @if($questions)
            <x-questions-section :questions="$questions"></x-questions-section>
            @endif
@endsection


@section('js_bottom')
    <script src="{{asset('js/lessons/english.js')}}"></script>
@endsection
