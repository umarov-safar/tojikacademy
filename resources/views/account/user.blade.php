@extends('layout.app')

@section('title', 'Тоҷик Академия - Корбар - '. $user->fullName())

@section('content')

    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="m-3">{{ $user->fullName() }}</h1>
                <img src="/{{ @$user->image_sizes['460x460'] ?? $user->avatar }}" class='radius-10' alt="{{ $user->fullName() }}">
            </div>
            <div class="col-lg-6">
                @if(auth()->check() && auth()->id() === $user->id)
                    <form id="register-form" method="POST" action="{{ route('updateUser', $user->id) }}" enctype="multipart/form-data">
                        @error('message') <p class="red d-block">{{ $message }}</p> @enderror
                        @csrf
                        @method('PUT')
                        <div class="form-item">
                            <label for="name" class="input-label">Номи корбарӣ</label>
                            <input type="text" id="name" class="input @error('name') border-red @enderror" value="{{ $user->name }}" name="name" placeholder="Номатонро нависед..." >
                            @error('name')
                            <p class="red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label for="lastname" class="input-label">Насаб</label>
                            <input type="text" class="input @error('last_name') border-red @enderror" name="last_name" id="lastname" value="{{ $user->last_name }}" placeholder="Насабаторо нависед..." >
                            @error('last_name')
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
                            <input type="password"  id="password" class="input @error('password') border-red @enderror" name="password"  placeholder="Рамз барои ворид шудан ба сайт" >
                            @error('password')
                            <p class="red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label for="password_confirmation" class="input-label">Рамзи такрориро нависед</label>
                            <input type="password" class="input @error('password_confirmation') border-red @enderror" name="password_confirmation" id="password_confirmation" placeholder="Рамзро дубора нависед" >
                            @error('password_confirmation')
                            <p class="red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label for="avatar" class="input-label file inline-block  p-3 bg-lightblue">Тағири акас акас</label>
                            @error('avatar')
                            <p class="red">{{ $message }}</p>
                            @enderror
                            <input type="file"  class="input hidden-imp" name="avatar" id="avatar" placeholder="Акасатонро интихоб кунед" >
                            <br>
                            <img id="avatar-preview" class="m-10" src="/{{ @$user->image_sizes['100x100'] ?? 'uploads/users/user.png' }}" width="100" height="90" alt="">
                        </div>
                        <div class="form-item">
                            <button type="submit" id="register-btn" class="btn-b">Тағири маълумот</button>
                        </div>
                    </form>
                @endif
                <x-questions-section :questions="$user->questions" :text="'Саволҳо аз ' . $user->fullName()"></x-questions-section>
            </div>


        </div>
    </div>

@endsection
