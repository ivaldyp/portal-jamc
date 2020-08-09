<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kinerja_data extends Model
{
    protected $connection = 'sqlsrv';
	protected $table = "kinerja_data";
	// protected $primaryKey = "ids"; 
	// public $incrementing = false;
	public $timestamps = false;
}
