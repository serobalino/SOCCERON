<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Partidos extends Model
{
  use Notifiable;
    protected $guard ='par';
    protected $table = 'partidos';
    protected $primaryKey ='id_part';
    public $incrementing= false;
}
