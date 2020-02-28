<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emp_jab extends Model
{
    protected $connection = 'sqlsrv2';
    // protected $primaryKey = "id_emp"; 
    protected $table = "emp_jab";
    
    public $incrementing = 'false';
    public $timestamps = false;
}
