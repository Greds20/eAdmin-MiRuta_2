<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poi_Factor extends Model
{
    use HasFactory;
    protected $fillable = [
    	'fk_id_poi',
    	'fk_id_factor',
    	'valor'
	];

	public $timestamps = false;
    protected $table = 'poi_factor';
    protected $primaryKey = 'fk_id_poi';
    public $incrementing = false;
}
