<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glo_disposisi_penanganan extends Model
{
    protected $connection = 'sqlsrv';
	protected $table = "glo_disposisi_penanganan";

	public $timestamps = false;
}
