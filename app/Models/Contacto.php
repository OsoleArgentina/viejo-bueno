<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contacto';

    protected $fillable = [
        'google_maps_iframe',
        'direccion',
        'telefono',
        'correo',
        'whatsapp',
         'instagram',
        'facebook',
    ];
}
