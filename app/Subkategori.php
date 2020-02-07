<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subkategori extends Model
{
	protected $connection = 'sqlsrv';
    protected $table = "glo_subkategori";
    // protected $primaryKey = "ids"; 
    // public $incrementing = false;
}
