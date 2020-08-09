<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glo_dik extends Model
{
    protected $connection = 'sqlsrv';
    // protected $primaryKey = "id_emp"; 
    protected $table = "glo_dik";
    
    public $incrementing = 'false';
    public $timestamps = false;
}
