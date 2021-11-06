<section id="answers" class="question">
    <div class="container max-width">
        <h3>Ҷавобҳо</h3>
        <div class="content">
            @forelse($answers as $answer)
                <div class="asked">
                    {{--    Full name, img date     --}}
                    <div class="name-img d-flex justify-between">
                        <div class="d-flex align-center">
                            <img style="border-radius: 30% !important;" src="{{ asset($answer->user->imageSizes('100x100')) }}" alt="{{ $answer->title  }}" class="mr-3">
                            <div class="name">
                                <h4 class="mb-3">
                                    <a href="account/users/{{ $answer->user->id }}">
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
                                    <button class="like-btn danger m-3"><i class="far fa-trash-alt"></i></button>
                                </form>
                                <form action="{{ route('answers.edit', $answer->id) }}" >
                                    @csrf
                                    <button class="like-btn m-3"><i class="far fa-edit"></i></button>
                                </form>
                            </div>
                        @endif
                    </div>

                    {{--     title    --}}
                    <div>
                        {!! $answer->answer !!}
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

{{--                                <a class="answer-btn white"  href="#" style="background: #22524b">Ҷавоб додан</a>--}}
                        </div>
                    </div>
                </div>
            @empty
                <p>Аввалин шуда ҷавоб гузоред</p>
            @endforelse

        </div>
    </div>
</section>
