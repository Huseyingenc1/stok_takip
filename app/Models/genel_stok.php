<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class genel_stok extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "genel_stok";
    protected $fillable = [
        'urun_adi',
        'model',
        'kw',
        'onceki_siparis_adedi',
        'kalan_adet',
        'guncel_siparis_adedi',
        'siparis_verildigi_yer',
        'siparis_tarihi',
        'siparis_veren_kisi',
        'siparis_durumu',
        'updated_at',
    ];
    public $timestamps = false;
}
