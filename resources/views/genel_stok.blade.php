    @extends('layout')
    @section('content')
        <style>
            .pagination .page-item .page-link {
                border-radius: 0.5rem;
                transition: all 0.2s ease-in-out;
            }

            .pagination .page-item.active .page-link {
                background-color: #0d6efd;
                border-color: #0d6efd;
                color: white;
                font-weight: bold;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            }

            .pagination .page-item .page-link:hover {
                background-color: #e2e6ea;
            }

            .vurgulu-satir {
                background-color: rgb(138 170 205 / 40%) !important;
                border: 2px solid rgba(67, 89, 113, 0.4) !important;
                box-shadow: 0 0 10px rgba(174, 174, 174, 0.5) !important;
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
        </style>

        {{-- <form action="{{ route('logo.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="logo">Logo Yükle:</label>
            <input type="file" name="logo" id="logo" accept="image/*" required>

            <button type="submit">Yükle</button>
        </form> --}}



        <div class="card">
            <div class="row">
                <h5 class="card-header text-center col-9">ELEKTRİKHANE GENEL STOK TABLOSU</h5>
                @if (in_array(auth()->user()->role, [0, 1]))
                    <div class="col-xxl d-flex justify-content-end h-100 - pt-3">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            YENİ ÜRÜN EKLE
                        </button>
                    </div>
                    <div class="col-xxl d-flex justify-content-end h-100 me-5 pt-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop22">
                            Günün Sipariş Listesi
                        </button>
                    </div>
                @endif
            </div>
            <div class="table-responsive text-nowrap">
                @if (auth()->user()->tenant_id == session('selected_tenant_id'))
                    <table class="table">
                        <thead>
                            <tr class="small">
                                <th scope="col">ID</th>
                                <th scope="col">Marka Adı</th>
                                <th scope="col">Model</th>
                                <th scope="col">KW Değeri</th>
                                <th scope="col">Önceki Sipariş Adedi</th>
                                <th scope="col">Kalan Adet</th>
                                <th scope="col">Güncel Sipariş Adedi</th>
                                <th scope="col">Sipariş Verildiği Yer</th>
                                <th scope="col">Sipariş Verildiği Tarih</th>
                                <th scope="col">Sipariş Veren Kişi</th>
                                <th scope="col">Siparişin Durumu</th>
                                <th scope="col" class="text-center"><i class="fa fa-minus-circle"></i></th>
                                {{-- <th scope="col" class="text-center"><i class="fa fa-plus-circle"></i></th> --}}
                                <th scope="col" class="text-center">DURUMU</th>
                                <th scope="col" class="text-center"><i class="fa fa-pen-to-square"></i></th>
                                @if (in_array(auth()->user()->role, [0, 1]))
                                    <th scope="col" class="text-center"><i class="fa fa-trash"></i></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($genel as $item)
                                <tr id="siparis-{{ $item->id }}"
                                    class="small {{ isset($targetId) && $targetId == $item->id ? 'vurgulu-satir' : '' }} "
                                    data-id="{{ $item->id }}"
                                    style="{{ $item->bugunGuncellendi ? 'background-color: #d4f1f9;' : '' }}">

                                    <th scope="row">{{ $item->id }} </th>
                                    <td>{{ $item->urun_adi }}</td>
                                    <td>{{ $item->model }} </td>
                                    <td>{{ $item->kw }} </td>
                                    <td style="background: #efadce;" style="background: #ea868f;" data-onceki>
                                        {{ $item->onceki_siparis_adedi }}
                                        adet</td>


                                    <td class="text-center {{ $item->kalan_adet < 10 ? 'glow' : 'stable-color' }}"
                                        id="kalan_adet_{{ $item->id }}">
                                        {{ $item->kalan_adet }}
                                    </td>


                                    <td style="background: #a3cfbb;" id="guncel_adet_{{ $item->id }}">
                                        {{ $item->guncel_siparis_adedi }}
                                    </td>


                                    <td>{{ $item->siparis_verildigi_yer }} </td>
                                    <td>{{ $item->siparis_tarihi }} </td>
                                    <td>{{ $item->siparis_veren_kisi }} </td>
                                    <td data-item-id="{{ $item->id }}">{{ $item->siparis_durumu }} </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" data-id="{{ $item->id }}"
                                            data-route="{{ route('genel_eksilt_artır', ['id' => $item->id]) }}"
                                            onclick="stokGuncelle(this, 'decrease')">
                                            <img src="assets/img/ikon25.png" alt="" width="30"
                                                class="menu-icon tf-icons">
                                        </a>
                                    </td>
                                    {{-- <td class="text-center">
                                    <a href="javascript:void(0);" data-id="{{ $item->id }}"
                                        data-route="{{ route('genel_eksilt_artır', ['id' => $item->id]) }}"
                                        onclick="stokGuncelle(this, 'increase')">
                                        <img src="assets/img/ikon23.png" alt="" width="30"
                                            class="menu-icon tf-icons">
                                    </a>
                                </td> --}}
                                    @php
                                        $durumlar = [
                                            // 'sipariş beklemede' => 'Sipariş Beklemede',
                                            // 'sipariş verildi' => 'Sipariş Verildi',
                                            'sipariş teslim alındı' => 'Sipariş Teslim Alındı',
                                        ];
                                        $mevcutDurum = $item->siparis_durumu;

                                        $siparisTarihi = \Carbon\Carbon::parse($item->siparis_tarihi);
                                        $bugun = \Carbon\Carbon::today();

                                        // Sadece sipariş teslim alındı olan ve tarihi bugünden küçükse disable et
                                        $disabled =
                                            $mevcutDurum === 'sipariş teslim alındı' && $siparisTarihi->lt($bugun);
                                    @endphp

                                    <td class="siparis-durumu-gosterici">
                                        @foreach ($durumlar as $key => $label)
                                            @if ($key == $mevcutDurum)
                                                <span class="durum-aktif">{{ $label }}</span>
                                            @else
                                                @if ($disabled)
                                                    <span class="durum-link disabled"
                                                        style="color: gray; cursor: not-allowed;"
                                                        title="Sipariş teslim alındı ve tarihi geçmiş, düzenleme kapalıdır.">
                                                        {{ $label }}
                                                    </span>
                                                @else
                                                    <a href="javascript:void(0);" class="durum-link"
                                                        data-id="{{ $item->id }}" data-durum="{{ $key }}"
                                                        data-route="{{ route('siparis_durum_guncelle', ['id' => $item->id]) }}"
                                                        onclick="siparişDurumGuncelle(this)">
                                                        {{ $label }}
                                                    </a>
                                                @endif
                                            @endif

                                            @if (!$loop->last)
                                                <span class="durum-ayirici"> | </span>
                                            @endif
                                        @endforeach
                                    </td>


                                    <td class="text-center">
                                        <a href="javascript:void(0);" data-id="{{ $item->id }}"
                                            data-route="{{ route('genel_stokupdate', ['id' => $item->id]) }}"
                                            data-bs-toggle="modal" data-bs-target="#modalCenter{{ $item->id }}"
                                            onclick="confirmUpdate(this)">
                                            <img src="assets/img/ikon19.png" alt="" width="30"
                                                class="menu-icon tf-icons">
                                        </a>
                                    </td>

                                    @if (in_array(auth()->user()->role, [0, 1]))
                                        <td class="text-center">
                                            <a href="javascript:void(0);" class="btn kaydet-buton"
                                                onclick="confirmDelete(this)"
                                                data-route="{{ route('genel_stokdelete', $item->id) }}">
                                                <img src="assets/img/ikon16.png" alt="" width="30"
                                                    class="menu-icon tf-icons">
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="container-xxl flex-grow-1 container-p-y">
                                            <div class="row">
                                                <div class="col-lg-8 mb-4 order-0">
                                                    <div class="card">
                                                        <div class="d-flex align-items-end row">
                                                            <div class="col-sm-7">
                                                                <div class="card-body">
                                                                    <h5 class="card-title text-primary">Üzgünüz
                                                                        <i class="bx bx-error-alt"></i>
                                                                    </h5>
                                                                    <p class="mb-4">
                                                                        Herhangi Bir Kayıt Bulunamadı
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-5 text-center text-sm-left">
                                                                <div class="card-body pb-0 px-0 px-md-4">
                                                                    <img src="../assets/img/illustrations/page-misc-error-light.png"
                                                                        alt="page-misc-error-light" width="200"
                                                                        data-app-dark-img="illustrations/page-misc-error-dark.png"
                                                                        data-app-light-img="illustrations/page-misc-error-light.png">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="table-border-bottom-0">
                            <tr>

                            </tr>
                        </tfoot>

                    </table>
                @endif

                <div class="row mx-3 justify-content-between">
                    <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto me-auto">
                        <div class="dt-info" aria-live="polite" id="DataTables_Table_3_info" role="status">1-20
                            Arasındakiler Gösteriliyor</div>
                    </div>
                    <div
                        class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ms-auto mt-0">
                        <div class="dt-paging">
                            <nav aria-label="pagination">
                                <ul class="pagination mb-3 mt-4">
                                    <li class="page-item {{ $genel->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $genel->previousPageUrl() ?? '#' }}"
                                            aria-label="Önceki">
                                            <span aria-hidden="true">&laquo; Önceki</span>
                                        </a>
                                    </li>

                                    {{-- Sayfa numaraları --}}
                                    @php
                                        $start = max(1, $genel->currentPage() - 2);
                                        $end = min($genel->lastPage(), $genel->currentPage() + 2);
                                    @endphp

                                    @if ($start > 1)
                                        <li class="page-item"><a class="page-link" href="{{ $genel->url(1) }}">1</a>
                                        </li>
                                        @if ($start > 2)
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                        @endif
                                    @endif

                                    @for ($i = $start; $i <= $end; $i++)
                                        <li class="page-item {{ $genel->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $genel->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    @if ($end < $genel->lastPage())
                                        @if ($end < $genel->lastPage() - 1)
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                        @endif
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $genel->url($genel->lastPage()) }}">{{ $genel->lastPage() }}</a>
                                        </li>
                                    @endif

                                    {{-- Sonraki --}}
                                    <li class="page-item {{ $genel->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $genel->nextPageUrl() ?? '#' }}"
                                            aria-label="Sonraki">
                                            <span aria-hidden="true">Sonraki &raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <p class="p-3 ps-2">
                        <button class="btn btn-primary text-black" type="button" data-bs-toggle="collapse"
                            data-bs-target="#multiCollapseExample1" aria-expanded="false"
                            aria-controls="multiCollapseExample1" style="background-color: #d4f1f9;">
                            Renk 1
                        </button>
                        <button class="btn btn-primary " type="button" data-bs-toggle="collapse"
                            data-bs-target="#multiCollapseExample2" aria-expanded="false"
                            aria-controls="multiCollapseExample2" style="background-color: #efadce">
                            Renk 2
                        </button>
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                            data-bs-target="#multiCollapseExample3" aria-expanded="false"
                            aria-controls="multiCollapseExample3" style="background-color: #ea868f">
                            Renk 3
                        </button>
                        <button class="btn btn-primary glow" type="button" data-bs-toggle="collapse"
                            data-bs-target="#multiCollapseExample4" aria-expanded="false"
                            aria-controls="multiCollapseExample4">
                            Renk 4
                        </button>
                        <button class="btn btn-primary text-black" type="button" data-bs-toggle="collapse"
                            data-bs-target="#multiCollapseExample5" aria-expanded="false"
                            aria-controls="multiCollapseExample5" style="background-color: #a3cfbb">
                            Renk 5
                        </button>
                    </p>
                    <div class="row">
                        <div class="col ps-4">
                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                <div class="card card-body" style="background-color: #d4f1f9;">
                                    Bugün Tarihli Düzenlenen Satırların Arka Plan Rengini Belirtir
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                                <div class="card card-body" style="background-color: #efadce">
                                    Bir Önceki Verilen Sipariş Listesi Belirtir
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="collapse multi-collapse" id="multiCollapseExample3">
                                <div class="card card-body" style="background-color: #ea868f">
                                    Kalan Adet Listesini Belirtir
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="collapse multi-collapse" id="multiCollapseExample4">
                                <div class="card card-body glow">
                                    10 Adet Altına Düşen Kalan Listeyi Belirtir
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="collapse multi-collapse" id="multiCollapseExample5">
                                <div class="card card-body" style="background-color: #a3cfbb">
                                    Güncel Sipariş Listesini Belirtir
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ---------------------------------------- sipariş verilecekler dropdownu --------------------------------------------- --}}

        <div class="modal fade" id="staticBackdrop22" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Toplu Sipariş Listesi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Marka Adı</th>
                                    <th scope="col">Model</th>
                                    <th scope="col">KW Değeri</th>
                                    <th scope="col">Güncel Sipariş Adedi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alert as $geneli)
                                    @if (\Carbon\Carbon::parse($geneli->updated_at)->isToday())
                                        <tr>
                                            <th scope="row">{{ $geneli->id }}</th>
                                            <td>{{ $geneli->urun_adi }}</td>
                                            <td>{{ $geneli->model }}</td>
                                            <td>{{ $geneli->kw }}</td>
                                            <td>{{ $geneli->guncel_siparis_adedi }}</td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                        <form method="POST" action="{{ route('stokMailGonder') }}">
                            @csrf
                            <div class="modal-footer">
                                <label for="">Mail Gönderilecek Kişi</label>
                                <select name="user_id" class="form-control" required>
                                    <option value="">Seçiniz</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}
                                            ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Gönder</button>
                            </div>
                        </form>


                        {{-- <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">İptal</button>
                                <button type="submit" class="btn btn-outline-primary">Mail Gönder</button>
                            </div> --}}
                    </div>

                </div>
            </div>
        </div>
        {{-- ------------------------------------ stok ekleme --------------------------- --}}

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-content-center">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ürün Ekle</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('genel_stokCreate') }}" class="row g-3 needs-validation" novalidate
                            method="POST">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label"> ÜRÜN ADI</label>
                                    <input type="text" class="form-control" id="validationCustom01" name="urun_adi"
                                        placeholder="SCHNEIDER">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label"> ÜRÜN MODELİ</label>
                                    <input type="text" class="form-control" id="validationCustom01" name="model"
                                        placeholder="Atv 320">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                {{-- <div class="col-md-8">
                                    <label for="stok_secimi" class="form-label">ÜRÜN ADI</label>
                                    <select id="stok_secimi" class="form-select select2" name="urun_adi"
                                        aria-label="Default select example">
                                        <option selected disabled>Seçiniz</option>
                                        @foreach ($genel as $stok3)
                                            <option value="{{ $stok3->id }}">
                                                {{ $stok3->urun_adi }} -> {{ $stok3->model }} -> {{ $stok3->kw }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Önceki Sipariş Adedi</label>
                                    <input type="number" class="form-control" id="validationCustom02"
                                        name="onceki_siparis_adedi" placeholder="">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Kalan Adedi</label>
                                    <input type="number" class="form-control" id="validationCustom02" name="kalan_adet"
                                        placeholder="7" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Güncel Sipariş Adedi</label>
                                    <input type="number" class="form-control" id="validationCustom02"
                                        name="guncel_siparis_adedi" placeholder="30">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Sipariş Verildiği Yer</label>
                                    <input type="text" class="form-control" id="validationCustom02"
                                        name="siparis_verildigi_yer" placeholder="KONYA ENERJİ">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Sipariş Tariihi</label>
                                    <input type="date" class="form-control" id="validationCustom02"
                                        name="siparis_tarihi" placeholder="">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Sipariş Veren Kişi</label>
                                    <input type="text" class="form-control" id="validationCustom02"
                                        name="siparis_veren_kisi" placeholder="">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">MODEL</label>
                                <input type="text" class="form-control" id="validationCustom02" name="model"
                                    placeholder="ATV 320">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">KW DEĞERİ</label>
                                <input type="text" class="form-control" id="validationCustom02" name="kw_degeri"
                                    placeholder="7.5 KW">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Siparişin Durumu</label>
                                <select class="form-select" aria-label="Default select example" name="siparis_durumu">
                                    <option selected>Lütfen Seçiniz</option>
                                    <option value="1">Sipariş Verilecek</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div> --}}


                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger"
                                    data-bs-dismiss="modal">İPTAL</button>
                                <button type="submit" class="btn btn-outline-primary">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        {{-- ----------------------------------------------- ürün düzenle--------------------------------- --}}
        @foreach ($genel as $item2)
            <div class="mt-3">
                <div class="modal fade" id="modalCenter{{ $item2->id }}" aria-labelledby="modalToggleLabel"
                    tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-centered">
                        <form action="{{ route('genel_stokupdate') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item2->id }}">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalToggleLabel">Ürün Düzenleme</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body row">
                                    <div class="col-md-5 w-50">
                                        <label for="validationCustom01" class="form-label"> ÜRÜN ADI</label>
                                        <input type="text" class="form-control" id="validationCustom01"
                                            name="urun_adi" value="{{ $item2->urun_adi }}" disabled>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-5 w-50">
                                        <label for="validationCustom02" class="form-label">MODEL</label>
                                        <input type="text" class="form-control" id="validationCustom02"
                                            name="model" placeholder="ATV 320" value="{{ $item2->model }}" disabled>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-5 w-50">
                                        <label for="validationCustom02" class="form-label">Önceki Sipariş Adedi</label>
                                        <input type="text" class="form-control" id="validationCustom02"
                                            name="onceki_siparis_adedi" value="{{ $item2->onceki_siparis_adedi }}">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-5 w-50">
                                        <label for="validationCustom02" class="form-label">Kalan Adedi</label>
                                        <input type="text" class="form-control" id="validationCustom02"
                                            name="kalan_adet" required value="{{ $item2->kalan_adet }}">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-5 w-50">
                                        <label for="validationCustom02" class="form-label">Güncel Sipariş Adedi</label>
                                        <input type="text" class="form-control" id="validationCustom02"
                                            name="guncel_siparis_adedi" value="{{ $item2->guncel_siparis_adedi }}">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-5 w-50">
                                        <label for="validationCustom02" class="form-label">Sipariş Verildiği Yer</label>
                                        <input type="text" class="form-control" id="validationCustom02"
                                            name="siparis_verildigi_yer" value="{{ $item2->siparis_verildigi_yer }}">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-5 w-50">
                                        <label for="validationCustom02" class="form-label">Sipariş Tariihi</label>
                                        <input type="datetime-local" class="form-control" id="validationCustom02"
                                            name="siparis_tarihi" value="{{ $item2->siparis_tarihi }}">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-5 w-50">
                                        <label for="validationCustom02" class="form-label">Sipariş Veren Kişi</label>
                                        <input type="text" class="form-control" id="validationCustom02"
                                            name="siparis_veren_kisi" value="{{ $item2->siparis_veren_kisi }}" disabled>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-5 w-100 text-center">
                                        <label for="validationCustom02" class="form-label">Sipariş Durumu</label>
                                        <input type="text" class="form-control text-center" id="validationCustom02"
                                            name="siparis_durumu" value="{{ $item2->siparis_durumu }}" disabled>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Düzenle
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- FOOTER --}}
        <div class="text-center w-100">
            <footer class="align-items-center border-top d-flex flex-wrap justify-content-around py-3 text-ccenter">
                <div class="col-md d-flex justify-content-arround position-absolute mt-5">
                    {{-- <a href="{{ route('anasayfa') }}" class="app-brand-link gap-2 w-100 text-muted"> --}}
                    <span class="app-brand-link gap-2  text-muted">
                        <img src="/assets/img/GNCTurco_Logo.png" alt="Resim bulunamadı" width="70" class="">
                        <strong>HÜSEYİN GENÇ</strong> Tarafından
                        Üretilmiştir... © 2025 Company </span>
                    {{-- </a> --}}
                    {{-- <span class="mb-3 mb-md-0 text-muted w-100">
                        © 2025 Company, <strong>HÜSEYİN GENÇ</strong> Tarafından
                        Üretilmiştir...</span> --}}
                </div>
            </footer>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script>
            function confirmDelete(element) {
                Swal.fire({
                    title: 'Silmek istediğinize emin misiniz?',
                    text: "Bu işlem geri alınamaz!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Evet, sil!',
                    cancelButtonText: 'Vazgeç'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Silme linkine yönlendir
                        window.location.href = element.getAttribute('data-route');
                    }
                });
            }
        </script>


        {{-- ----------------------------------- bu kısımda eksiltme yapılıcak -------------------------------------------------- --}}
        <script>
            function stokGuncelle(element, action) {
                // Debug için console'a yazdır
                console.log('stokGuncelle çağırıldı:', action);

                // Element'ten data attribute'ları al
                const itemId = element.getAttribute('data-id');
                const route = element.getAttribute('data-route');

                console.log('Item ID:', itemId);
                console.log('Route:', route);

                // Mevcut adet değerini al
                const kalanAdetElement = document.getElementById(`kalan_adet_${itemId}`);

                if (!kalanAdetElement) {
                    console.error('Kalan adet elementi bulunamadı:', `kalan_adet_${itemId}`);
                    return;
                }

                let currentAdet = parseInt(kalanAdetElement.textContent.trim());
                console.log('Mevcut adet:', currentAdet);

                // Yeni adet değerini hesapla
                let newAdet;
                if (action === 'decrease') {
                    newAdet = Math.max(0, currentAdet - 1); // 0'ın altına düşmesin
                } else if (action === 'increase') {
                    newAdet = currentAdet + 1;
                }

                console.log('Yeni adet:', newAdet);

                // Eğer değer değişmediyse işlemi durdur
                if (newAdet === currentAdet) {
                    console.log('Değer değişmedi, işlem durduruluyor');
                    return;
                }

                // CSRF token kontrolü
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (!csrfToken) {
                    console.error(
                        'CSRF token bulunamadı. HTML head bölümüne ekleyin: <meta name="csrf-token" content="{{ csrf_token() }}">'
                    );
                    return;
                }

                console.log('AJAX isteği gönderiliyor...');

                // AJAX ile sunucuya güncelleme isteği gönder
                fetch(route, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            action: action,
                            new_adet: newAdet
                        })
                    })
                    .then(response => {
                        console.log('Response status:', response.status);

                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }

                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data);

                        if (data.success) {
                            // Başarılıysa ekrandaki değeri güncelle
                            kalanAdetElement.textContent = newAdet;

                            // Glow efekti ekle (isteğe bağlı)
                            kalanAdetElement.classList.add('updated');
                            setTimeout(() => {
                                kalanAdetElement.classList.remove('updated');
                            }, 1000);

                            console.log('Güncelleme başarılı');
                        } else {
                            console.error('Server error:', data.message);
                            alert('Güncelleme sırasında bir hata oluştu: ' + (data.message || 'Bilinmeyen hata'));
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        alert('Güncelleme sırasında bir hata oluştu: ' + error.message);
                    });
            }

            // CSS için glow efekti (isteğe bağlı)
            // Bu CSS'i head bölümüne ekleyebilirsiniz:
            /*
            .updated {
                background-color: #28a745;
                color: white;
                transition: all 0.3s ease;
            }

            .glow {
                transition: all 0.3s ease;
            }
            */
        </script>
        {{-- ----------------------------------------------- BU KISIMDA DURUM AYARLAMASI YAPILIYOR ----------------------------------------------- --}}
        <script>
            function durumTdGuncelle(itemId, yeniDurum) {
                console.log(`durumTdGuncelle çağrıldı. Item ID: ${itemId}, Yeni Durum: ${yeniDurum}`);

                const durumTd = document.querySelector(`#siparis-${itemId} .siparis-durumu-gosterici`);

                if (durumTd) {
                    durumTd.textContent = yeniDurum;
                    durumTd.classList.remove(
                        'durum-Onaylandı',
                        'durum-Hazırlanıyor',
                        'durum-Kargoda',
                        'durum-TeslimEdildi',
                        'durum-İptalEdildi'
                    );
                    durumTd.classList.add(`durum-${yeniDurum.replace(/\s/g, '')}`);

                    const links = durumTd.querySelectorAll('.durum-link');
                    if (yeniDurum.toLowerCase() === 'sipariş teslim alındı') {
                        links.forEach(link => {
                            link.classList.add('disabled');
                            link.style.pointerEvents = 'none';
                            link.onclick = (e) => e.preventDefault();
                        });

                        const guncelAdetTd = document.querySelector(`#guncel_adet_${itemId}`);
                        const kalanAdetTd = document.querySelector(`#kalan_adet_${itemId}`);
                        const oncekiAdetTd = document.querySelector(`#siparis-${itemId} td[data-onceki]`);

                        if (guncelAdetTd && kalanAdetTd) {
                            const guncelAdet = parseInt(guncelAdetTd.textContent.trim()) || 0;
                            const kalanAdet = parseInt(kalanAdetTd.textContent.trim()) || 0;
                            const toplam = kalanAdet + guncelAdet;

                            kalanAdetTd.textContent = toplam;
                            guncelAdetTd.textContent = 0;

                            if (oncekiAdetTd) {
                                oncekiAdetTd.textContent = `${guncelAdet} adet`;
                            }

                            console.log(
                                `Güncellendi: kalan_adet_${itemId} = ${toplam}, guncel_adet = 0, onceki_adet = ${guncelAdet}`
                            );
                        } else {
                            console.warn(`Hücreler bulunamadı: guncel_adet_${itemId}, kalan_adet_${itemId} veya önceki`);
                        }
                    } else {
                        links.forEach(link => {
                            link.classList.remove('disabled');
                            link.style.pointerEvents = 'auto';
                            link.onclick = null;
                        });
                    }
                } else {
                    console.warn(`Sipariş ID ${itemId} için durum hücresi bulunamadı.`);
                }
            }

            function siparişDurumGuncelle(element) {
                console.log('Sipariş durumu güncelleme başlatıldı');

                const itemId = element.getAttribute('data-id');
                const yeniDurum = element.getAttribute('data-durum');
                const route = element.getAttribute('data-route');

                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (!csrfToken) {
                    console.error('CSRF token bulunamadı');
                    return;
                }

                // Bu değerler burada hesaplanmalı çünkü fetch içine yazılacak
                let guncelAdet = 0;
                let toplam = 0;

                if (yeniDurum.toLowerCase() === 'sipariş teslim alındı') {
                    const guncelAdetTd = document.querySelector(`#guncel_adet_${itemId}`);
                    const kalanAdetTd = document.querySelector(`#kalan_adet_${itemId}`);

                    if (guncelAdetTd && kalanAdetTd) {
                        guncelAdet = parseInt(guncelAdetTd.textContent.trim()) || 0;
                        const kalanAdet = parseInt(kalanAdetTd.textContent.trim()) || 0;
                        toplam = kalanAdet + guncelAdet;
                    }
                }

                Swal.fire({
                    title: 'Emin misiniz?',
                    text: `Sipariş durumunu "${yeniDurum}" olarak değiştirmek istiyor musunuz?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Evet, güncelle!',
                    cancelButtonText: 'Vazgeç',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(route, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    yeni_durum: yeniDurum,
                                    guncel_siparis_adedi: 0,
                                    onceki_siparis_adedi: guncelAdet,
                                    kalan_adet: toplam
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`HTTP error! status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    durumTdGuncelle(itemId, yeniDurum);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Güncellendi',
                                        text: data.message || 'Sipariş durumu başarıyla güncellendi.'
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Güncelleme Başarısız',
                                        text: data.message || 'Durum güncellenemedi.'
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Hata',
                                    text: error.message || 'Beklenmeyen bir hata oluştu.'
                                });
                            });
                    }
                });
            }
        </script>





        {{-- --------------------------------------------------------- bu kısım yeni ürün ekle butunun içindeki select 2 olarak düzenlenmiştir --------------------------------------------------------- --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#stok_secimi').select2({
                    placeholder: "Seçiniz",
                    allowClear: true,
                    dropdownParent: $('#stok_secimi').parent(),
                    width: '100%'
                });
            });
        </script>


        <script>
            // Backend'den gelen ürün bilgilerini JS objesi haline getirelim
            const oncekiSiparisAdetleri = {
                @foreach ($genel as $stok3)
                    "{{ $stok3->id }}": "{{ $stok3->onceki_siparis_adedi ?? '' }}",
                @endforeach
            };

            $(document).ready(function() {
                $('#stok_secimi').select2({
                    placeholder: "Seçiniz",
                    allowClear: true,
                    dropdownParent: $('#stok_secimi').parent(),
                    width: '100%'
                });

                // Select değiştiğinde input'a değer ata
                $('#stok_secimi').on('change', function() {
                    const secilenId = $(this).val();
                    const adet = oncekiSiparisAdetleri[secilenId] || '';
                    $('#validationCustom02').val(adet);
                });
            });
        </script>
        {{-- bu kısımda düzenlenin tosatı çalışıyor köşedeki uyarı işareti --}}
        <script>
            @if (session('success'))
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "{{ session('success') }}"
                });
            @endif

            @if (session('error'))
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: "{{ session('error') }}"
                });
            @endif
        </script>

        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Ürün Eklenemedi !!!',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonText: 'Tamam'
                });
            </script>
        @endif


    @endsection
