<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    use HasFactory;
    protected $fillable = [
		'nombre',
		'descripcion',
		'estado'
	];

	public $timestamps = false;
    protected $table = 'formula';
    protected $primaryKey = 'id_formula';
}
