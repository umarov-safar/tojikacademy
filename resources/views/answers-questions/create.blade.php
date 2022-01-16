@extends('layout.app')


@section('css')
    <link href="{{ asset('packages/summernote/dist/summernote-lite.min.css') }}" rel="stylesheet">
@endsection

@section('js_head')
    <script src="{{ asset('packages/summernote/dist/summernote-lite.js') }}"></script>
@endsection

@section('content')
    <div class="question-page">
        <section class="page">
            <div class="container">
                <div class="max-width">
                        <div class="content">
                            <div class="text-question-page center">
                                <h1>Саволе доред?</h1>
                                <h3>Марҳамат дар сайти мо пурсед ба зуди истифода барандагон ба шумо ҷавоб медиҳанд!</h3>
                            </div>
                            <div class="form">
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
                                        {{-- form section --}}
                                        <form action="{{route('questions.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-item">
                                                <label class="input-label" for="title">Савол:</label>
                                                <input type="text" name="title" class="input" id="title" value="{{old('title')}}" placeholder="Саволатонро дар инҷо нависед...">
                                                @error('title')
                                                    <spam class="red">{{ $message  }}</spam>
                                                @enderror
                                            </div>
                                            <div class="form-item">
                                                <label class="input-label" for="summernote">Шарҳи савол:</label>
                                                <textarea name="body" id="summernote" class="textarea" cols="30"  placeholder="Шарҳи савол..." rows="7">{{ old('body') }}</textarea>
                                            </div>
                                            <div class="form-item">
                                                 <label class="input-label" for="category">Савол дар бораи: </label>
                                                 <select class="input" name="category" id="category">
                                                     @forelse($categories as $category)
                                                         <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                     @empty
                                                     @endforelse
                                                 </select>
                                                @error('category') <span class="red">{{ $message }}</span> @enderror
                                             </div>
                                            <br>
                                            <div class="form-item-flex">
                                                 <button class="btn-b" type="submit">Пурсидан</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <x-questions-section :questions="$questions"></x-questions-section>

                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection



@section('js_bottom')
    <script>
        $(document).ready(function(){
            $('#summernote').summernote({
                placeholder: 'Шарҳи савол дар инҷо ...',
                tabsize: 2,
                height: 250,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol']],
                    ['insert', ['link', 'picture']],
                ]
            });
        });
    </script>
@endsection
