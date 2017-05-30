<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Jugador extends Model
{
  use Notifiable;
    protected $guard ='jug';

    protected $table = 'jugadores';
    protected $primaryKey ='cedula_ju';
    public $incrementing= false;
    public $timestamps=false;

    public function getAuthIdentifier() {
        return $this->cedula_ju;
    }
    public function getAuthPassword() {
        return $this->contrasena_ju;
    }
    public function getRememberToken() {
        return $this->token_ju;
    }
    public function setRememberToken($token) {
        $this->token_ju = $token;
    }
    public function getRememberTokenName() {
        return 'token_ju';
    }
    public function getPasswordAttribute() {
        return $this->contrasena_ju;
    }
    public function setPasswordAttribute($contrasena) {
        $this->contrasena_ju = Hash::make($contrasena);
    }

}
