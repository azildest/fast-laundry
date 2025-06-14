<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'kontak';

    protected $fillable = ['address', 'phone', 'email',  'facebook_url', 'instagram_url', 'linkedin_url', 'x_url', 'maps_embed'];
}

