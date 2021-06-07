<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'administrador';
    protected $primaryKey = 'id_administrador';

	protected $fillable = [
		'alias',
		'prnombre',
		'sgnombre',
		'prapellido',
		'sgapellido',
		'contrasena',
		'recuperador',
		'tiempoRecuperador',
		'estado',
		'correo',
		'fk_id_rol', 
	];
}
