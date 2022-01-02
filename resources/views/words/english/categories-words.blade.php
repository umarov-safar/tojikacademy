@extends('layout.app')


@section('title', 'Луғатҳои забони Англиси бо категория лозими | Тоҷик Академия' )
@section('keywords', 'Ҳамаи луғатҳои руси, омузиши луғатҳои руси, луғатҳои бо категория')
@section('description', 'Мехоҳед луғатҳои забони Англисиро биомузед аммо намеонед аз чи шуруъ кунед? Талафузаш душвор аст? Мо ба шумо кумак мекунем ҳамаи луғатҳо дар категория хоси худ мебошад бо талафузаш.')
@section('image', asset('images/english.png'))
@section('url', route('english-words'))

@section('content')
    <section id="russian-words" class="english page">
        <div class="container max-width">
            <h2>Омузиши луғатҳои забони Англиси Онлайн</h2>
            <div class="content-description">
                <p>Омузиши луғатҳои забони руси аз сифр бо тарзи талафуз ва категорияҳои лозими!</p>
                <p>Интихоб  кунед дар бораи чи  луғат меомузед</p>
            </div>
            <br>
            <div class="col-lg-7 m-auto" id="word-categories-parent">
                <div class="word-categories">
                    @foreach($wordCategories as $wordCategory)
                        <div class="category">
                            <a href="{{ route('english-words') }}/{{$wordCategory->slug}}" >
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
