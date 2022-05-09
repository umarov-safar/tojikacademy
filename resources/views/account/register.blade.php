@extends('layout.app')
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
                    @error('message')
                        <p class="red d-block">{{ $message }}
                    </p> @enderror
                    @csrf

                    <div class="form-item">
                        <label for="name" class="input-label">Ному насаб</label>
                        <input type="text" id="name"
                               class="input @error('name') border-red @enderror"
                               value="{{ old('name') }}" name="name"
                               placeholder="Мисол: Умаров Ҳусейн">
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
                               value="{{ old('username')}}"
                               placeholder="Мисол: safar2000, ahmad ...">
                        @error('username')
                            <p class="red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-item">
                        <label for="password" class="input-label">Рамзи махфи</label>
                        <input type="password"
                               id="password"
                               class="input @error('password') border-red @enderror"
                               name="password"
                               placeholder="Рамз барои ворид шудан ба сайт">
                        @error('password')
                            <p class="red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-item">
                        <label for="password_confirmation" class="input-label">Рамзи махфиро такрор нависед</label>
                        <input type="password"
                               class="input @error('password_confirmation') border-red @enderror"
                               name="password_confirmation" id="password_confirmation"
                               placeholder="Рамзро дубора нависед">
                        @error('password_confirmation')
                        <p class="red">{{ $message }}</p>
                        @enderror
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
