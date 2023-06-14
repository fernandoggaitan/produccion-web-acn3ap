<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function productos()
    {
        //return $this->hasOne( Categoria::class, 'id', 'categoria_id' );
        return $this->hasMany( Producto::class, 'categoria_id', 'id' );
    }

}
