<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glo_kategori extends Model
{
	protected $connection = 'server12';
	protected $table = "bpadjamc.dbo.glo_kategori";
    public $incrementing = false;
	public $timestamps = false;
}
