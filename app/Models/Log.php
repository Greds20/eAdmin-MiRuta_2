<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'log';
    protected $primaryKey = 'id_log';

    protected $fillable = [
		'fecha',
		'hora',
		'fk_id_administrador',
		'fk_id_evento',
		'fk_id_seccion'
	];
}
