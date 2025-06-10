<body>
    <style>
        .menu-rota {
            background: transparent;
            border-radius: 10px
        }

        .menu-rota:hover {
            background: #696cff;
            color: black
        }

        .menu-link.active .menu-rota {
            background: rgba(105, 108, 255, 0.16) !important;
        }

        /* CSS ekleyin */
        .vurgulu-satir {
            background-color: #fff3cd !important;
            border: 2px solid #ffc107 !important;
            box-shadow: 0 0 10px rgba(255, 193, 7, 0.5) !important;
        }

        .vurgulu-satir td {
            font-weight: bold !important;
        }

        /* CSS ekleyin */
        @keyframes vurgula {
            0% {
                background-color: transparent;
            }

            50% {
                background-color: #ffeb3b;
            }

            100% {
                background-color: #fff3cd;
            }
        }

        .vurgulu-satir {
            animation: vurgula 0.5s ease-in-out;
            background-color: #fff3cd !important;
            border-left: 4px solid #ff9800 !important;
        }

        .yanip-son {
            animation: yanipSon 2s ease-in-out;
        }

        @keyframes yanipSon {

            0%,
            100% {
                opacity: 1;
            }

            25%,
            75% {
                opacity: 0.7;
            }

            50% {
                opacity: 0.4;
            }
        }
    </style>
    <nav class="navbar navbar-expand-lg mb-12 bg-body-tertiary">
        <div class="container-fluid">
            {{-- <a href="{{ route('anasayfa') }}" class="app-brand-link gap-2 w-100"> --}}
            <img src="/assets/img/ikon29.png" alt="Resim bulunamadı" class="">
            {{-- </a> --}}

            <div class="ps-5 pt-lg-3">
                <h3>
                    HOŞ GELDİNİZ {{ auth()->user()->name }}
                </h3>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <img src="assets/img/ikon30.png" alt="" width="30" class="menu-icon tf-icons">
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    {{-- <li class="nav-item">
                        <a href="{{ route('anasayfa') }}"
                            class="menu-link text-dark flex-column gap-2 {{ Route::is('anasayfa') ? 'active' : '' }}">
                            <div class="menu-rota btn d-flex flex-column py-1">
                                <span class="align-middle">STOK LİSTESİ </span>
                            </div>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('stok') }}"
                            class="menu-link text-dark flex-column gap-2 {{ Route::is('stok') ? 'active' : '' }}">
                            <div class="menu-rota btn d-flex flex-column py-1">
                                <span class="align-middle">ÜRÜN LİSTESİ</span>
                            </div>
                        </a>
                    </li> --}}
                </ul>
                <form class="d-flex" method="GET" action="{{ route('search') }}">
                    <input name="q" class="form-control me-2" type="search" placeholder="Ürün Ara"
                        aria-label="Search" value="{{ request('q') }}">
                    <button class="btn btn-outline-primary" type="submit">
                        <img src="assets/img/ikon26.png" alt="" width="30" class="menu-icon tf-icons">
                    </button>
                    <div class="ps-2">
                        <a href="{{ route('anasayfa') }}" class="btn btn-outline-primary"> <img
                                src="assets/img/ikon31.png" alt="" width="30"
                                class="menu-icon tf-icons"></a>
                    </div>
                </form>
                <div class="btn-group dropstart">
                    <button class="btn ms-2 position-relative" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="assets/img/ikon32.gif" alt="" width="37" class="menu-icon tf-icons">
                        @php $eksikStokSayisi = $alert->where('kalan_adet', '<', 10)->count(); @endphp
                        @if ($eksikStokSayisi > 0)
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $eksikStokSayisi }}
                                <span class="visually-hidden">eksik stok</span>
                            </span>
                        @endif
                    </button>
                    <ul class="dropdown-menu"
                        style="@if ($eksikStokSayisi > 20) max-height: 400px; overflow-y: auto; @endif">
                        <li>
                            <p class="text-center"><strong> UYARILAR !!! ({{ $eksikStokSayisi }})</strong></p>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @forelse ($alert->where('kalan_adet', '<', 10) as $item)
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);"
                                    onclick="tabloSatiriBul({{ $item->id }})">
                                    {{ $item->urun_adi }} -> {{ $item->model }} ->
                                    @if ($item->kw != 0)
                                        {{ $item->kw }}
                                    @else
                                        -
                                    @endif
                                </a>
                            </li>
                        @empty
                            <li>
                                <p class="dropdown-item-text">Herhangi bir eksik stok bulunmamaktadır...</p>
                            </li>
                        @endforelse
                    </ul>
                </div>

                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <img src="assets/img/ikon27.png" alt="" width="37" class="menu-icon tf-icons">
                            {{-- <i class="bx bx-power-off me-2"></i> --}}
                            {{-- <span class="align-middle">Çıkış Yap</span> --}}
                        </a>
                    </li>
                </ul>


            </div>
        </div>
        <script>
            function tabloSatiriBul(id) {
                // Önce tüm vurguları temizle
                document.querySelectorAll('.vurgulu-satir').forEach(el => {
                    el.classList.remove('vurgulu-satir');
                });

                // Tabloda o ID'yi bul
                const satir = document.querySelector(`[data-id="${id}"]`);
                if (satir) {
                    // Dropdown'u kapat
                    const dropdown = document.querySelector('.btn-group .dropdown-toggle');
                    if (dropdown) {
                        dropdown.click();
                    }

                    // Sayfayı o satıra kaydır
                    satir.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    // Satırı vurgula
                    setTimeout(() => {
                        satir.classList.add('vurgulu-satir');
                    }, 1000);

                    // 5 saniye sonra vurguyu kaldır
                    setTimeout(() => {
                        satir.classList.remove('vurgulu-satir');
                    }, 10000);
                } else {
                    alert('Ürün bulunamadı!');
                }
            }
        </script>
    </nav>
</body>
{{-- <li>
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Profile Git</span>
                    </a>
                </li> --}}
