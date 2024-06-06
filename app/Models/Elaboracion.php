<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elaboracion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
        'cantidad',
        'timestamp'
    ];

    public function bocadillos()
    {
        return $this->hasMany(Tipo::class);
    }

    public function ingredientes()
    {
        return $this->hasMany(Ingrediente::class);
    }

    public static function buscarId($id){
        return Elaboracion::all()->where('bocadillo_id', $id);
    }

    public static function buscarPorIngrediente($id){
        return Elaboracion::select('id')->where('ingrediente_id', $id)->get();
    }
}
