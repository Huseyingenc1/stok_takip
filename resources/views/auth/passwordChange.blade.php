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
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            @php
                                $tenant = \App\Models\Tenant::find(session('selected_tenant_id'));
                            @endphp

                            @if ($tenant && $tenant->logo)
                                <img src="{{ asset('storage/' . $tenant->logo) }}" alt="Resim bulunamadı"
                                    style="max-height: 150px; max-width: 180px; height: auto; width: auto;">
                            @endif
                        </div>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }} <br>
                            </div>
                        @endif
                        <form id="formAuthentication" class="mb-3" action="{{ route('password_update') }}"
                            method="POST">
                            @csrf
                            <div class="mb-3 form-password-toggle">
                                <input type="hidden" value="{{ request('email') }}" name="email">
                                <label class="form-label" for="password">Yeni Şifre</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary d-grid w-100">Şifremi Değiştir</button>
                        </form>
                    </div>
                    <span class="app-brand-link gap-sm-0  text-muted">
                        <img src="/assets/img/GNCTurco_Logo.png" alt="Resim bulunamadı" width="50" class="">
                        <small class="text-center"><strong class="text-center"> HÜSEYİN GENÇ </strong> Tarafından
                            Üretilmiştir... © 2025 </small>
                    </span>
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
