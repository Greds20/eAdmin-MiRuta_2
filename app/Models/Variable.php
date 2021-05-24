<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    use HasFactory;
    protected $fillable = [
		'nombre',
		'valormaximo',
		'descripcion',
		'estado'
	];

	public $timestamps = false;
    protected $table = 'variable';
    protected $primaryKey = 'id_variable';
}
