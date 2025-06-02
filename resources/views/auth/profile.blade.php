@extends('layout')
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success text text-success">
            <h4 class="text-center"> {{ session()->get('success') }} </h4>
        </div>
    @endif
    <div class="pagetitle pt-5">
        {{-- <section class="section profile"> --}}
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Genel
                                    Bakış</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Profil
                                    Düzenle</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Şifreyi Değiştir</button>
                            </li>
                        </ul>
                        <hr>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h3 class="card-title">Profil Detayları</h3>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">İsim Soyisim :</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email :</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Kullanıcı Rolü :</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ auth()->user()->role }}

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <form action="/profile_post" method="post">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">İsim
                                                Soyisim
                                            </label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="fullName"
                                                    value="{{ auth()->user()->name }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email"
                                                    value="{{ auth()->user()->email }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">
                                                Kullanıcı Rolü
                                            </label>
                                            <div class="col-md-8 col-lg-9">
                                                {{ auth()->user()->role }}
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Güncelle</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <form action="/profil_change" method="get">
                                @csrf
                                <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Güncel
                                        Şifre</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="current_password" type="password" class="form-control"
                                            id="currentPassword">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Yeni
                                        Şifre</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password" type="password" class="form-control" id="newPassword">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" id="sifreDegistirButton">Şifreyi
                                        Değiştir</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </section> --}}
    </div>
@endsection
