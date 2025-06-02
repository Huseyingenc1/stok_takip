<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>PRODUCT TRACKING</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />
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


    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <div class="card">
                <div class="container-xxl">

                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <img src="/assets/img/ikon29.png" alt="Resim bulunamadı" width="100%" >
                        </div>
                        <h4 class="mb-2">Şifreni mi unuttun ? 🔒</h4>
                        <p class="mb-4">Hiç endişelenme önce mail adresini gir ve mailine gönderdiğimiz linke tıkla ve
                            şifreni anında yenile
                        </p>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form id="formAuthentication" class="mb-3" action="/forgot-password" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="mail@denem.com" autofocus />
                            </div>
                            <button class="btn btn-primary d-grid w-100">Linki Gönder</button>
                        </form>
                        <div class="text-center">
                            <span>Yada</span>
                            <a href="{{ route('login.get') }}" class="d-flex align-items-center justify-content-center">
                                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                Login'e geri dön
                            </a>
                        </div>
                        <span class="app-brand-link gap-sm-0  text-muted">
                            <img src="/assets/img/GNCTurco_Logo.png" alt="Resim bulunamadı" width="50"
                                class="">
                            <small class="text-center"><strong class="text-center"> HÜSEYİN GENÇ </strong> Tarafından
                                Üretilmiştir... © 2025 </small>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/assets/vendor/js/menu.js"></script>
    <script src="/assets/js/main.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
