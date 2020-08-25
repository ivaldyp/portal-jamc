<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hu_jenis extends Model
{
    protected $connection = 'sqlsrv';
	protected $table = "hu_jenis";

	public $timestamps = false;
}
