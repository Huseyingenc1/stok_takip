<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>PRODUCT TRACKING</title>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <div class="justify-content-center">
                                <img src="/assets/img/GNCTurco_logo.png" alt="Resim bulunamadı" width="40%" height="20%">
                            </div>
                        </div>
                        <h4 class="mb-2">Hoşgeldiniz 🚀</h4>
                        <p class="mb-4">Henüz Kayıt Oluşturmaıdnız mı ?</p>
                        @if (session()->has('message'))
                            <div class="alert alert-succes">
                                {{ session()->get('message') }} <br>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="row gap-3">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger small">
                                        {{ $error }} <br>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <form id="formAuthentication" class="mb-3" action="{{ route('register.post') }}"
                            method="POST" onsubmit="showConfirmation(event)">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Adınız Soyadınız</label>
                                <input type="text" class="form-control" id="username" name="name"
                                    placeholder="Adınız Soyadınız" autofocus />
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Telefon Numarası</label>
                                <input type="number" name="phone" id="phone" class="phone form-control"
                                    placeholder="01234567890">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Rolü</label>
                                <input type="text" name="role" class="phone form-control" placeholder="eleman">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Çalışıcağı Bölüm</label>
                                <select name="istasyon_id" class="phone form-control">
                                    <option value="">Seçiniz</option>
                                    @foreach ($istasyon as $item)
                                        <option value="{{ $item->id }}">{{ $item->ad }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Mail@deneme.com" />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Şifre</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="pt-4">
                                <button class="btn btn-primary d-grid w-100">Kayıt Ol</button>
                            </div>
                        </form>
                        <p class="text-center">
                            <span>Zaten Hesabınız Varmı ?</span>
                            <br>
                            <a href="{{ route('login.get') }}">
                                <span>Giriş Yapmak için</span>
                            </a>
                            <span>tıklayınız.</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showConfirmation(event) {
            event.preventDefault(); // prevent the form from submitting immediately

            // submit the form using AJAX
            $.ajax({
                url: '{{ route('register.post') }}',
                type: 'POST',
                data: $('#formAuthentication').serialize(),
                success: function(response) {
                    // registration successful, show success message and redirect to login
                    Swal.fire({
                        title: 'Kayıt işlemi başarılı!',
                        text: '5 saniye içinde login sayfasına yönlendirileceksiniz.',
                        icon: 'success',
                        timer: 5000, // auto close after 5 seconds
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then(() => {
                        // redirect to the login page
                        window.location.href = '/login';
                    });
                },
                error: function(xhr, status, error) {
                    // registration failed, show error message
                    Swal.fire({
                        title: 'Kayıt işlemi başarısız!',
                        text: xhr.responseJSON.message,
                        icon: 'error'
                    });
                }
            });
        }
    </script>

    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/assets/vendor/js/menu.js"></script>
    <script src="/assets/js/main.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>
