@extends('layout.app')

@section('title', 'Дарсҳои ' . $category->name )
@section('keywords', 'Дарсоҳои тоҷики, дарсҳои руси, дарҳои тест')
@section('description', 'Дарсҳои сода аз ' . $category->name . ' дар сомонаи Тоҷик Академия.')


@section('content')

    <section class="articles">
        <div class="container">
            <div class="content row">
                <h2 class="section-title">Дарсҳо аз {{ $category->name }}</h2>
                    @forelse($tutorials as $tutorial)
                    <div class="col-lg-6">
                        @foreach($tutorial as $item)
                            <div class="article row">
                                <div class="text p-0">
                                    <a href="/tutorials/{{ $item->category->slug }}/{{ $item->slug }}" class="article-title upper mb-6"><h4>{{ $item->title }}</h4></a>
                                    <div>
                                        <a href="/tutorials/{{ $item->category->slug }}/{{ $item->slug }}">
                                            <img src="/{{ $item->smallImage() }}" alt="{{ Str::limit($item->title, 50, '...') }}" />
                                        </a>

                                        <p class="des">{{ Str::limit($item->description, 100, '...') }}</p>
                                    </div>
                                    <div class="d-flex justify-between p-5 mt-6">
                                        <a href="/tutorials/{{ $item->category->slug }}/{{ $item->slug }}" class="btn-article">Муфассал</a>
                                        <small>{{ $item->date->format('d-m-Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @empty
                            <p>Ҳоло дарсе нест!</p>
                   @endforelse
            </div>
        </div>
    </section>

@endsection
