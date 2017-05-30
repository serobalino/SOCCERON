<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Equipos extends Model
{
  use Notifiable;
    protected $guard ='equ';
    protected $table = 'equipos';
    protected $primaryKey ='id_eq';
    public $incrementing= false;
}
