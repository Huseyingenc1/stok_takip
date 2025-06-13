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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

                        <h4 class="mb-2">Hoş Geldiniz ! </h4>
                        <p class="mb-4">Lütfen Firmanızı Seçin ...</p>
                        @if ($errors->any())
                            <div class="row gap-3">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger small">
                                        {{ $error }} <br>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Lütfen Firmanızı Seçiniz !!!</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <select id="tenant-select" class="select2" style="width: 100%">
                                    <option value="">Seçiniz</option>
                                    @foreach ($tenant as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            {{-- <button
                                    class="btn btn-primary d-grid w-100 product-giris-buton "onclick="disabledbutton(this)"
                                    type="button">Giriş Yap</button> --}}
                            <button class="btn btn-primary d-grid w-100 product-giris-buton"
                                onclick="selectTenant()">İleri</button>
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
            <!-- Select2 JS -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

            <!-- Select2 Başlat -->
            <script>
                $(document).ready(function() {
                    $('#tenant-select').select2({
                        placeholder: "Bir firma seçin",
                        allowClear: true
                    });
                });
            </script>
            <script>
                function selectTenant() {
                    const tenantId = document.getElementById('tenant-select').value;

                    if (!tenantId) {
                        alert("Lütfen bir firma seçiniz.");
                        return;
                    }

                    fetch("{{ route('welcome.post') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                tenant_id: tenantId
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error("Sunucu hatası.");
                            }
                            return response.json();
                        })
                        .then(data => {
                            window.location.href = "/login";
                        })
                        .catch(error => {
                            console.error(error);
                            alert("Bir hata oluştu.");
                        });
                }
            </script>

</body>

</html>
