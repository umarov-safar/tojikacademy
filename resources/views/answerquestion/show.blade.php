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
                    <div class="header-question">
                        <div class="d-flex align-center justify-between">
                            {{--         name image               --}}
                            <div class="name-img d-flex align-center p-7">
                                <img style="border-radius: 30%"  src="{{ asset($question->user->imageSizes('100x100')) }}" width="64" class="ml-5">
                                <div class="p-3">
                                    <a class="p-3" href="#"><strong>{{ $question->user->fullName() }}</strong></a>
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
                                                <button class="like-btn danger m-3"><i class="far fa-trash-alt"></i></button>
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
                    <br><br>
                    <div class="comment-form">
                        <form action="{{ route('answers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-item">
                                <label class="input-label" for="answer"><h3>Ҷавоби шумо:</h3></label>
                                <textarea name="body" id="summernote" class="textarea" cols="30" placeholder="Ҷавобатонро инҷо нависед... " rows="7"></textarea>
                            </div>
                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                            <button class="btn-b" id="create-btn" data-auth="login" type="submit">Ҷавоб додан</button>
                        </form>
                    </div>
                </div>
            </section>


            {{-- answers --}}
            <br>
            <br>
            <section class="max-width">
                <div class="answers">
                    <h2>Ҷавобҳо</h2>
                    @forelse($question->answers as $answer)
                        <div class="answer p-7">
                            <div class="name-img d-flex align-center">
                                <img src="{{ asset('avatars/' . $answer->user->avatar_path) }}"  width="50" alt="">
                                <h4 class="ml-4"><a href="#">{{$answer->user->name}} {{$answer->user->lastname}}</a></h4>
                            </div>
                            <div class="p-5 content">
                                <p>{!! $answer->body !!}</p>
                            </div>
                            <div class="icons">
                                {{-- like section --}}
                                @if(Auth::check())
                                    @if($answer->likes->contains('user_id', Auth::user()->id))
                                        <a class="like-btn green" href="/like/remove/answer/{{ $answer->id }}">
                                            <i class="fas fa-thumbs-up"></i>
                                            <span class="like-count">{{ $answer->likes->count() }}</span>
                                        </a>
                                    @else
                                        <a class="like-btn" href="/like/answer/{{ $answer->id }}">
                                            <i class="fas fa-thumbs-up"></i>
                                            <span class="like-count">{{ $answer->likes->count() }}</span>
                                        </a>
                                    @endif

                                    @if($answer->dislikes->contains('user_id', Auth::user()->id))
                                        <a class="like-btn red" href="/like/remove/answer/{{ $question->id }}">
                                            <i class="fas fa-thumbs-down"></i>
                                            <span class="like-count">{{ $answer->dislikes->count() }}</span>
                                        </a>
                                    @else
                                        <a class="like-btn" href="/dislike/answer/{{ $question->id }}">
                                            <i class="fas fa-thumbs-down"></i>
                                            <span class="like-count">{{ $answer->dislikes->count() }}</span>
                                        </a>
                                    @endif
                                @else
                                    <a class="like-btn not-allow">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span class="like-count">{{ $answer->likes->count() }}</span>
                                    </a>
                                    <a class="like-btn not-allow">
                                        <i class="fas fa-thumbs-down"></i>
                                        <span class="like-count">{{ $answer->dislikes->count() }}</span>
                                    </a>
                                @endif
                                <a class="answer-btn" href="{{ route('questions') }}/{{$question->id}}">Ҷавоб додан</a>
                            </div>
                        </div>
                    @empty
                        <h3>Аввалин шуда савол гузоред!</h3>
                    @endforelse
                </div>
            </section>

@endsection



@section('js_bottom')
    <script>
        $(document).ready(function(){
            $('#summernote').summernote({
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


