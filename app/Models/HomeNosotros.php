<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeNosotros extends Model
{
    protected $table = 'home_nosotros';

    protected $fillable = [
        'titulo',
        'descripcion',
        'path',
    ];
}
