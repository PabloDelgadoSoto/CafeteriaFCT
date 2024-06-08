<?php
// app/Models/Dato.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dato extends Model
{
    use HasFactory;

    public function bocadillo()
    {
        return $this->belongsTo(Bocadillo::class, 'bocadillo_nombre', 'nombre');
    }

    protected $fillable = [
        'nia',
        'name',
        'hora',
        'bocadillo_id',
        'ingrediente_extra',
        'descartados',
        'cantidad',
        'completado',
    ];
}
