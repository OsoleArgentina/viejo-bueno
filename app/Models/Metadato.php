<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metadato extends Model
{
    protected $table = 'metadatos';

    protected $fillable = [
        'seccion',
        'keyword',
        'descripcion',
    ];
}
