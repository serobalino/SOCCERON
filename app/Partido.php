<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
  protected $table = 'partidos';
  protected $primaryKey ='id_part';
  public    $timestamps   = false;
  protected $fillable     = ['id_eq', 'id_can','fecha_part'];
}
