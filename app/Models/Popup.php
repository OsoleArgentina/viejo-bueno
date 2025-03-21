<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $table = 'popup';

    protected $fillable = [
        'titulo',
        'descripcion',
        'desc_boton',
    ];
}
