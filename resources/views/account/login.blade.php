@extends('layout.app')

@section('content')
    <section class="page">
        <div id="register">
            <div class="content">
                <div class="text center ">
                    <h3 class="fs-27 bold m-4">Хуш омадед дубора!</h3>
                    <div class="d-flex align-center justify-center p-3"><p class="title-form">Ворид шудан ба сайт</p></div>
                </div>
                <br>
                <form id="register-form" method="POST" action="{{ route('login') }}">
                    @error('error') <span class="red">{{ $message }}</span> @enderror
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
                        <button type="submit" id="register-btn" class="btn-b">Обуна шудан</button>
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
