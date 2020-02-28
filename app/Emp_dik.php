<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emp_dik extends Model
{
    protected $connection = 'sqlsrv2';
    // protected $primaryKey = "id_emp"; 
    protected $table = "emp_dik";
    
    public $incrementing = 'false';
    public $timestamps = false;
}
