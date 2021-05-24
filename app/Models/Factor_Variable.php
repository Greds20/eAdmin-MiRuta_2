<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factor_Variable extends Model
{
    use HasFactory;
    protected $fillable = [
		'fk_id_variable',
		'fk_id_factor'
	];

	public $timestamps = false;
    protected $table = 'factor_variable';
    protected $primaryKey = 'fk_id_factor';
}
