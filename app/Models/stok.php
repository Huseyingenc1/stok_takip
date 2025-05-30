<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class stok extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "stok";
    protected $fillable = [
        'urun_adi',
        'model',
        'kw_degeri',
    ];
    public $timestamps = false;
}
