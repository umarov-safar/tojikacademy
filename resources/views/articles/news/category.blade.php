@extends('layout.app')

@section('title', 'Хабарҳо аз ' . $category->name . ' дар сомонаи Тоҷик Академия')
@section('keywords', 'Хабарҳои тоҷикистон, Хабарҳои дунё, хабарҳои нав')
@section('description', 'Хабарҳои на аз ' . $category->name . ' дар сомонаи Тоҷик Академия. Ҳамеша дар хабар бошед бо мо.')
@section('url', request()->url())

@section('content')
<section class="articles tt-page">
    <div class="container">
        <div class="content row">
            <div class="col-lg-8">
                <h1 class="section-title">Хабарҳо аз {{ $category->name }}</h1>
                @forelse($newsS as $news)
                <div class="article row">
                    <div class="text p-0">
                        <a href="{{ route('news-content', ['category' => $news->cat_slug, 'slug' => $news->slug]) }}" class="article-title upper mb-6">
                            <h4>{{ $news->title }}</h4>
                        </a>
                        <div>
                             @php
                                $image = json_decode($news->image_sizes, true);
                            @endphp
                            <a href="{{ route('news-content', ['category' => $news->cat_slug, 'slug' => $news->slug]) }}">
                                <img src="/{{ $image['200x200'] ?? $news->image }}" alt="{{ Str::limit($news->title, 50, '...') }}" />
                            </a>

                            <p class="des">{{ Str::limit($news->description, 100, '...') }}</p>
                        </div>
                        <div class="d-flex justify-between p-5 mt-6">
                            <a href="{{ route('news-content', ['category' => $news->cat_slug, 'slug' => $news->slug]) }}" class="btn-article">Муфассал</a>
                            <small>{{ $news->date }}</small>
                        </div>
                    </div>
                </div>
                @empty
                <p>Ҳоло хабаре нест!</p>
                @endforelse
                <div class='paginate-quesiton d-flex justify-center'>
                    {{ $newsS->links('vendor.pagination.default') }}
                </div>
            </div>

            {{-- category of tutorials --}}
            <div class="col-lg-4">
                {{--category tutorials--}}
                <div class="categories">
                    <ul>
                        <li><a class="text">Категорияи Хабарҳо</a></li>
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
