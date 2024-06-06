<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
        'cantidad',
        'timestamp'
    ];

    public function elaboracions()
    {
        return $this->belongsToMany(Elaboracion::class);
    }

    public static function buscarId($nombre){
        $id = Ingrediente::select('id')->where('nombre', $nombre)->get();
        return $id[0];
    }

    public static function separar($str){
        $s = explode("-", $str);
        $datos = "";
        foreach($s as $i){
            $tmp = Ingrediente::find((int)$i);
            $datos = $datos.(string)$tmp->nombre." ";
        }
        $datos = substr($datos, 0, -1);
        return $datos;
    }
}
