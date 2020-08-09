<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glo_org_golongan extends Model
{
    protected $connection = 'sqlsrv';
    // protected $primaryKey = "id_emp"; 
    protected $table = "glo_org_golongan";
    
    public $incrementing = 'false';
    public $timestamps = false;
}
