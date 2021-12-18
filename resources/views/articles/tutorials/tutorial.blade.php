@extends('layout.app')

@section('title', $tutorial->title )
@section('keywords', 'Савол ҷавоб, савол чавоб, чихел кунем, чигуна, аз кучо')
@section('description', $tutorial->meta_description ?? $tutorial->description)

@section('content')

    <div class="container tt-page">
        <div class="row">
            {{-- article data--}}
            <div class="col-lg-8">
                <h1 class="title">{{ $tutorial->title }}</h1>
                <p class="p-4">{{ $tutorial->description }}</p>
                <article>
                    <img src="/{{ $tutorial->image }}" alt="" />
                    {!! $tutorial->content !!}
                </article>
                
                <br>
                <div class='tags'>
                   @if (count($tutorial->tags) > 0)
                    <h4>Тагҳои ҳамонанд</h4>
                    <div class="d-flex" style="gap: 5px;">
                        @foreach ($tutorial->tags as $tag)
                            <a href="{{ route('tags', $tag->slug) }}" class="tag">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                   @endif
                </div>
                
                {{-- recomended news --}}
                <br>
                    @if (count($reletedTutotrials) > 0)
                    <section class="articles">
                        <h2 class="section-title">Дарсҳои дигар аз {{ $tutorial->category->name }}</h2>
                        @forelse($reletedTutotrials as $article)
                            <div class="article row">
                                <div class="text p-0">
                                    <a href="/tutorials/{{ $article->category->slug }}/{{ $article->slug }}" class="article-title upper mb-6"><h4>{{ $article->title }}</h4></a>
                                    <div>
                                        <a href="/tutorials/{{ $article->category->slug }}/{{ $article->slug }}">
                                            <img src="/{{  $article->image_sizes['200x200'] ?? $article->image  }}" alt="{{ Str::limit($article->title, 50, '...') }}" width="100"/>
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


            <div class="col-lg-4">
                {{--category tutorials--}}
                <div class="categories">
                    <ul>
                        <li><a class="text">Рӯйхати мавзӯҳои дарсӣ</a></li>
                     @foreach($tutorialCategory->children as $child)
                        <li>
                            <a href="/tutorials/{{ $child->slug }}">{{ $child->name }}</a>
                        </li>
                    @endforeach
                    </ul>
                </div>
                {{-- recommended tutorials --}}
                <br><br>
                @if (count($recommendedTutorials) > 0)
                    <section class="articles">
                        <h2>Дигар дарсҳо барои шумо!</h2>
                        @forelse($recommendedTutorials as $article)
                            <div class="article row">
                                <div class="text p-0">
                                    <a href="/tutorials/{{ $article->category->slug }}/{{ $article->slug }}" class="article-title upper mb-6"><h4>{{ $article->title }}</h4></a>
                                    <div>
                                        <a href="/tutorials/{{ $article->category->slug }}/{{ $article->slug }}">
                                            <img src="/{{  $article->image_sizes['200x200'] ?? $article->image  }}" alt="{{ Str::limit($article->title, 50, '...') }}" width="100"/>
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
