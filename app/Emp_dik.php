<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emp_dik extends Model
{
    protected $connection = 'server12';
    protected $table = "bpaddtfake.dbo.emp_dik";
    
    public $incrementing = 'false';
    public $timestamps = false;
}
