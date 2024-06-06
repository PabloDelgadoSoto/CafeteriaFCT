<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredientes_extra extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'timestamp'
    ];

    public function detalles_tickets(){
        return $this->hasMany(Detalles_ticket::class);
    }

    public static function buscarId($nombre){
        $id = Ingredientes_extra::select('id')->where('nombre', $nombre)->get();
        return $id[0];
    }

    public static function separar($str){
        $s = explode("-", $str);
        $datos = "";
        foreach($s as $i){
            $tmp = Ingredientes_extra::find((int)$i);
            $datos = $datos.(string)$tmp->nombre." ";
        }
        $datos = substr($datos, 0, -1);
        return $datos;
    }
}
