<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Elegirnos extends Model
{
    protected $table = 'nosotros_elegirnos';

    protected $fillable = [
        'descripcion',
        'orden',
        'path',
    ];
}
