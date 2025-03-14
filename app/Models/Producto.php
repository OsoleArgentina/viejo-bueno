<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'marca_id',
        'precio',
        'orden',
        'destacado',
        'ficha_tecnica',
        'subcategoria_id',
    ];

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function imagenes()
    {
        return $this->hasMany(ProductosImagenes::class);
    }
}
