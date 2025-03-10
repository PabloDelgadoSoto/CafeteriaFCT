<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'timestamp'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function detalles_tickets(){
        return $this->hasMany(Detalles_ticket::class);
    }
}
