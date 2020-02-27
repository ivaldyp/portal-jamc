<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glo_kategori extends Model
{
	protected $connection = 'sqlsrv';
	protected $table = "glo_kategori";

	public $timestamps = false;
}
