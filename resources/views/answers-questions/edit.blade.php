@extends('layout.app')


@section('css')
    <link href="{{ asset('packages/summernote/dist/summernote-lite.min.css') }}" rel="stylesheet">
@endsection

@section('js_head')
    <script src="{{ asset('packages/summernote/dist/summernote-lite.js') }}"></script>
@endsection

@section('content')
    <div class="question-page">
        <section class="center page">
            <div class="container" style="padding-top:  5px">
                <div class="max-width">
                    <div class="parent-content">
                        <div class="content">
                            <div class="text-question-page">
                                <h1>Тағири савол</h1>
                            </div>
                            <div class="category-and-form">
                                <div class="question-content">
                                    <div class="form-question">
                                        @error('error')
                                            <p class="red">{{ $message }}</p>
                                        @enderror
                                        @error('slug')
                                        {{ $message }}
                                        @enderror
                                        @if(session()->has('message'))
                                             <h4 class="green">{{ session()->get('message') }}</h4>
                                        @endif
                                        <form action="{{route('questions.update', $question->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-item">
                                                <label class="input-label" for="title">Савол</label>
                                                <input type="text" name="title" class="input" id="title" value="{{ $question->title }}" placeholder="Саволатонро дар инҷо нависед...">
                                                @error('title')
                                                    {{ $message  }}
                                                @enderror
                                            </div>
                                            <div class="form-item">
                                                <label class="input-label" for="summernote">Шарҳи савол</label>
                                                <textarea name="body" id="summernote" data-editor="sumernote" class="textarea" cols="30"  placeholder="Шарҳи савол..." rows="7">{{ $question->body }}</textarea>
                                            </div>
                                            <div class="form-item">
                                                 <label class="input-label" for="category">Савол дар бораи: </label>
                                                 <select class="input" name="category" id="category">
                                                     @foreach($categories as $category)
                                                         @if($category->id == $question->category->id)
                                                             <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                         @else
                                                             <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                         @endif
                                                     @endforeach
                                                 </select>
                                             </div>
                                            <br>
                                            <div class="form-item-flex">
                                                 <button class="btn-b" type="submit">Тағири савол</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
