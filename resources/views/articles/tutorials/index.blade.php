@extends('layout.app')

@section('title', 'Мавзуҳои Дарси дар сомонаи Тоҷик Академия')
@section('keywords', 'Дарсоҳои тоҷики, дарсҳои руси, дарҳои англиси,  тестҳои онлайн')
@section('description', 'Дарсҳои сода ва пуркорбурд дар сомонаи Тоҷик Академия. Мо зуд зуд дарс мегузорем дар сомона барои шумо.')
@section('url', url('tutorials'))

@section('content')
<section class="articles tt-page">
    <div class="container p-sm2-0">
        <div class="content row">
            <div class="col-lg-8">
                <h2 class="section-title center">Дарсҳои Гуногун</h2>
                @forelse($tutorials as $tutorial)
                <div class="article row">
                    <div class="text p-0">
                        <a href="/tutorials/{{ $tutorial->cat_slug }}/{{ $tutorial->slug }}" class="article-title upper mb-6">
                            <h4>{{ $tutorial->title }}</h4>
                        </a>
                        <div>
                            @php
                                $image = json_decode($tutorial->image_sizes, true);
                            @endphp
                            <a href="/tutorials/{{ $tutorial->cat_slug }}/{{ $tutorial->slug }}">
                                <img src="/{{ $image['200x200'] ?? $tutorial->image }}" alt="{{ Str::limit($tutorial->title, 50, '...') }}" />
                            </a>

                            <p class="des">{{ Str::limit($tutorial->description, 100, '...') }}</p>
                        </div>
                        <div class="d-flex justify-between p-5 mt-6">
                            <a href="/tutorials/{{ $tutorial->cat_slug }}/{{ $tutorial->slug }}" class="btn-article">Муфассал</a>
                            <small>{{ $tutorial->date }}</small>
                        </div>
                    </div>
                </div>
                @empty
                <p>Ҳоло дарсе нест!</p>
                @endforelse
                <div class='paginate-quesiton d-flex justify-center'>
                    {{ $tutorials->links('vendor.pagination.default') }}
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
                            <a href="/tutorials/{{ $child->slug }}">{{ $child->name }}</a>
                        </li>
                     @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
