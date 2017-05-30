<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $table = 'jugadores';
    protected $primaryKey ='cedula_ju';
    public $incrementing= false;
    public $timestamps=false;
    
}
