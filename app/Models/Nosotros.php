<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nosotros extends Model
{
    protected $table = 'nosotros';

    protected $fillable = [
        'titulo',
        'descripcion',
        'banner_principal',
        'banner_secundario',
    ];
}
