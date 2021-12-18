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
                    <img src="/{{ $news->image_sizes['1200x900'] ?? $news->image }}" alt="" />
                    {!! $news->content !!}
                </article>
                
                <div class='tags'>
                    @foreach ($news->tags as $tag)
                        <a href="news/tags/{{ $tag->slug }}" class="tag">{{ $tag->name }}</a>
                    @endforeach
                </div>
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
                                        <img src="/{{ $article->image_sizes['200x200'] ?? $article->image }}" alt="{{ Str::limit($article->title, 50, '...') }}" width="100"/>
                                    </a>
                                    <p class="des">{{ Str::limit($article->description, 150, '...') }}</p>
                                </div>
                                <div class="d-flex justify-between p-5 mt-6">
                                    <a href="/news/{{ $article->slug }}" class="btn-article">Муфассал</a>
                                    <small>{{ $article->date }}</small>
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
                
                <br><br>
                {{-- recommended tutorials --}}
                @if (count($recommendedTutorials) > 0)
                <section class="articles">
                    <h2>Дигар дарсҳо барои шумо!</h2>
                    @forelse($recommendedTutorials as $article)
                        <div class="article row">
                            <div class="text p-0">
                                <a href="/tutorials/{{ $article->category->slug }}/{{ $article->slug }}" class="article-title upper mb-6"><h4>{{ $article->title }}</h4></a>
                                <div>
                                    <a href="/tutorials/{{ $article->category->slug }}/{{ $article->slug }}">
                                        <img src="/{{ $article->image_sizes['200x200'] ?? $article->image }}" alt="{{ Str::limit($article->title, 50, '...') }}" width="100"/>
                                    </a>
                                    <p class="des">{{ Str::limit($article->description, 150, '...') }}</p>
                                </div>
                                <div class="d-flex justify-between p-5 mt-6">
                                    <a href="/tutorials/{{ $article->category->slug }}/{{ $article->slug }}" class="btn-article">Муфассал</a>
                                    <small>{{ $article->date }}</small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Ҳоло мавзуе нест</p>
                    @endforelse
                    </section>
                @endif
            </div>

        </div>
    </div>

@endsection
