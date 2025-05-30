    @extends('layout')
    @section('content')


        <div class="d-flex justify-content-center col-12 " style="background:#adb5bd">
            <div class="col-10 mt-2">
                <h2 class="text-center text-danger"> GENEL STOK LİSTESİ TABLOSU </h2>
            </div>
            <div class="col-2 mt-2 text-end me-3">
                <button class="btn btn-outline-secondary text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                        <th scope="col">KW Değeri</th>
                        <th scope="col">Önceki Sipariş Adedi</th>
                        <th scope="col">Kalan Adet</th>
                        <th scope="col">Güncel Sipariş Adedi</th>
                        <th scope="col">Sipariş Verildiği Yer</th>
                        <th scope="col">Sipariş Verildiği Tarih</th>
                        <th scope="col">Sipariş Veren Kişi</th>
                        <th scope="col">Siparişin Durumu</th>
                        <th scope="col" class="text-center"><i class="fa fa-minus-circle"></i></th>
                        <th scope="col" class="text-center"><i class="fa fa-plus-circle"></i></th>
                        <th scope="col" class="text-center">DURUMU</th>
                        <th scope="col" class="text-center"><i class="fa fa-pen-to-square"></i></th>
                        <th scope="col" class="text-center"><i class="fa fa-trash"></i></th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($genel as $item)
                        <tr id="siparis-123">
                            <th scope="row">{{ $item->id }} </th>
                            <td>{{ $item->urun_adi }}</td>
                            <td>{{ $item->model }} </td>
                            <td>{{ $item->kw }} </td>
                            <td style="background: #efadce;" style="background: #ea868f;">{{ $item->onceki_siparis_adedi }}
                                adet</td>


                            <td class="text-center glow" id="kalan_adet_{{ $item->id }}">
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
                            <td class="text-center">
                                <a href="javascript:void(0);" data-id="{{ $item->id }}"
                                    data-route="{{ route('genel_eksilt_artır', ['id' => $item->id]) }}"
                                    onclick="stokGuncelle(this, 'increase')">
                                    <img src="assets/img/ikon23.png" alt="" width="30"
                                        class="menu-icon tf-icons">
                                </a>
                            </td>
                            @php
                                $durumlar = [
                                    'sipariş beklemede' => 'Sipariş Beklemede',
                                    'sipariş verildi' => 'Sipariş Verildi',
                                    'sipariş teslim alındı' => 'Sipariş Teslim Alındı',
                                ];
                                $mevcutDurum = $item->siparis_durumu;

                                $siparisTarihi = \Carbon\Carbon::parse($item->siparis_tarihi);
                                $bugun = \Carbon\Carbon::today();

                                // Sadece sipariş teslim alındı olan ve tarihi bugünden küçükse disable et
                                $disabled = $mevcutDurum === 'sipariş teslim alındı' && $siparisTarihi->lt($bugun);
                            @endphp

                            <td class="siparis-durumu-gosterici">
                                @foreach ($durumlar as $key => $label)
                                    @if ($key == $mevcutDurum)
                                        <span class="durum-aktif">{{ $label }}</span>
                                    @else
                                        @if ($disabled)
                                            <span class="durum-link disabled" style="color: gray; cursor: not-allowed;"
                                                title="Sipariş teslim alındı ve tarihi geçmiş, düzenleme kapalıdır.">
                                                {{ $label }}
                                            </span>
                                        @else
                                            <a href="javascript:void(0);" class="durum-link" data-id="{{ $item->id }}"
                                                data-durum="{{ $key }}"
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
                            <td class="text-center">
                                <a href="javascript:void(0);" class="btn kaydet-buton" onclick="confirmDelete(this)"
                                    data-route="{{ route('genel_stokdelete', $item->id) }}">
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

            <nav aria-label="Page navigation example" class="border-top py-lg-3">
                <ul class="pagination justify-content-center">
                    {{-- Önceki sayfa linki --}}
                    <li class="page-item {{ $genel->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $genel->previousPageUrl() ?? '#' }}" tabindex="-1">Previous</a>
                    </li>

                    {{-- Sayfa numaraları --}}
                    @foreach ($genel->getUrlRange(1, $genel->lastPage()) as $page => $url)
                        <li class="page-item {{ $genel->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    {{-- Sonraki sayfa linki --}}
                    <li class="page-item {{ $genel->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $genel->nextPageUrl() ?? '#' }}">Next</a>
                    </li>
                </ul>
            </nav>

        </div>

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
                            {{-- <div class="col-md-4">
                                <label for="validationCustom01" class="form-label"> ÜRÜN ADI</label>
                                <input type="text" class="form-control" id="validationCustom01" name="urun_adi"
                                    placeholder="SCHNEIDER">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-8">
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
                                </div>

                                <div class="col-md-4">
                                    <label for="validationCustom02" class="form-label">Önceki Sipariş Adedi</label>
                                    <input type="text" class="form-control" id="validationCustom02"
                                        name="onceki_siparis_adedi" placeholder="20" readonly>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Kalan Adedi</label>
                                <input type="text" class="form-control" id="validationCustom02" name="kalan_adet"
                                    placeholder="7" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Güncel Sipariş Adedi</label>
                                <input type="text" class="form-control" id="validationCustom02"
                                    name="guncel_siparis_adedi" placeholder="30">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Sipariş Verildiği Yer</label>
                                <input type="text" class="form-control" id="validationCustom02"
                                    name="siparis_verildigi_yer" placeholder="KONYA ENERJİ">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Sipariş Tariihi</label>
                                <input type="date" class="form-control" id="validationCustom02" name="siparis_tarihi"
                                    placeholder="">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Sipariş Veren Kişi</label>
                                <input type="text" class="form-control" id="validationCustom02"
                                    name="siparis_veren_kisi" placeholder="">
                                <div class="valid-feedback">
                                    Looks good!
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
                                            name="onceki_siparis_adedi" value="{{ $item2->onceki_siparis_adedi }}"
                                            disabled>
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

        <div class="">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3  border-top">
                <div class="col-md-5 d-flex align-items-center">
                    {{-- <a href="{{ route('anasayfa') }}" class="app-brand-link gap-2">
                <img src="/assets/img/GNCTurco_Logo.png" alt="Resim bulunamadı" width="70" class="">
                </a> --}}
                    <span class="mb-3 mb-md-0 text-muted">© 2025 Company, Tarafından
                        Üretilmiştir...</span>
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
                    // Durum metnini güncelle
                    durumTd.textContent = yeniDurum;

                    // Önceki sınıfları temizle
                    durumTd.classList.remove(
                        'durum-Onaylandı',
                        'durum-Hazırlanıyor',
                        'durum-Kargoda',
                        'durum-TeslimEdildi',
                        'durum-İptalEdildi'
                    );

                    // Yeni sınıfı ekle
                    durumTd.classList.add(`durum-${yeniDurum.replace(/\s/g, '')}`);

                    // Eğer durum "sipariş teslim alındı" ise
                    if (yeniDurum.toLowerCase() === 'sipariş teslim alındı') {
                        const links = durumTd.querySelectorAll('.durum-link');
                        links.forEach(link => {
                            link.classList.add('disabled');
                            link.style.pointerEvents = 'none';
                            link.onclick = (e) => e.preventDefault();
                        });

                        const guncelAdetTd = document.querySelector(`#guncel_adet_${itemId}`);
                        const kalanAdetTd = document.querySelector(`#kalan_adet_${itemId}`);

                        if (guncelAdetTd && kalanAdetTd) {
                            const guncelAdet = parseInt(guncelAdetTd.textContent.trim()) || 0;
                            const kalanAdet = parseInt(kalanAdetTd.textContent.trim()) || 0;
                            const toplam = guncelAdet + kalanAdet;
                            kalanAdetTd.textContent = toplam;
                            console.log(`Güncellendi: kalan_adet_${itemId} = ${toplam}`);
                        } else {
                            console.warn(`Hücreler bulunamadı: guncel_adet_${itemId} veya kalan_adet_${itemId}`);
                        }

                    } else {
                        // Diğer durumlarda linkleri aktif et
                        const links = durumTd.querySelectorAll('.durum-link');
                        links.forEach(link => {
                            link.classList.remove('disabled');
                            link.style.pointerEvents = 'auto';
                            link.onclick = null;
                        });
                    }

                } else {
                    console.warn(`Sipariş ID ${itemId} için durum güncelleme TD'si bulunamadı.`);
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
                                    yeni_durum: yeniDurum
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

    @endsection
