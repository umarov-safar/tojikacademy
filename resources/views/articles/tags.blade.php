@extends('layout.app')

@section('title', 'Тагҳои дарси ва хабари аз ' . $tag->name)
@section('keywords', 'Дарсоҳои тоҷики, дарсҳои руси, дарҳои тест, хабарҳои нави тоҷикистон ва ҷаҳон')
@section('description', 'Тагҳо аз ' . $tag->name . ' дар сомонаи Тоҷик Академия. Дар сайти мо аз ' . $tag->name . ' дарсҳо ва хабарҳои зиёд аст.')
@section('url', request()->url())

@section('content')
<section class="articles tt-page">
    <div class="container p-sm2-0">
        <div class="content row">
            <div class="col-lg-8">
                <h2 class="section-title center">Тагҳо аз {{ $tag->name }}</h2>
                @forelse($articles as $article)
                <div class="article row">
                    <div class="text p-0">
                        <a href="/{{ request('parent') }}/{{ $article->category->slug }}/{{ $article->slug }}" class="article-title upper mb-6">
                            <h4>{{ $article->title }}</h4>
                        </a>
                        <div>
                            @php
                                $image = json_decode($article->image_sizes, true);
                            @endphp
                            <a href="/{{ request('parent') }}/{{ $article->category->slug }}/{{ $article->slug }}">
                                <img src="/{{ $image['200x200'] ?? $article->image }}" alt="{{ $article->title }}" />
                            </a>

                            <p class="des">{{ Str::limit($article->description, 100, '...') }}</p>
                        </div>
                        <div class="d-flex justify-between p-5 mt-6">
                            <a href="/{{ request('parent') }}/{{ $article->category->slug }}/{{ $article->slug }}" class="btn-article">Муфассал</a>
                            <small>{{ $article->date->format('d-m-Y') }}</small>
                        </div>
                    </div>
                </div>
                @empty
                <p>Ҳоло дарсе нест!</p>
                @endforelse
            </div>

            {{-- category of tutorials --}}
            <div class="col-lg-4">
                {{--category tutorials--}}
                <div class="categories">
                    <ul>
                        <li><a class="text">Рӯйхати мавзӯҳои дарсӣ</a></li>
                     @foreach($tutorialCategory->children as $child)
                        <li>
                            <a href="/{{ request('parent') }}/{{ $child->slug }}">{{ $child->name }}</a>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
