<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalles_ticket extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'timestamp'
    ];

    public function tickets(){
        return $this->belongsTo(Ticket::class);
    }

    public function bocadillos(){
        return $this->hasMany(Tipo::class);
    }

    public function ingredientes_extras(){
        return $this->hasMany(Ingredientes_extra::class);
    }
}
