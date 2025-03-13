<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'marca',
        'precio',
        'subcategoria_id',
        'ficha_tecnica',
    ];

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function imagenes()
    {
        return $this->hasMany(ProductosImagenes::class);
    }
}
