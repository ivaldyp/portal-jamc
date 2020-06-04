<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class New_icon_produk extends Model
{
    protected $connection = 'sqlsrv';
	protected $table = "new_icon_produk";
	// protected $primaryKey = "ids"; 
	// public $incrementing = false;
	public $timestamps = false;
}
