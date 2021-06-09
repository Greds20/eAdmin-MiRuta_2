<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'administrador';
    protected $primaryKey = "id_administrador";

    protected $fillable = [
        'alias',
        'prNombre',
        'sgNombre',
        'prApellido',
        'sgApellido',
        'contrasena',
        'correo',
        'estado',
        'fk_id_rol'
    ];

    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}
