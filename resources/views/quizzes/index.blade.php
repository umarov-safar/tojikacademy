@extends('layout.app')

@section('content')
    <section class="products bg-unset">
        <div class="container p-sm2-0">
            <h1 class="center">Категория тестҳо</h1>
            <br>

            <div class="boxes">
                @foreach($quizzesCategory as $quizCategory)
                    <a href="{{ route('startQuiz', $quizCategory->slug) }}">
                        <div class="card mx-w-0">
                            <h3 class="center">{{ $quizCategory->name }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
