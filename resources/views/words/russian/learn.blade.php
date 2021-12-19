@extends('layout.app')

@section('title', 'Омузи луғатҳои забони руси аз ' . $category->name)
@section('keywords', 'Омузиши забони руси, омузиши луғатҳои руси, луғатҳои мактаб')
@section('description', $category->descriptioin)

@section('content')
    <section class="learning" id="russian-word">
        <div class="container max-width">
            <div class="center">
                <h1 class="text-page">Омузиши луғатҳои забони руси дар бораи {{ $category->name }}</h1>
            </div>
            <div class="content">
                <h4 class="fs-24" id="end-message">
                    <span id="demo-text"></span>
                    <i class="fa fa-volume-up listen pointer"></i>
                </h4>
                <p class="message" style="margin-top: 10px;">
                </p>
                <div class="demo-random" id="demo-random">
                    <div class="words" id="random-demo-words">
                        {{--      Demo for random words buttons            --}}
                    </div>
                </div>
                <div class="next-show">
                    <button id="next" class="next btn-tsk">Баъди</button>
                </div>

                <br><br>
                {{--    links to others lessons      --}}
                <div class="links">
                    <a href="{{ route('russian-words') }}">Интихоби дигар категория</a>
                    <a href="https://youtube.com/c/tojikacademy">Видеоҳои Руси</a>
                    <a href="{{ route('english') }}">Омузиши ибораҳои з.Руси</a>
                </div>
            </div>
        </div>
@endsection


@section('js_bottom')

    <script>
        let words = @json($wordsArray);

        //text to speech
        $(document).click((e) => {
            textBtn = e.target;
            if(textBtn.classList.contains('listen')){
                let text = textBtn.parentElement.querySelector('span');
                textToSpeech(text.innerText, 'Google русский');
            }
        })
    </script>
    <script src="{{ asset('js/lessons/word/app.js') }}"></script>

@endsection
