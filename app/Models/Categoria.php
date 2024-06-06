<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'timestamp'
    ];

    public function bocadillos(){
        return $this->hasMany(Tipo::class);
    }
}
