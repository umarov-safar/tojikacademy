@extends('layout.app')

@section('title', 'Саволҳо дар бораи - ' . $category->name )
@section('keywords', 'Савол ҷавоб, савол чавоб, чихел кунем, чигуна, саволҳои' . $category->name)
@section('description', $category->description)
@section('image', asset($category->image))

@section('content')
    <section class="question-category">
            
            <div class="container p-sm2-0">
                <div class="row">
                    <div class="col-lg-7">
                        <x-questions-section :questions="$questions" :text="'Саволҳо аз ' . $category->name"></x-questions-section>
                    </div>
        
                    <div class="col-lg-4">
                        <div class="tt-page">
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
            </div>

    </section>
@endsection
