<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'stock',
        'proveedor',
        'estado',
        'fecha',
        'tipo_producto_id',
    ];

    protected $casts = [
        'stock' => 'integer',
        'tipo_producto_id' => 'integer',
        'fecha' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class);
    }
}

