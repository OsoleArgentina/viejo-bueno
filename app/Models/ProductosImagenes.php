<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductosImagenes extends Model
{
    protected $table = 'productos_imagenes';

    protected $fillable = [
        'path',
        'producto_id',
    ];

    public function producto()
    {
        return $this->belongsTo(Subcategoria::class);
    }
}
