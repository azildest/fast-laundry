<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use SoftDeletes;

    protected $table = 'faq'; // pastikan ini benar
   
    protected $primaryKey = 'id_pertanyaan'; // ganti primary key default

    protected $fillable = ['pertanyaan', 'jawaban', 'status'];

    public $incrementing = true;
    protected $keyType = 'int';
}

