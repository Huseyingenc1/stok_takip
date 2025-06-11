<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\sectionsController;
use App\Http\Middleware\AuthCheck;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;



Route::get('', function () {
    return redirect()->route('login.get');
});

Route::get('/login', [authController::class, 'loginget'])->name('login.get');
Route::post('/session', [authController::class, 'loginstore'])->name('login.post');


Route::get('/register', [authController::class, 'registercreate'])->name('register.get');
Route::post('/register', [authController::class, 'registerstore'])->name('register.post');

Route::get('/set_password', [authController::class, 'index'])->name('set_password');
Route::post('/set_password/update', [authController::class, 'update'])->name('set_password_update');

Route::get('/login/forgot-password', [authController::class, 'resetcreate'])->name('forgot_password');
Route::post('/forgot-password', [authController::class, 'sendEmail']);
Route::get('/reset-password/{token}', [authController::class, 'resetPass'])->name('password.reset');
Route::post('/reset_password', [authController::class, 'changePassword'])->name('password_update');

Route::post('/forgot-password', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email',
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return back()->with('status', trans($status));
});



Route::middleware(AuthCheck::class)->group(function () {

    Route::get('/', [SectionsController::class, 'home'])->name('anasayfa');

    Route::post('genel_stok_listesi_post', [SectionsController::class, 'genel_stokCreate'])->name('genel_stokCreate');
    Route::post('genel_stok_listesi_update', [SectionsController::class, 'genel_stokupdate'])->name('genel_stokupdate');
    Route::get('/genel_stok_listesi/stok_listesi/{id}', [SectionsController::class, 'genel_stokdelete'])->name('genel_stokdelete');
    Route::get('/search', [SectionsController::class, 'search'])->name('search');
    Route::post('/genel-stok-update/{id}', [SectionsController::class, 'genel_eksilt_artır'])->name('genel_eksilt_artır');
    Route::post('/siparis-durum-guncelle/{id}', [SectionsController::class, 'siparis_durum_guncelle'])->name('siparis_durum_guncelle');
    Route::get('/stok-ara', [SectionsController::class, 'stokAra'])->name('stok.ara');

    Route::post('/stok_mail_gonder', [SectionsController::class, 'stok_mail_gonder'])->name('stok_mail_gonder');




    Route::get('/stok_listesi', [SectionsController::class, 'stok'])->name('stok');
    Route::post('stok_listesi_post', [SectionsController::class, 'stokCreate'])->name('stok_listesiPost');
    Route::post('stok_listesi_update', [SectionsController::class, 'stokupdate'])->name('stokupdate');
    Route::get('/stok_listesi/stok_listesi/{id}', [SectionsController::class, 'stokdelete'])->name('stokdelete');

    Route::get('/user', [SectionsController::class, 'login'])->name('login');
});
Route::get('/logout', [authController::class, 'destroy'])->name('logout');
