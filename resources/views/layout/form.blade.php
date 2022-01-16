<section  id="auth-js" class="{{$errors->has('login') ? 'show-auth-js' : ''}}">
        <div class="form-auth">
            <div id="close-form">
                <i class="fa fa-times"></i>
            </div>
            <div id="message-form" class="message text-center"></div>
            <div class="auth-content">
                <div class="login section">
                    <div>
                        <p class="danger">@error('message') {{$message}} @enderror</p>
                        <form id="login-form" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="p-7 d-flex align-center justify-center"><h3 class="title-form">Ворид шудан ба сайт</h3></div>
                            <div class="form-item">
                                <label for="email"  class="input-label">Email ё ном</label>
                                <input type="email"  id="email" class="input" name="email" value="{{old('email') }}" placeholder="Email ё ном" required>
                            </div>
                            <div class="form-item">
                                <label for="password" class="input-label">Рамзи шумо</label>
                                <input type="password" id="password" id="password" class="input" name="password" placeholder="Рамзи шумо" required>
                            </div>
                            <div class="form-item">
                                <button  id="login-btn" class="btn-b">Ворид</button>
                            </div>
                        </form>
                        <a href="{{route('register')}}" class="change-login" id="sing-up">Обуна шудан ба сайт</a>
                        <div class="socials">
                            <a href="#"><i class="fab fa-youtube youtube"></i></a>
                            <a href="#"><i class="fab fa-facebook-square facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram instagram"></i></a>
                            <a href="#"><i class="fab fa-odnoklassniki okclass"></i></a>
                            <a href="#"><i class="fab fa-vk vk"></i></a>
                        </div>
                    </div>
                </div>
               {{-- <div class="register section hidden @error('register') block @enderror">
                    <form id="register-form" method="POST" action="#">
                        @csrf
                        <div class="p-7 d-flex align-center justify-center"><h3 class="title-form">Обуна шудан ба сайт</h3></div>
                        <div class="form-item">
                            <label for="name" class="input-label">Номи шумо</label>
                            <input type="text" id="name" class="input" value="{{ old('name') }}" name="name" placeholder="Номатонро нависед..." required>
                        </div>
                        <div class="form-item">
                            <label for="lastname" class="input-label">Насаби шумо</label>
                            <input type="text" class="input" name="lastname" id="lastname" {{ old('lastname') }} placeholder="Насабаторо нависед..." required>
                        </div>
                        <div class="form-item">
                            <label for="email" class="input-label">Почтаи электронии шумо</label>
                            <input type="email" class="input" name="email" id="email" {{ old('email') }} placeholder="example@gmail.com" required>
                        </div>
                        <div class="form-item">
                            <label for="password" class="input-label">Рамз</label>
                            <input type="password" id="password" class="input" name="password" placeholder="Рамз барои ворид шудан ба сайт" required>
                        </div>
                        <div class="form-item">
                            <label for="password_confirmation" class="input-label">Рамзро боз нависед</label>
                            <input type="password" class="input" name="password_confirmation" id="password_confirmation" placeholder="Рамзро дубора нависед" required>
                        </div>
                        <div class="form-item">
                            <button type="submit" id="register-btn" class="btn-b">Обуна шудан</button>
                        </div>
                    </form>
                    <a href="#"  class="change-login" id="login">Ворид шудан ба сайт</a>
                    <div class="socials">
                        <a href="#"><i class="fab fa-youtube youtube"></i></a>
                        <a href="#"><i class="fab fa-facebook-square facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram instagram"></i></a>
                        <a href="#"><i class="fab fa-odnoklassniki okclass"></i></a>
                        <a href="#"><i class="fab fa-vk vk"></i></a>
                    </div>
                </div> --}}
            </div>
        </div>
</section>

