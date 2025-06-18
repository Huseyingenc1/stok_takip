<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class stok_takip_pdf extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "stok_takip_pdf";
    protected $fillable = [
        'tenant_id',
        'pdf_adi',
        'pdf_tarihi',
        'dosya_yolu',
    ];
    public $timestamps = true;
}
