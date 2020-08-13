<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hu_dasarhukum extends Model
{
    protected $connection = 'sqlsrv';
	protected $table = "hu_dasarhukum";

	public $timestamps = false;
}
