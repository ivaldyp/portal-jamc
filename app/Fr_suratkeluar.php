<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fr_suratkeluar extends Model
{
    protected $connection = 'sqlsrv2';
	// protected $primaryKey = "ids"; 
	protected $table = "fr_suratkeluar";
	
	// public $incrementing = 'false';
	public $timestamps = false;
}
