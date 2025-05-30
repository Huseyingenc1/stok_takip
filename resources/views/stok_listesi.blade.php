    @extends('layout')
    @section('content')
        <div class="d-flex justify-content-center col-12 " style="background:#adb5bd">
            <div class="col-10 mt-2">
                <h2 class="text-center text-danger"> STOK LİSTESİ TABLOSU</h2>
            </div>
            <div class="col-2 mt-2 text-end me-3">
                <button id="btnYeniSiparis" class="btn btn-outline-secondary text-white" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Yeni Ürün Ekle
                </button>
            </div>
        </div>
        <div class="conteiner-fluid">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Marka Adı</th>
                        <th scope="col">Model</th>
                        <th scope="col">Kw değeri</th>
                        {{-- <th scope="col">Amper</th> --}}
                        <th scope="col">Düzenle</th>
                        <th scope="col">Sil</th>
                        {{-- <th scope="col">Önceki Sipariş Adedi</th>
                        <th scope="col">Kalan Adet</th> --}}
                        {{-- <th scope="col">Güncel Sipariş Adedi</th>
                        <th scope="col">Sipariş Verildiği Yer</th>
                        <th scope="col">Sipariş Verildiği Tarih</th>
                        <th scope="col">Sipariş Veren Kişi</th>
                        <th scope="col">Siparişin Durumu</th> --}}
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($stok as $item)
                        <tr>
                            <td>{{ $item->id }} </td>
                            <td>{{ $item->urun_adi }}</td>
                            <td>{{ $item->model }} </td>
                            <td>{{ $item->kw_degeri }} KW</td>
                            {{-- <td>{{ $item->amper }} </td> --}}
                            {{-- <td>{{ $item->onceki_siparis_adedi }} </td>
                            <td>{{ $item->kalan_adet }} </td> --}}
                            {{-- <td>{{ $item->guncel_siparis_adedi }} </td>
                            <td>{{ $item->siparis_verildigi_yer }} </td>
                            <td>{{ $item->siparis_tarihi }} </td>
                            <td>{{ $item->siparis_veren_kisi }} </td>
                            <td>{{ $item->siparis_durumu }} </td> --}}
                            <td>
                                <a data-bs-toggle="modal" title="{{ $item->ad }}" type="button"
                                    data-bs-target="#modalCenter{{ $item->id }}"
                                    href="{{ route('stokupdate', ['id' => $item->id]) }}" role="button">
                                    <img src="assets/img/ikon19.png" alt="" width="30"
                                        class="menu-icon tf-icons">
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('stokdelete', $item->id) }}" class="btn kaydet-buton ">
                                    <img src="assets/img/ikon16.png" alt="" width="30"
                                        class="menu-icon tf-icons">
                                </a>
                            </td>
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
            </table>


        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-content-center">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ürün Ekle</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('stok_listesiPost') }}" class="row g-3 needs-validation" novalidate
                            method="POST">
                            @csrf
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label"> ÜRÜN ADI</label>
                                <input type="text" class="form-control" id="validationCustom01" name="urun_adi"
                                    placeholder="SCHNEIDER">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label"> MARKA</label>
                                <input type="text" class="form-control" id="validationCustom01" name="model"
                                    placeholder="">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">KW DEĞERİ</label>
                                <input type="text" class="form-control" id="validationCustom02" name="kw_degeri"
                                    placeholder="7.5 KW">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Önceki Sipariş Adedi</label>
                                <input type="text" class="form-control" id="validationCustom02"
                                    name="onceki_siparis_adedi" placeholder="20" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Kalan Adedi</label>
                                <input type="text" class="form-control" id="validationCustom02" name="kalan_adet"
                                    placeholder="7" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Güncel Sipariş Adedi</label>
                                <input type="text" class="form-control" id="validationCustom02"
                                    name="guncel_siparis_adedi" placeholder="30">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Sipariş Verildiği Yer</label>
                                <input type="text" class="form-control" id="validationCustom02"
                                    name="siparis_verildigi_yer" placeholder="KONYA ENERJİ">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Sipariş Tariihi</label>
                                <input type="text" class="form-control" id="validationCustom02"
                                    name="siparis_verildigi_yer" placeholder="">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Sipariş Veren Kişi</label>
                                <input type="text" class="form-control" id="validationCustom02"
                                    name="siparis_veren_kisi" placeholder="">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Sipariş Durumu</label>
                                <input type="text" class="form-control" id="validationCustom02" name="siparis_durumu"
                                    placeholder="">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
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
        @foreach ($stok as $item2)
            <div class="mt-3">
                <div class="modal fade" id="modalCenter{{ $item2->id }}" aria-labelledby="modalToggleLabel"
                    tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-centered">
                        <form action="{{ route('stokupdate') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item2->id }}">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalToggleLabel">Ürün Düzenleme</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label for="defaultFormControlInput" class="form-label">Ürün Adı</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="urun_adi"
                                            value="{{ $item2->urun_adi }}"
                                            aria-label="Dollar amount (with dot and two decimal places)">
                                    </div>
                                    <label for="defaultFormControlInput" class="form-label">MODEL</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="model"
                                            value="{{ $item2->model }}"
                                            aria-label="Dollar amount (with dot and two decimal places)">
                                    </div>
                                    <label for="defaultFormControlInput" class="form-label">KW Değeri</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="kw_degeri"
                                            value="{{ $item2->kw_degeri }}"
                                            aria-label="Dollar amount (with dot and two decimal places)">
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

        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-5 d-flex align-items-center">
                    {{-- <a href="{{ route('anasayfa') }}" class="app-brand-link gap-2">
                        <img src="/assets/img/GNCTurco_Logo.png" alt="Resim bulunamadı" width="70" class="">
                    </a> --}}
                    <span class="mb-3 mb-md-0 text-muted">© 2025 Company, Tarafından Üretilmiştir...</span>
                </div>

                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24"
                                height="24">
                                <use xlink:href="#twitter"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24"
                                height="24">
                                <use xlink:href="#instagram"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24"
                                height="24">
                                <use xlink:href="#facebook"></use>
                            </svg></a></li>
                </ul>
            </footer>
        </div>
    @endsection
