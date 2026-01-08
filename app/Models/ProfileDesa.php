<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileDesa extends Model
{
    protected $table = 'profile_desa';

    protected $fillable = [
        'visi',
        'misi',
        'sejarah_desa',
        'bagan_organisasi',
    ];
}
