<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model{
  protected $table      = 'partidas';
  protected $primaryKey = 'id_pa';
  public $timestamps    = false;
}
