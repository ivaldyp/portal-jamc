<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kinerja_detail extends Model
{
    protected $connection = 'sqlsrv2';
	protected $table = "kinerja_detail";
	// protected $primaryKey = "ids"; 
	// public $incrementing = false;
	public $timestamps = false;
}
