@extends('layout.app')

@section('content')
       <div class="questions-page page">
           <section class="center">
               <div class="container">
                   <div class="max-width">
                     <div class="parent-content">
                        <div class="content">
                            <div class="text-question-page">
                                <p class="fs-22 bold mb-7">Агар саволе дошта бошед дар сайти мо пурсед истифода барандагон ба шумо ҷавоб медиҳанд.</p><br>
                                <a href="{{route('questions.create')}}" id="ask-question" class="btn-b">Савол додан!</a>
                            </div>
                            <br>
                               <div class="list-category">
                                    <ul class="list">
                                        @forelse($categories as $category)
                                            @if(isset($_GET['category']) && $category->id == $_GET['category'])
                                                <li class="li-item"><a class="a-item bg-lightblue" href="{{ route('questions.index', ['category' => $category->id]) }}">{{$category->name}}</a></li>
                                            @else
                                                <li class="li-item"><a class="a-item" href="{{ route('questions.index', ['category' => $category->id]) }}">{{$category->name}}</a></li>
                                            @endif
                                        @empty
                                            <h1>Аввалин шуда савол гузоред!</h1>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                     </div>
                   </div>
               </div>
           </section>

        {{--  Questions section  --}}
           <x-questions-section :questions="$questions"></x-questions-section>
       </div>
@endsection


