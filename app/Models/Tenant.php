<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "tenant";

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'domain_adress',  
        'aktif_mi',
        'logo',
    ];

    public $timestamps = false;

    public function __toString()
    {
        return $this->name;
    }
}
