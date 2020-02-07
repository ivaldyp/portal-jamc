<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setup_tb extends Model
{
	protected $connection = 'sqlsrv';
    protected $primaryKey = "ids"; 
    protected $table = "setup_tb";
}
