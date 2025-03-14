<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Novedad extends Model
{
    protected $table = 'novedades';

    protected $fillable = [
        'orden',
        'titulo',
        'subtitulo',
        'descripcion_corta',
        'descripcion_larga',
        'path',
    ];
}
