<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hu_kategori extends Model
{
    protected $connection = 'sqlsrv';
	protected $table = "hu_kategori";

	public $timestamps = false;
}
