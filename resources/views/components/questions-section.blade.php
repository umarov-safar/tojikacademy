<section id="questions" class="question">
    <div class="container max-width">
        <div class="w-100  left-t">
            <h2 class="section-title">{{ isset($text) ? $text : 'Саволҳои охирин' }}</h2>
        </div>
        <div class="content">
            @forelse($questions as $question)
                <div class="asked">
                    {{--    Full name, img date     --}}
                    <div class="name-img d-flex justify-between">
                        <div class="d-flex align-center">
                            <img style="border-radius: 30% !important;" 
                                 src="{{ asset($question->user->image_sizes['100x100'] ?? $question->user->avatar)}}" 
                                 alt="{{'Савлдиҳанда '. $question->user->fullName() }}" 
                                 class="mr-3"
                                 width="40"
                                 >
                            <div class="name">
                                <h4 class="mb-3">
                                    <a href="{{ route('users.show', $question->user->id)}}">
                                        {{ $question->user->fullName() }}
                                    </a>
                                </h4>
                                <small class="ml-2">{{ $question->formattedDate() }}</small>
                            </div>
                        </div>
                        @if(Auth::check() && $question->askedByCurrentUser(Auth::user()))
                            <div class="d-flex">
                                <form action="{{ route('questions.destroy', $question->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button class="delete-btn danger m-3"><i class="far fa-trash-alt"></i></button>
                                </form>
                                <form action="{{ route('questions.edit', $question->id) }}" >
                                    @csrf
                                    <button class="edit-btn m-3"><i class="far fa-edit"></i></button>
                                </form>
                            </div>
                        @endif
                    </div>

                    {{--     title    --}}
                    <a href="{{ route('show-question', ['category' => $question->category->slug, 'slug' => $question->slug]) }}" class="ques">
                        {{ $question->title }}
                    </a>
                    <div class="d-flex justify-between align-center  flex-wrap">
                        <div class="icons d-flex align-center">
                            @if(Auth::check())
                                <div class="d-flex align-center">
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


                            <a href="{{ route('show-question', ['category' => $question->category->slug, 'slug' => $question->slug]) }}" class="comment">
                                <i class="fas fa-comment"></i>
                                <small class="answers-count">{{ $question->answers->count() }}</small>
                            </a>
                            <a class="answer-btn" href="{{ route('show-question', ['category' => $question->category->slug, 'slug' => $question->slug]) }}">
                                Ҷавоб додан
                            </a>
                        </div>
                        <a class="question-category-link" href="{{ route('question-category', $question->category->slug) }}">#{{ $question->category->name }}</a>
                    </div>
                </div>
            @empty
                <div class='d-block'>
                    <p>Саволе гузошта нашудааст!</p>
                    <br>
                    <a href="{{ route('questions.create') }}" class="btn-b">Аввалин шуда савол гузоред</a>
                </div>
            @endforelse
            <br>
            @isset($link)
                    <a class="btn-b" href="{{ route('questions.index') }}">Ҳамаи саволҳо</a>
            @endisset

            @if($questions instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class='paginate-quesiton d-flex justify-center'>
                    {{ $questions->links('vendor.pagination.default') }}
                </div>
            @endif
        </div>
    </div>
</section>
