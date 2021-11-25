@extends('layout.app')

@section('content')
    <section id="russian-words" class="english page">
        <div class="container max-width">
            <h2>Омузиши луғатҳои забони Руси Онлайн</h2>
            <div class="content-description">
                <p>Омузиши луғатҳои забони руси аз сифр бо тарзи талафуз ва категорияҳои лозими!</p>
                <p>Интихоб  кунед дар бораи чи кам луғат медонед</p>
            </div>
            <br>
            <div class="w-50 m-auto" id="word-categories-parent">
                <div class="word-categories">
                    @foreach($wordCategories as $wordCategory)
                        <div class="category">
                            <a href="{{ route('russian-words') }}/{{$wordCategory->slug}}" >
                                <img class="border-50"
                                     src="/{{ $wordCategory->image }}"
                                     alt="{{ $wordCategory->name }}">
                            </a>
                            <h3>{{ $wordCategory->name }}</h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
