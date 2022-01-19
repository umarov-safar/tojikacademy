@extends('layout.app')
@section('title', "Саволу ҷавоб дар сомонаи Тоҷик Академия. Саволҳо бо ҷавобҳояшон.")
@section('keywords', 'Ҳамаи саволҳо, саволҳои нав, саволҳои куҳна, чигуна, аз куҷо. саволҳои имруз')
@section('description', 'Оё саволе доред ё мехоҳед ба саволҳо ҷавоб диҳед? Дар сомонаи Тоҷик Академия шумо метавонед савол пурсед ва ба саволҳо ҷавоб диҳед. Корбарони сомона ба саволи шумо зуд ҷавоб хоҳанд дод')
@section('image', asset('images/questions.jpg'))
@section('url', request()->url())

@section('content')
<div class="questions-page page">
   <div class="max-width">
      <div class="d-flex flex-wrap" id="questions-content">
                <div class="categories">
                    <ul>
                       <li><a class="text">Категорияи саволҳо</a></li>
                       @foreach ($categories as $category)
                       <li>
                           <a href="{{ route('question-category', $category->slug) }}">{{ $category->name }}</a>
                       </li>
                       @endforeach
                    </ul>
                 </div>
         {{--  Questions section  --}}
         <div class="questions">
            <br>
            <div class="d-flex justify-between content-top">
                <div class="orders">
                    <a href="{{ route('questions.index') }}/?orderWith=desc">Саволҳои нав</a>
                    <a href="{{ route('questions.index') }}/?orderWith=asc">Саволҳои куҳна</a>
                    <a href="{{ route('questions.index') }}/?orderWith=month">Саволҳои ин моҳ</a>
                    <a href="{{ route('questions.index') }}/?orderWith=day">Саволҳои имруз</a>
                </div>
                <div class=''>
                    <a href="{{ route('questions.create') }}" class="btn-b">Савол пурсидан</a>
                </div>
            </div>
             <x-questions-section :questions="$questions" :text="'Саволҳои навтарин'"></x-questions-section>
         </div>
      </div>
   </div>
</div>
@endsection
