@extends('layout.easy')
@section('keywords', 'Воридшави, логин, дохишлшудан ба сайт')
@section('title', "Тоҷик Академия - Воридшавӣ (логин).")
@section('description', 'Воридшудан ба сомона. Хушомадед хушҳолем ки бо мо ҳастед.')

@section('content')
    <section class="page">
        <div id="register">
            <div class="content">
                <div class="text">
                    <h3 class="fs-27 bold m-4"><i class="fas fa-sign-in-alt"></i> Воридшавӣ!</h3>
                    <br>
                    <p>Хушомадед дубора.</p>
                </div>
                <br>
                <form id="register-form" method="POST" action="{{ route('login') }}">
                    @error('error') <span class="red">{{ $message }}</span> @enderror
                    @if(Session::has('email_verify'))
                        <div class="bg-info p-10">
                            <p class="white">{{ Session::get('email_verify') }}</p>
                        </div>
                    @endif
                    @csrf
                    <div class="form-item">
                        <label for="email" class="input-label">Почтаи электронии:</label>
                        <input type="email" class="input" name="email" id="email" value="{{ old('email') }}" placeholder="example@gmail.com">
                        @error('email') <span class="red">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-item">
                        <label for="password" class="input-label">Рамз:</label>
                        <input type="password" id="password" class="input" name="password" placeholder="Рамз барои ворид шудан ба сайт">
                    </div>
                    <div class="form-item">
                        <button type="submit" id="register-btn" class="btn-b"  style="background: #111111">Воридшави</button>
                    </div>
                </form>
                <a href="{{ route('register') }}"  class="change-login" id="login">Бақайдгирӣ</a>
                <div  class="p-10">
                    <div class="d-flex justify-center"><p>Дигар шабакаҳои мо</p></div>
                    <div class="socials">
                        <a href="#"><i class="fab fa-youtube youtube"></i></a>
                        <a href="#"><i class="fab fa-facebook-square facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram instagram"></i></a>
                        <a href="#"><i class="fab fa-odnoklassniki okclass"></i></a>
                        <a href="#"><i class="fab fa-vk vk"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
