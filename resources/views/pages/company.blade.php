@extends('layout.app')
@section('title', $page->meta_title ?? $page->title)
@section('description', $page->meta_description)
@section('url', url($page->slug))


@section('content')
    <br>
    <div class="container">
        <h1>{{ $page->title }}</h1>
        <div class="col">
            {!! $page->content !!}
        </div>
    </div>
@endsection
