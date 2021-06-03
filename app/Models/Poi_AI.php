<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poi_AI extends Model
{
    use HasFactory;
    public $timestamps = false;
	public $incrementing = false;
    protected $table = 'information_schema.TABLES';

	protected $fillable = [
		'AUTO_INCREMENT', 
	];
}
