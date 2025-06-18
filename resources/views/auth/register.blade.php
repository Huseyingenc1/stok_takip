  @extends('layout')
  @section('content')
      <div class="container-xxl">
          <div class="authentication-wrapper authentication-basic container-p-y">
              <div class="authentication-inner">

                  <div class="card">
                      <div class="card-body">
                          <div class="app-brand justify-content-center">
                              <div class="app-brand justify-content-center">
                                  @php
                                      $tenant = \App\Models\Tenant::find(session('selected_tenant_id'));
                                  @endphp

                                  @if ($tenant && $tenant->logo)
                                      <img src="{{ asset('storage/' . $tenant->logo) }}" alt="Resim bulunamadı"
                                          style="max-height: 150px; max-width: 180px; height: auto; width: auto;">
                                  @endif
                              </div>
                          </div>
                          <h4 class="mb-2 ">User Kayıt Tablosu</h4>
                          <h4 class="mb-2 text-center">Yeni Üye Kayıt Bilgisi</h4>
                          {{-- <p class="mb-4 text-center">Yeni Üye Kayıt Bilgisi</p> --}}
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
                          <div class="d-flex justify-content-center">
                              <form id="formAuthentication" class="mb-3" action="{{ route('register.post') }}"
                                  method="POST">
                                  @csrf
                                  <div class="mb-3 col-lg-12">
                                      <label for="username" class="form-label">Adınız Soyadınız</label>
                                      <input type="text" class="form-control" id="username" name="name"
                                          placeholder="Adınız Soyadınız" autofocus />
                                  </div>
                                  <label for="telefon" class="form-label">Telefon No :</label>
                                  <div class="mb-3 col-lg-12">
                                      <input type="tel" class="telefon form-control" id="telefon" name="telefon">
                                      <div class="valid-feedback">
                                          Geçerli görünüyor!
                                      </div>
                                  </div>

                                  <div class="mb-3 col-12">
                                      <label for="email" class="form-label">Email</label>
                                      <input type="text" class="form-control" id="email" name="email"
                                          placeholder="Mail@deneme.com" />
                                  </div>
                                  <div class="mb-3 form-password-toggle col-lg-12">
                                      <label class="form-label" for="password">Şifre</label>
                                      <div class="input-group input-group-merge">
                                          <input type="password" id="password" class="form-control" name="password"
                                              placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                              aria-describedby="password" />
                                          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                      </div>
                                  </div>
                                  <div class="mb-3 col-12">
                                      <label for="email" class="form-label">Pozisyon</label>
                                      <input type="text" class="form-control" name="role" value="Çalışan" disabled />
                                  </div>
                                  <div class="pt-4 d-flex justify-content-center">
                                      <button class="btn btn-primary d-grid">Kayıt Ol</button>
                                  </div>
                              </form>
                          </div>



                      </div>

                  </div>
                  <div class="flex-grow-1 container-p-y">
                      <div class="card">
                          <div class="card-body">
                              <h5 class="card-header text-center">KULLANICI TABLOSU</h5>
                              <div class="card-datatable text-nowrap">
                                  <div id="DataTables_Table_0_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">

                                      <div class="justify-content-between dt-layout-table">
                                          <div
                                              class="d-md-flex justify-content-between align-items-center dt-layout-full table-responsive">

                                              <table class="datatables-ajax table table-bordered dataTable"
                                                  id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"
                                                  style="width: 100%;">
                                                  <thead>
                                                      <tr>
                                                          <th data-dt-column="0" rowspan="1" colspan="1"
                                                              class="dt-orderable-asc dt-orderable-desc dt-ordering-asc"
                                                              aria-sort="ascending"
                                                              aria-label="Full name: Activate to invert sorting"
                                                              tabindex="0">
                                                              <span class="dt-column-title" role="button">Full
                                                                  name</span><span class="dt-column-order"></span>
                                                          </th>
                                                          <th data-dt-column="1" rowspan="1" colspan="1"
                                                              class="dt-orderable-asc dt-orderable-desc"
                                                              aria-label="Email: Activate to sort" tabindex="0">
                                                              <span class="dt-column-title" role="button">Email</span><span
                                                                  class="dt-column-order"></span>
                                                          </th>
                                                          <th data-dt-column="2" rowspan="1" colspan="1"
                                                              class="dt-orderable-asc dt-orderable-desc"
                                                              aria-label="Position: Activate to sort" tabindex="0">
                                                              <span class="dt-column-title"
                                                                  role="button">Position</span><span
                                                                  class="dt-column-order"></span>
                                                          </th>
                                                          <th data-dt-column="2" rowspan="1" colspan="1"
                                                              class="dt-orderable-asc dt-orderable-desc"
                                                              aria-label="Position: Activate to sort" tabindex="0">
                                                              <span class="dt-column-title"
                                                                  role="button">TELEFON</span><span
                                                                  class="dt-column-order"></span>
                                                          </th>
                                                          <th data-dt-column="2" rowspan="1" colspan="1"
                                                              class="dt-orderable-asc dt-orderable-desc"
                                                              aria-label="Position: Activate to sort" tabindex="0">
                                                              <span class="dt-column-title"
                                                                  role="button">Düzenle</span><span
                                                                  class="dt-column-order"></span>
                                                          </th>
                                                          <th data-dt-column="2" rowspan="1" colspan="1"
                                                              class="dt-orderable-asc dt-orderable-desc"
                                                              aria-label="Position: Activate to sort" tabindex="0">
                                                              <span class="dt-column-title" role="button">Sil</span><span
                                                                  class="dt-column-order"></span>
                                                          </th>

                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      @foreach ($user as $users)
                                                          <tr>
                                                              @if ($users->role != 0)
                                                                  <td class="sorting_1">{{ $users->name }}</td>
                                                                  <td>{{ $users->email }}</td>
                                                                  <td>
                                                                      @if ($users->role == 0)
                                                                          Admin
                                                                      @elseif ($users->role == 1)
                                                                          Yönetici
                                                                      @else
                                                                          Çalışan
                                                                      @endif
                                                                  </td>
                                                                  <td>{{ $users->telefon }}</td>
                                                                  <td>
                                                                      <a data-bs-toggle="modal"
                                                                          title="{{ $users->ad }}" type="button"
                                                                          data-bs-target="#modalCenter{{ $users->id }}"
                                                                          href="{{ route('user_update', ['id' => $users->id]) }}"
                                                                          role="button">
                                                                          <img src="assets/img/ikon19.png" alt=""
                                                                              width="30" class="menu-icon tf-icons">
                                                                      </a>
                                                                  </td>
                                                                  <td>
                                                                      <a href="{{ route('user_delete', $users->id) }}"
                                                                          class="btn kaydet-buton">
                                                                          <img src="assets/img/ikon16.png" alt=""
                                                                              width="30" class="menu-icon tf-icons">
                                                                      </a>
                                                                  </td>
                                                              @else
                                                                  <td colspan="6" class="text-muted text-center">Admin
                                                                      bilgileri gizlenmiştir</td>
                                                              @endif
                                                          </tr>
                                                      @endforeach

                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="d-flex justify-content-around">
          <span class="app-brand-link gap-sm-0  text-muted">
              <img src="/assets/img/GNCTurco_Logo.png" alt="Resim bulunamadı" width="50" class="">
              <small class="text-center"><strong class="text-center"> HÜSEYİN GENÇ </strong> Tarafından
                  Üretilmiştir... © 2025 </small>
          </span>
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

      @foreach ($user as $item2)
          <div class="mt-3">
              <div class="modal fade" id="modalCenter{{ $item2->id }}" aria-labelledby="modalToggleLabel"
                  tabindex="-1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-centered">
                      <form action="{{ route('user_update') }}" method="post">
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
                                      <label for="validationCustom01" class="form-label"> Adı Soyadı</label>
                                      <input type="text" class="form-control" id="validationCustom01" name="name"
                                          value="{{ $item2->name }}">
                                      <div class="valid-feedback">
                                          Looks good!
                                      </div>
                                  </div>
                                  <div class="col-md-5 w-50">
                                      <label for="validationCustom02" class="form-label">Email</label>
                                      <input type="email" class="form-control" id="validationCustom02" name="email"
                                          placeholder="" value="{{ $item2->email }}">
                                      <div class="valid-feedback">
                                          Looks good!
                                      </div>
                                  </div>
                                  <div class="col-md-5 w-50">
                                      <label for="role" class="form-label">Pozisyon</label>
                                      <select name="role" id="role" class="form-select select2"
                                          data-placeholder="Pozisyon Seçiniz">
                                          <option></option> {{-- Select2 için boş seçenek --}}
                                          <option value="1"
                                              {{ old('role', $item2->role ?? '') == 1 ? 'selected' : '' }}>Yönetici
                                          </option>
                                          <option value="2"
                                              {{ old('role', $item2->role ?? '') == 2 ? 'selected' : '' }}>Çalışan</option>
                                      </select>
                                  </div>
                                  <div class="col-md-5 w-50">
                                      <label for="telefon" class="form-label">Telefon</label>
                                      <input type="tel" class="form-control" id="telefon" name="telefon" required
                                          value="{{ $item2->telefon }}">
                                      <div class="valid-feedback">
                                          Geçerli görünüyor!
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


      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <!-- Select2 JS -->
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

      <!-- Select2 Başlatma -->
      <script>
          $(document).ready(function() {
              $('.select2').select2({
                  width: '100%',
                  placeholder: $(this).data('placeholder') || "Seçiniz",
                  allowClear: true,
                  theme: 'bootstrap-5' // Bootstrap uyumu varsa
              });
          });
      </script>
      <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>

      <script>
          const input = document.querySelector("#telefon");
          const iti = window.intlTelInput(input, {
              initialCountry: "tr",
              preferredCountries: ["tr", "de", "us"],
              separateDialCode: true,
              formatOnDisplay: true,
              utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js"
          });
      </script>
  @endsection
