<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Canchas extends Model
{
    use Notifiable;

    protected $guard ='can';
    protected $table = 'canchas';
    protected $primaryKey ='id_can';
    public $incrementing= false;
}
