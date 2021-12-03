@extends('layout.app')

@section('css')
    <link href="{{ asset('packages/summernote/dist/summernote-lite.min.css') }}" rel="stylesheet">
@endsection

@section('js_head')
    <script src="{{ asset('packages/summernote/dist/summernote-lite.js') }}"></script>
@endsection

@section('content')
    <section class="question-page page">
        <div class="max-width p-10" style="background: #fdfdfd;">
            <div class="header-answer">
                @error('error')
                <p class="red">{{ $message }}</p>
                @enderror
                @error('slug')
                {{ $message }}
                @enderror
                @if(session()->has('message'))
                    <h4 class="green">{{ session()->get('message') }}</h4>
                @endif
            <div class="comment-form">
                <form action="{{ route('answers.update', $answer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-item">
                        <label class="input-label" for="answer"><h3>Тағири ҷавоб:</h3></label>
                        @error('answer')
                        <p class="red">{{ $message }}</p>
                        @enderror
                        <textarea name="answer"
                                  id="summernote"
                                  data-editor="summernote"
                                  class="textarea" cols="30"
                                  placeholder="Ҷавобатонро инҷо нависед..."
                                  rows="7"
                        >
                            {{ $answer->answer }}
                        </textarea>
                    </div>
                    <button class="btn-b" id="create-btn" data-auth="login" type="submit">Ҷавоб додан</button>
                </form>
            </div>

        </div>
    </section>
@endsection
