<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capacitacion extends Model
{
    protected $table = 'capacitaciones';

    protected $fillable = [
        'orden',
        'titulo',
        'descripcion',
        'youtube_iframe',
        'path',
    ];
}
