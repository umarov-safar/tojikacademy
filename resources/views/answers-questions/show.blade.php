@extends('layout.app')

@section('title', $question->title )
@section('keywords', 'Савол ҷавоб, савол чавоб, чихел кунем, чигуна, аз кучо' . $question->category->name)
@section('description', Str::limit(strip_tags($question->body), 160, '...'))
@section('image', asset('images/question.jpg'))
@section('url', request()->url())

@section('css')
    <link href="{{ asset('packages/summernote/dist/summernote-lite.min.css') }}" rel="stylesheet">
@endsection

@section('js_head')
    <script src="{{ asset('packages/summernote/dist/summernote-lite.js') }}"></script>
@endsection

@section('content')
            <section class="question-page page">
                <div class="container p-10">
                    <div class="row">
                        <div class="col-lg-8" >
                            <div class="header-question">
                                <div class="d-flex align-center justify-between">
                                    {{--         name image               --}}
                                    <div class="name-img d-flex align-center p-7">
                                        <img style="border-radius: 30%"  src="{{ asset($question->user->image_sizes['100x100'] ?? $question->user->avatar) }}" width="64" class="ml-5">
                                        <div class="p-3">
                                            <a class="p-3" href="{{ route('users.show', $question->user->id) }}"><strong>{{ $question->user->fullName() }}</strong></a>
                                            <small class="p-3 d-block">{{ $question->formattedDate() }}</small>
                                        </div>
                                    </div>

                                    {{--  icons --}}
                                    <div class="icons d-flex align-center">
                                        @if(Auth::check())
                                            <div class="d-flex  align-center">
                                                {{--  if user liked --}}
                                                @if($question->userLiked(Auth::id()))
                                                    <form action="{{ route('destroy_like', $question->getIdLikedByUser(Auth::id())->id) }}" method="POST" class="form-like">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" value="" name="id">
                                                        <button class="like-btn green"><i class="fas fa-thumbs-up"></i></button>
                                                        <small class="like-count green">{{ $question->likes->count() }}</small>
                                                    </form>
                                                @else
                                                    <form action="{{ route('like') }}" method="POST" class="form-like">
                                                        @csrf
                                                        <input type="hidden" value="{{ $question->id }}" name="likeable_id">
                                                        <input type="hidden" value="question" name="likeable_type">
                                                        <button class="like-btn"><i class="fas fa-thumbs-up"></i></button>
                                                        <small class="like-count">{{ $question->likes->count() }}</small>
                                                    </form>
                                                @endif
                                                {{--  if user disliked --}}
                                                @if($question->userDisLiked(Auth::id()))
                                                    <form action="{{ route('destroy_like', $question->getIdDisLikedByUser(Auth::id())->id) }}" method="POST" class="form-like">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" value="{{ $question->id }}" name="likeable_id">
                                                        <input type="hidden" value="question" name="likeable_type">
                                                        <button class="like-btn green"><i class="fas fa-thumbs-down"></i></button>
                                                        <small class="like-count green">{{ $question->dislikes->count() }}</small>
                                                    </form>
                                                @else
                                                    <form action="{{ route('dislike') }}" method="POST" class="form-like">
                                                        @csrf
                                                        <input type="hidden" value="{{ $question->id }}" name="likeable_id">
                                                        <input type="hidden" value="question" name="likeable_type">
                                                        <button class="like-btn"><i class="fas fa-thumbs-down"></i></button>
                                                        <small class="like-count">{{ $question->dislikes->count() }}</small>
                                                    </form>
                                                @endif
                                            </div>
                                            {{-- if user is not log in --}}
                                        @else
                                            <div class="d-flex  align-center">
                                                <form action="{{ route('like') }}" method="POST" class="form-like">
                                                    @csrf
                                                    <input type="hidden" value="{{ $question->id }}" name="likeable_id">
                                                    <input type="hidden" value="question" name="likeable_type">
                                                    <button class="like-btn"><i class="fas fa-thumbs-up"></i></button>
                                                    <small class="like-count">{{ $question->likes->count() }}</small>
                                                </form>
                                                <form action="{{ route('dislike') }}" method="POST" class="form-like">
                                                    @csrf
                                                    <input type="hidden" value="{{ $question->id }}" name="likeable_id">
                                                    <input type="hidden" value="question" name="likeable_type">
                                                    <button class="like-btn"><i class="fas fa-thumbs-down"></i></button>
                                                    <small class="like-count">{{ $question->dislikes->count() }}</small>
                                                </form>
                                            </div>
                                        @endif
                                        @if(Auth::check() && $question->askedByCurrentUser(Auth::user()))
                                            <div class="d-flex">
                                                <form action="{{ route('questions.destroy', $question->id) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button class="delete-btn danger m-3"><i class="far fa-trash-alt"></i></button>
                                                </form>
                                                <form action="{{ route('questions.edit', $question->id) }}" >
                                                    @csrf
                                                    <button class="like-btn m-3"><i class="far fa-edit"></i></button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                {{-- question title --}}
                                <div class="w-100">
                                    <small class="ans"><i>Савол</i>:</small>
                                    <h1 class="question-title">{{ $question->title }}</h1>
                                </div>
                            </div>
                            <div class="question">
                                <small class="des mb-6 d-block"><i>Шарҳи савол:</i></small>
                                <div id="content">
                                    {!! $question->body !!}
                                </div>
                            </div>

                            {{--      answer form    --}}
                            <br>
                            <div class="comment-form">
                                <form action="{{ route('answers.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-item">
                                        <label class="input-label" for="answer"><h3>Ҷавоби шумо:</h3></label>
                                        @error('answer')
                                        <p class="red">{{ $message }}</p>
                                        @enderror
                                        <textarea name="answer" id="summernote" data-editor="summernote" class="textarea" cols="30" placeholder="Ҷавобатонро инҷо нависед... " rows="7"></textarea>
                                    </div>

                                    <input type="hidden" name="answerable_id" value="{{ $question->id }}">
                                    <input type="hidden" name="answerable_type" value="question">
                                    <button class="btn-b" id="create-btn" data-auth="login" type="submit">Ҷавоб додан</button>
                                </form>
                            </div>

                            {{--         answers            --}}
                            <x-answers-to-question-section :answers="$question->answers"></x-answers-to-question-section>
                        </div>

                        <div class="col-lg-4 tt-page">
                            <div class="categories">
                                <ul>
                                    <li><a class="text">Категорияи саволҳо</a></li>
                                    <li><a href="{{ route('questions.index') }}">Ҳамаи саволҳо</a></li>
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="{{ route('question-category', $category->slug) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <br>
                            <div class="mt-6" id="rcm-questions">
                                <x-questions-section :questions="$questions" :text="'Саволҳои дигар'"></x-questions-section>
                            </div>

                        </div>
                    </div>

                </div>
            </section>
@endsection


@section('js_bottom')
    <script>
        $(document).ready(function(){
            $('textarea[data-editor="summernote"]').summernote({
                placeholder: 'Ҷавоби шумо ...',
                tabsize: 2,
                height: 250,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    </script>
@endsection


