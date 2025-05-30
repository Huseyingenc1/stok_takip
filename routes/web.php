<?php

use App\Http\Controllers\sectionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('genel_stok');
});
Route::get('/', [App\Http\Controllers\SectionsController::class, 'welcome'])->name('anasayfa');
Route::post('genel_stok_listesi_post', [sectionsController::class, 'genel_stokCreate'])->name('genel_stokCreate');
Route::post('genel_stok_listesi_update', [sectionsController::class, 'genel_stokupdate'])->name('genel_stokupdate');
Route::get('/genel_stok_listesi/stok_listesi/{id}', [sectionsController::class, 'genel_stokdelete'])->name('genel_stokdelete');
Route::get('/search', [sectionsController::class, 'search'])->name('search');

Route::post('/genel-stok-update/{id}', [sectionsController::class, 'genel_eksilt_artır'])->name('genel_eksilt_artır');
Route::post('/siparis-durum-guncelle/{id}', [sectionsController::class, 'siparis_durum_guncelle'])->name('siparis_durum_guncelle');
Route::get('/stok-ara', [App\Http\Controllers\sectionsController::class, 'stokAra'])->name('stok.ara');


Route::get('/stok_listesi', [App\Http\Controllers\SectionsController::class, 'stok'])->name('stok');
Route::post('stok_listesi_post', [sectionsController::class, 'stokCreate'])->name('stok_listesiPost');
Route::post('stok_listesi_update', [sectionsController::class, 'stokupdate'])->name('stokupdate');
Route::get('/stok_listesi/stok_listesi/{id}', [sectionsController::class, 'stokdelete'])->name('stokdelete');
