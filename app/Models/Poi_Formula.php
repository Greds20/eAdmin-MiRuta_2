<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poi_Formula extends Model
{
    use HasFactory;
    protected $fillable = [
    	'fk_id_poi',
    	'fk_id_formula',
    	'valor'
	];

	public $timestamps = false;
    protected $table = 'poi_formula';
    protected $primaryKey = ['fk_id_poi', 'fk_id_formula'];
    public $incrementing = false;
}
