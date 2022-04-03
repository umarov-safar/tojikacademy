@extends('layout.app')

@section('title', 'Тоҷик Академия - Корбар - '. $user->fullName())
@section('description', $user->fullName() . " таърихи ба қайдгири дар самона " . $user->created_at . '. Шумо низ дар сомонаи мо обуна шавед ва ба монанди ин истифода барандагон дастраси ба имконоти сомона дошта бошед!')
@section('url', request()->url())
@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div>
                    <h1 class="m-3">{{ $user->fullName() }}</h1>
                    <span>Рузи бақайдгири: {{ $user->created_at->format('d-m-Y') }}</span>
                </div>
                <img loading="lazy" src="{{ asset($user->image_sizes['650x650'] ?? $user->image_sizes['460x460'] ?? $user->avatar ?? \App\Models\User::DEFAULT_IMAGE) }}"
                     class='radius-10'
                     width="500"
                     alt="{{ $user->fullName() }}">

                {{-- changing photo --}}
                <form action="{{ route('changeAvatar', $user->id) }}" method="POST" enctype="multipart/form-data">
                    <p class="green d-block">{{ session()->get('successPhoto') ?? '' }}</p>
                    <p class="red d-block">{{ session()->get('errorPhoto') ?? '' }}</p>
                    @csrf
                    @method('PUT')
                    <div class="form-item center">
                        <label for="avatar" class="input-label file inline-block btn bg-lightblue">Тағири акас</label>
                        @error('avatar')
                            <p class="red">Лутфан танҳо акс интихоб кунед!</p>
                        @enderror
                        <input type="file"  class="input hidden-imp" name="avatar" id="avatar" placeholder="Акасатонро интихоб кунед" >
                        <br>
                        <img id="avatar-preview" class="m-10" src="/{{ @$user->image_sizes['100x100'] ?? \App\Models\User::DEFAULT_IMAGE }}" width="100" height="90" alt="">
                        <br>
                        <button class="input-label inline-block btn-b white">Тағири акас</button>
                    </div>
                </form>

            </div>
            <div class="col-lg-6">

                @if(auth()->check() && auth()->id() === $user->id)

                    {{-- User data form --}}
                    <form id="register-form" method="POST" action="{{ route('updateUser', $user->id) }}" enctype="multipart/form-data">
                        <p class="green d-block">{{ session()->get('success') ?? '' }}</p>
                        <p class="red d-block">{{ session()->get('error') ?? '' }}</p>
                        @csrf
                        @method('PUT')
                        <div class="form-item">
                            <label for="name" class="input-label">Ному насаб</label>
                            <input type="text" id="name" class="input @error('name') border-red @enderror" value="{{ $user->name }}" name="name" placeholder="Номатонро нависед..." >
                            @error('name')
                            <p class="red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label for="username" class="input-label">Номи корбари бо Англиси</label>
                            <input type="text"
                                   class="input @error('username') border-red @enderror"
                                   name="username"
                                   id="username"
                                   value="{{ $user->username }}"
                                   placeholder="Мисол: safar2000, username ...">
                            @error('username')
                            <p class="red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label for="email" class="input-label">Почтаи электронӣ</label>
                            <input type="email" class="input @error('email') border-red @enderror" name="email" id="email" value="{{ $user->email }}" placeholder="example@gmail.com">
                            @error('email')
                            <p class="red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label for="password" class="input-label">Рамзи нав</label>
                            <input type="password"
                                   id="password"
                                   class="input @error('password') border-red @enderror"
                                   name="password"
                                   placeholder="Рамз барои ворид шудан ба сайт" >
                            @error('password')
                            <p class="red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label for="password_confirmation" class="input-label">Рамзро такрор нависед</label>
                            <input type="password" class="input @error('password_confirmation') border-red @enderror" name="password_confirmation" id="password_confirmation" placeholder="Рамзро дубора нависед" >
                            @error('password_confirmation')
                            <p class="red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <button type="submit" id="register-btn" class="btn-b">Тағири маълумот</button>
                        </div>
                    </form>
                @endif

                @if($user->questions()->count() > 0)
                    <x-questions-section :questions="$user->questions" :text="'Саволҳо аз ' . $user->fullName()"></x-questions-section>
                @endif
            </div>
        </div>
    </div>

@endsection
