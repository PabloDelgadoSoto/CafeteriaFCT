<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'timestamp'
    ];
    public function categorias()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function bocadillos()
    {
        return $this->hasMany(Tipo::class);
    }
}
