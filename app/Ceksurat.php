<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ceksurat extends Model
{
	protected $connection = 'sqlsrv3';
    // protected $primaryKey = "ids"; 
    protected $table = "fr_disposisi";

    public $timestamps = false;
    // public $incrementing = false;
}
