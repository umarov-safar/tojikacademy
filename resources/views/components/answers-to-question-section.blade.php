<section id="answers" class="question">
    <div>
        <br>
        <h2>Ҷавобҳо</h2>
        <div class="content">
            @forelse($answers as $answer)

                <div class="asked">
                    {{--    Full name, img date     --}}
                    <div class="name-img d-flex justify-between">
                        <div class="d-flex align-center">
                            <img style="border-radius: 30% !important;" src="{{ asset($answer->user->image_sizes['100x100'] ?? $answer->user->avatar ?? \App\Models\User::DEFAULT_IMAGE) }}" alt="{{ $answer->title  }}" class="mr-3">
                            <div class="name">
                                <h4 class="mb-3">
                                    <a href="{{  route('users.show', $answer->user->id) }}">
                                        {{ $answer->user->fullName() }}
                                    </a>
                                </h4>
                                <small class="ml-2">{{ $answer->formattedDate() }}</small>
                            </div>
                        </div>

                        @if(Auth::check() && $answer->answeredByCurrentUser(Auth::user()))
                            <div class="d-flex">
                                <form action="{{ route('answers.destroy', $answer->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button class="delete-btn danger m-3"><i class="far fa-trash-alt"></i></button>
                                </form>
                                <form action="{{ route('answers.edit', $answer->id) }}" >
                                    @csrf
                                    <button class="edit-btn m-3"><i class="far fa-edit"></i></button>
                                </form>
                            </div>
                        @endif
                    </div>

                    {{--     answer    --}}
                    <div class="answer-level-1">
                        <div class="answer-body">
                            {!! $answer->answer !!}
                        </div>
                            <div class="comment-form">
                                <form action="{{ route('answers.store') }}" method="POST" enctype="multipart/form-data" class="hidden">
                                @csrf
                                    <div class="form-item">
                                        <label class="input-label" for="answer"><p class="bold" >Ҷавоби шумо:</p></label>
                                        @error('answer')
                                        <p class="red">{{ $message }}</p>
                                        @enderror
                                        <textarea name="answer"
                                                  class="textarea"
                                                  cols="30"
                                                  rows="4"
                                                  data-editor="summernote"
                                                  placeholder="Ҷавобатонро инҷо нависед... "
                                                  required
                                        ></textarea>
                                    </div>
                                    <input type="hidden" name="answerable_id" value="{{ $answer->id }}">
                                    <input type="hidden" name="answerable_type" value="answer">
                                    <input type="hidden" name="parent_id" value="{{ $answer->id }}">
                                    <button class="btn">Ҷавоб додан</button>
                                    <button class="btn" onclick="closeAnswerToAnswerForm(this)">Пушидан</button>
                                </form>
                            <button class="btn show-btn mt-5" onclick="showAnswerToAnswerForm(this)">Ҷавоб додан</button>
                        </div>
                    </div>

                    <div class="d-flex justify-between align-center">
                        <div class="icons d-flex align-center">
                            @if(Auth::check())
                                <div class="d-flex  align-center">
                                    {{--  if user liked --}}
                                    @if($answer->userLiked(Auth::id()))
                                        <form action="{{ route('destroy_like', $answer->getIdLikedByUser(Auth::id())->id) }}" method="POST" class="form-like">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="" name="id">
                                            <button class="like-btn green"><i class="fas fa-thumbs-up"></i></button>
                                            <small class="like-count green">{{ $answer->likes->count() }}</small>
                                        </form>
                                    @else
                                        <form action="{{ route('like') }}" method="POST" class="form-like">
                                            @csrf
                                            <input type="hidden" value="{{ $answer->id }}" name="likeable_id">
                                            <input type="hidden" value="answer" name="likeable_type">
                                            <button class="like-btn"><i class="fas fa-thumbs-up"></i></button>
                                            <small class="like-count">{{ $answer->likes->count() }}</small>
                                        </form>
                                    @endif

                                    {{--  if user disliked --}}
                                    @if($answer->userDisLiked(Auth::id()))
                                        <form action="{{ route('destroy_like', $answer->getIdDisLikedByUser(Auth::id())->id) }}" method="POST" class="form-like">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{ $answer->id }}" name="likeable_id">
                                            <input type="hidden" value="answer" name="likeable_type">
                                            <button class="like-btn green"><i class="fas fa-thumbs-down"></i></button>
                                            <small class="like-count green">{{ $answer->dislikes->count() }}</small>
                                        </form>
                                    @else
                                        <form action="{{ route('dislike') }}" method="POST" class="form-like">
                                            @csrf
                                            <input type="hidden" value="{{ $answer->id }}" name="likeable_id">
                                            <input type="hidden" value="answer" name="likeable_type">
                                            <button class="like-btn"><i class="fas fa-thumbs-down"></i></button>
                                            <small class="like-count">{{ $answer->dislikes->count() }}</small>
                                        </form>
                                    @endif
                                </div>
                                {{-- if user is not log in --}}
                            @else
                                <div class="d-flex  align-center">
                                    <form action="{{ route('like') }}" method="POST" class="form-like">
                                        @csrf
                                        <input type="hidden" value="{{ $answer->id }}" name="likeable_id">
                                        <input type="hidden" value="answer" name="likeable_type">
                                        <button class="like-btn"><i class="fas fa-thumbs-up"></i></button>
                                        <small class="like-count">{{ $answer->likes->count() }}</small>
                                    </form>
                                    <form action="{{ route('dislike') }}" method="POST" class="form-like">
                                        @csrf
                                        <input type="hidden" value="{{ $answer->id }}" name="likeable_id">
                                        <input type="hidden" value="answer" name="likeable_type">
                                        <button class="like-btn"><i class="fas fa-thumbs-down"></i></button>
                                        <small class="like-count">{{ $answer->dislikes->count() }}</small>
                                    </form>
                                </div>
                            @endif
                        {{-- <a class="answer-btn white"  href="#" style="background: #22524b">Ҷавоб додан</a> --}}
                        </div>
                    </div>

                    {{-- answers to answer --}}
                    <div class="answer-level-2">
                        <x-answers-to-answer-section :answers="$answer->answers" :parent="$answer"></x-answers-to-answer-section>
                    </div>

                </div>
            @empty
                <p>Аввалин шуда ҷавоб гузоред</p>
            @endforelse

        </div>
    </div>
</section>

