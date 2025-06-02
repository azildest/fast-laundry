<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'akun';
    protected $primaryKey = 'id_akun';

    protected $fillable = [
        'id_akun',
        'level',
        'email',
        'username',
        'password',
        'no_telp'
    ];
}
