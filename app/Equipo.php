<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table      = 'equipos';
    protected $primaryKey = ['id_pa','id_ju'];
    public $timestamps    = false;
    public $incrementing  = false;
}
