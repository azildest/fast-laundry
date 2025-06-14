<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'artikel';

    protected $primaryKey = 'id_artikel';

    public $timestamps = true;

    protected $fillable = [
        'judul',
        'kategori',
        'isi',
        'gambar', 
        'status',
        'tanggal_terbit',
         'is_highlight',
    ];

    protected $dates = ['tanggal_terbit', 'created_at', 'updated_at', 'deleted_at'];
}
