<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    use HasFactory;
    protected $fillable = [
		'nombre',
		'peso',
		'valormaximo',
		'valorminimo',
		'descripcion',
		'estado',
		'fk_id_formula'
	];

	public $timestamps = false;
    protected $table = 'factor';
    protected $primaryKey = 'id_factor';
}
