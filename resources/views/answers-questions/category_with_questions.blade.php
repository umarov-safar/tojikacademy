@extends('layout.app')

@section('content')
    <section class="question-category">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <x-questions-section :questions="$questions" :text="'Саволҳо аз ' . $category->name"></x-questions-section>
                </div>
                <div class="col-lg-4 tt-page">
                    <div class="categories">
                        <ul>
                            <li><a class="text">Категорияи саволҳо</a></li>
                            <li><a href="{{ route('questions.index') }}">Ҳамаи саволҳо</a></li>
                        @foreach ($categories as $category)
                            <li>
                               <a href="{{ route('question-category', $category->slug) }}">{{ $category->name }}</a>
                            </li>
                           @endforeach
                        </ul>
                     </div>
                </div>
            </div>
        </div>
    </section>
@endsection
