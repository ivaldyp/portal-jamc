<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emp_gol extends Model
{
    protected $connection = 'server76';
    protected $table = "bpaddtfake.dbo.emp_gol";
    
    public $incrementing = 'false';
    public $timestamps = false;
}
