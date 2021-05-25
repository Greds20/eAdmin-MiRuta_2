<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'establecimiento';
    protected $primaryKey = 'id_establecimiento';

    protected $fillable = [
		'nombre', 
		'descripcion', 
		'coordenadaX',
		'coordenadaY',
		'estado',
		'fk_id_municipio',
		'fk_id_tipo'
	];
}
