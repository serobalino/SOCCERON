<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conformado extends Model
{
  protected $table = 'conformado';
  protected $primaryKey = ['id_ju','id_eq'];
  public $incrementing= false;
}
