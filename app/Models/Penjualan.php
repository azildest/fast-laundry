<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjualan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $dates = ['pesanan_dibuat'];

    protected $fillable = [
        'id_penjualan',
        'id_layanan',
        'berat',
        'total_harga',
        'nama_customer',
        'whatsapp',
        'status',
        'pesanan_selesai',
        'pesanan_dibuat',
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }

}
