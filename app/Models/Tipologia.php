<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipologia extends Model
{
    use HasFactory;
    protected $fillable = [
		'nombre', 
		'descripcion', 
		'estado'
	];

	public $timestamps = false;
    protected $table = 'Tipologia';
    protected $primaryKey = 'ID_TIPOLOGIA';
}
