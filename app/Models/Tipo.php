<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'tipo';
    protected $primaryKey = 'id_tipo';

    protected $fillable = [
		'nombre'
	];
}
