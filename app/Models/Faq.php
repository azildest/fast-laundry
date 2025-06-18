<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use SoftDeletes;

    protected $table = 'faq'; 
   
    protected $primaryKey = 'id_pertanyaan'; 

    protected $fillable = ['pertanyaan', 'jawaban', 'status'];

    public $incrementing = true;
    protected $keyType = 'int';
}

