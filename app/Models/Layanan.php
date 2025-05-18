<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layanan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'layanan';

    protected $fillable = [
        'id_layanan',
        'harga_per_kg',
        'nama_layanan',
        'deskripsi',
    ];
}
