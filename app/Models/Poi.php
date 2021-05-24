<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poi extends Model
{
    use HasFactory;
    public $timestamps = false;
	public $incrementing = false;
    protected $table = 'poi';
    protected $primaryKey = 'id_poi';

	protected $fillable = [
		'nombre', 
		'coordenadax', 
		'coordenaday', 
		'tiempoestancia', 
		'descripcion', 
		'imagen',
		'estado', 
		'fk_id_municipio',
	];
}
