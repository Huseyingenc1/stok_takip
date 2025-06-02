<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="../assets/img/ikon2.svg" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/assets/vendor/css/pages/page-auth.css" />
    <script src="/assets/vendor/js/helpers.js"></script>
    <script src="/assets/js/config.js"></script>
</head>

<body>
    <div class="container-xxl">
        @if (session()->has('message'))
            <div class="alert alert-succes">
                {{ session()->get('message') }} <br>
            </div>
        @endif
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <img src="/assets/img/ikon29.png" alt="Resim bulunamadı" width="100%" >
                        </div>
                        <h4 class="mb-2">Hoş Geldiniz ! </h4>
                        <p class="mb-4">Lütfen hesabınıza giriş yapın ...</p>
                        @if ($errors->any())
                            <div class="row gap-3">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger small">
                                        {{ $error }} <br>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <form id="loginform" class="mb-3" action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Adres</label>
                                <input type="text" class="form-control" name="email" id="floatingInput"
                                    placeholder="Lütfen email adresinizi giriniz" autofocus />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Şifre</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                {{-- <button
                                    class="btn btn-primary d-grid w-100 product-giris-buton "onclick="disabledbutton(this)"
                                    type="button">Giriş Yap</button> --}}
                                <button class="btn btn-primary d-grid w-100 product-giris-buton " id="submitButton"
                                    onclick="disabledbutton(this)" type="button">Giriş Yap</button>
                            </div>
                        </form>
                        <p class="text-center">
                            <a href="{{ route('forgot_password') }}">
                                <small>
                                    Şifreni'mi unuttun ?
                                </small>
                            </a>
                        </p>
                        <p class="text-center">
                            veya
                        </p>
                        <a href="{{ route('register.post') }}" class="d-flex justify-content-center">
                            <small>
                                Kayıt ol
                            </small>
                        </a>
                        <span class="app-brand-link gap-sm-0  text-muted">
                            <img src="/assets/img/GNCTurco_Logo.png" alt="Resim bulunamadı" width="50"
                                class="">
                            <small class="text-center"><strong class="text-center"> HÜSEYİN GENÇ </strong>  Tarafından
                            Üretilmiştir... © 2025 </small>
                        </span>
                    </div>
                </div>
            </div>
            <script>
                window.addEventListener('keyup', function(keyboardEvent) {
                    if (keyboardEvent.keyCode === 13) {
                        let button = document.getElementById('submitButton');
                        disabledbutton(button);
                    }
                });

                function disabledbutton(e) {
                    console.log(e);
                    e.setAttribute('disabled', 'disabled');
                    document.getElementById('loginform').submit();
                }
            </script>
            <script src="/assets/vendor/libs/jquery/jquery.js"></script>
            <script src="/assets/vendor/libs/popper/popper.js"></script>
            <script src="/assets/vendor/js/bootstrap.js"></script>
            <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
            <script src="/assets/vendor/js/menu.js"></script>
            <script src="/assets/js/main.js"></script>
            <script async defer src="https://buttons.github.io/buttons.js"></script>
            {{-- <script>
        const input = document.querySelector('#floatingInput');
        const button = document.querySelector('.product-giris-buton');
        button.disabled = true; // butonu varsayılan olarak devre dışı bırak
        input.addEventListener('input', function() {
            if (input.value.trim() !== '') { // inputta yazı varsa butonu etkinleştir
                button.disabled = false;
            } else {
                button.disabled = true; // inputta yazı yoksa butonu devre dışı bırak
            }
        });
    </script> --}}
</body>

</html>
