<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bocadillo extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'timestamp'
    ];
    public function tipos()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function detalles_tickets()
    {
        return $this->hasMany(Detalles_ticket::class);
    }

    public function elaboracionss()
    {
        return $this->belongsToMany(Elaboracion::class);
    }
    // Funcion para comprobar si hay ingredientes suficientes para hacer un bocadillo
    public function verificarDisponibilidad()
    {
        foreach ($this->ingredientes as $ingrediente) {
            if ($ingrediente->cantidad <= 0) {
                $this->disponible = false;
                $this->save();
                break;
            }
            if ($ingrediente->cantidad > 0) {
                $this->disponible = true;
                $this->save();
            }
        }
    }
}
