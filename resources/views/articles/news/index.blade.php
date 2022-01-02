@extends('layout.app')

@section('title', 'Хабарҳои муҳими Тоҷикисто, Ҷаҳон ва илму техналогия аз Тоҷик Академия')
@section('keywords', 'Дарсоҳои тоҷики, дарсҳои руси, дарҳои тест')
@section('description', 'Дар сомонаи Тоҷик Академия хабарҳои тоза ва лозима гузошта мешавад барои мардуми тоҷик')
@section('url', url('news'))

@section('content')
<section class="articles tt-page">
    <div class="container">
        <div class="content row">
            <div class="col-lg-8">
                <h2 class="section-title">Хабарҳои Нав</h2>
                @forelse($allNews as $news)
                <div class="article row">
                    <div class="text p-0">
                        <a href="{{ route('news-content', ['category'=>$news->cat_slug, 'slug' =>  $news->slug]) }}"
                           class="article-title upper mb-6">
                            <h4>{{ $news->title }}</h4>
                        </a>
                        <div>
                            @php
                                $image = json_decode($news->image_sizes, true);
                            @endphp
                            <a href="{{ route('news-content', ['category'=>$news->cat_slug, 'slug' =>  $news->slug]) }}">
                                <img src="/{{ $image['200x200'] ?? $news->image }}" alt="{{ Str::limit($news->title, 50, '...') }}" />
                            </a>

                            <p class="des">{{ Str::limit($news->description, 100, '...') }}</p>
                        </div>
                        <div class="d-flex justify-between p-5 mt-6">
                            <a href="{{ route('news-content', ['category'=>$news->cat_slug, 'slug' =>  $news->slug]) }}" class="btn-article">Муфассал</a>
                            <small>{{ $news->date }}</small>
                        </div>
                    </div>
                </div>
                @empty
                <p>Ҳоло дарсе нест!</p>
                @endforelse
                <div class='paginate-quesiton d-flex justify-center'>
                    {{ $allNews->links('vendor.pagination.default') }}
                </div>
            </div>

            {{-- category of tutorials --}}
            <div class="col-lg-4">
                {{--category tutorials--}}
                <div class="categories">
                    <ul>
                        <li><a class="text">Рӯйхати мавзӯҳои дарсӣ</a></li>
                     @foreach($tutorialCategory->children as $child)
                        <li>
                            <a href="{{ route('news-category', $child->slug) }}">{{ $child->name }}</a>
                        </li>
                     @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
