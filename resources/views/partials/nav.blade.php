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
    </style>
    <nav class="navbar navbar-expand-lg mb-12 bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)">LOGO</a>
            {{-- <a href="{{ route('anasayfa') }}" class="app-brand-link gap-2">
                <img src="/assets/img/GNCTurco_Logo.png" alt="Resim bulunamadı" width="70" class="">
            </a> --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="{{ route('anasayfa') }}"
                            class="menu-link text-dark flex-column gap-2 {{ Route::is('anasayfa') ? 'active' : '' }}">
                            <div class="menu-rota btn d-flex flex-column py-1">
                                <span class="align-middle">ANASAYFA</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('stok') }}"
                            class="menu-link text-dark flex-column gap-2 {{ Route::is('stok') ? 'active' : '' }}">
                            <div class="menu-rota btn d-flex flex-column py-1">
                                <span class="align-middle">ÜRÜN LİSTESİ</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <form class="d-flex" method="GET" action="{{ route('search') }}">
                    <input name="q" class="form-control me-2" type="search" placeholder="Ürün Ara"
                        aria-label="Search" value="{{ request('q') }}">
                    <button class="btn btn-outline-primary" type="submit">
                        <img src="assets/img/ikon26.png" alt="" width="30" class="menu-icon tf-icons">
                    </button>
                </form>

            </div>
        </div>
    </nav>
</body>
