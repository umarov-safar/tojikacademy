@extends('layout.app')

@section('content')
    <section class="page">
        <div id="register">
            <div class="content">
                <div class="text center ">
                    <p class="fs-27 bold m-4">Интихоби беҳтарин</p>
                    <p class="fs-20 m-auto w-80">Бо обуна шудан ба сайти мо шумо ба ҳамаи ҷиз дар сайт дастраси меёбед.</p>
                </div>
                <br>
                <form id="register-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @error('message') <p class="red d-block">{{ $message }}</p> @enderror
                    @csrf
                    <div class="form-item">
                        <label for="name" class="input-label">Номи шумо</label>
                        <input type="text" id="name" class="input @error('name') border-red @enderror" value="{{ old('name') }}" name="name" placeholder="Номатонро нависед..." >
                        @error('name')
                        <p class="red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-item">
                        <label for="lastname" class="input-label">Насаби шумо</label>
                        <input type="text" class="input @error('last_name') border-red @enderror" name="last_name" id="lastname" value="{{ old('last_name') }}" placeholder="Насабаторо нависед..." >
                        @error('last_name')
                        <p class="red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-item">
                        <label for="email" class="input-label">Почтаи электронии шумо</label>
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
                        <label for="password_confirmation" class="input-label">Рамзи такрори</label>
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
                        <img id="avatar-preview" class="m-10" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/1024px-User_icon_2.svg.png" width="100" height="90" alt="">
                    </div>
                    <br>
                    <div class="form-item">
                        <button type="submit" id="register-btn" class="btn-b">Обуна шудан</button>
                    </div>
                </form>
                <a href="{{ route('login') }}"  class="change-login" id="login">Ман алакай ба қайд гирифтаам</a>
                <div  class="p-10">
                    <div class="d-flex justify-center"><p>Дигар шабакаҳои мо</p></div>
                    <div class="socials">
                        <a href="https://youtube.com/c/tojikacademy"><i class="fab fa-youtube youtube"></i></a>
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
