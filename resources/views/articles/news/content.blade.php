@extends('layout.app')

@section('title', $news->title )
@section('keywords', 'Савол ҷавоб, савол чавоб, чихел кунем, чигуна, аз кучо')
@section('description', $news->meta_description ?? $news->description)

@section('content')

    <div class="container news-page">
        <div class="row">
            {{-- article data--}}
            <div class="col-lg-8">
                <h1 class="title">{{ $news->title }}</h1>
                <p class="p-4">{{ $news->description }}</p>
                <article>
                    <img src="/{{ $news->image }}" alt="" />
                    {!! $news->content !!}
                </article>

                {{-- recomended news --}}
                <br>
                    <section class="articles">
                    <h2 class="section-title">Хабарҳои дигар</h2>
                    @forelse($recommendedNews as $article)
                        <div class="article row">
                            <div class="text p-0">
                                <a href="/news/{{ $article->slug }}" class="article-title upper mb-6"><h4>{{ $article->title }}</h4></a>
                                <div>
                                    <a href="/news/{{ $article->slug }}">
                                        <img src="/{{ $article->smallImage() }}" alt="{{ Str::limit($article->title, 50, '...') }}" width="100"/>
                                    </a>
                                    <p class="des">{{ Str::limit($article->description, 150, '...') }}</p>
                                </div>
                                <div class="d-flex justify-between p-5 mt-6">
                                    <a href="/news/{{ $article->slug }}" class="btn-article">Муфассал</a>
                                    <small>{{ $article->date->format('d-m-Y') }}</small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Ҳоло мавзуъҳо нест</p>
                    @endforelse
                    </section>
            </div>


            {{--category tutorials--}}
            <div class="col-lg-4">
                <div class="categories">
                    <ul>
                        <li><a class="text">Рӯйхати мавзӯҳои дарсӣ</a></li>
                    @forelse($tutorialCategory->children as $child)
                        <li>
                            <a href="/tutorials/{{ $child->slug }}">{{ $child->name }}</a>
                        </li>
                    @empty

                    @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </div>

@endsection
