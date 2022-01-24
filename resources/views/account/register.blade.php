@extends('layout.easy')
@section('keywords', 'Ҳамаи саволҳо, саволҳои нав, саволҳои куҳна, чигуна, аз куҷо. саволҳои имруз')
@section('title', "Тоҷик Академия - Бақайдгирӣ. Aккаунт сохтан.")
@section('description', 'Дар сомонаи мо обуна шавед то ба ҳамаи имконоти сайт дастраси ёбед. Аккаунти худро созед маълумотҳои шахсии худро нигоҳ доред ва бо дигарон суҳбат кунед дар сомона')
@section('url', request()->url())

@section('content')
    <section class="page">
        <div id="register">
            <div class="content">
                <div class="text ">
                    <h1><i class="fas fa-user-plus"></i> Бақайдгирӣ</h1>
                    <br>
                    <p class="fs-20 m-auto">Бо обуна шудан ба сомона шумо ба ҳамаи имконоти сомона дастраси меёбед!.</p>
                </div>
                <br>
                <form id="register-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @error('message') <p class="red d-block">{{ $message }}</p> @enderror
                    @csrf
                    <div class="d-flex" style="gap: 3px">
                        <div class="form-item">
                            <label for="name" class="input-label">Номи корбарӣ</label>
                            <input type="text" id="name" class="input @error('name') border-red @enderror" value="{{ old('name') }}" name="name" placeholder="Номатонро нависед..." >
                            @error('name')
                            <p class="red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label for="lastname" class="input-label">Насаб</label>
                            <input type="text" class="input @error('last_name') border-red @enderror" name="last_name" id="lastname" value="{{ old('last_name') }}" placeholder="Насабаторо нависед..." >
                            @error('last_name')
                            <p class="red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="email" class="input-label">Почтаи электронӣ</label>
                        <input type="email" class="input @error('email') border-red @enderror" name="email" id="email" value="{{ old('email')}}" placeholder="example@gmail.com">
                        @error('email')
                        <p class="red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-item">
                        <label for="password" class="input-label">Рамз</label>
                        <input type="password"  id="password" class="input @error('password') border-red @enderror" name="password" placeholder="Рамз барои ворид шудан ба сайт" >
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
                        <label for="avatar" class="input-label file white btn-b inline-block" style="font-style: normal">Интихоби акас</label>
                        @error('avatar')
                        <p class="red">{{ $message }}</p>
                        @enderror
                        <input type="file"  class="input hidden-imp" name="avatar" id="avatar" placeholder="Акасатонро интихоб кунед" >
                        <br>
                        <img id="avatar-preview" class="m-10" src="{{ asset('images/user.png') }}" width="100" height="90" alt="">
                    </div>
                    <br>
                    <div class="form-item">
                        <button type="submit" id="register-btn" class="btn-b" style="background: #111111">Обуна шудан</button>
                    </div>
                </form>
                <a href="{{ route('login') }}"  class="change-login" id="login">Ман алакай ба қайд гирифтаам</a>
                <div  class="p-10">
                    <div class="d-flex justify-center"><p>Дигар шабакаҳои мо</p></div>
                    <div class="socials">
                        <a href="https://youtube.com/c/tojikacademy" target="_blank"><i class="fab fa-youtube youtube"></i></a>
                        <a href="https://instagram.com/tojikacademy" target="_blank"><i class="fab fa-instagram instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook-square facebook"></i></a>
                        <a href="#"><i class="fab fa-odnoklassniki okclass"></i></a>
                        <a href="#"><i class="fab fa-vk vk"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
