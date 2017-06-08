<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cancha extends Model{
    protected $table      = 'canchas';
    protected $primaryKey = 'id_ca';
    public $timestamps    = false;
}
