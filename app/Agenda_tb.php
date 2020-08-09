<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda_tb extends Model
{
    protected $connection = 'sqlsrv';
    // protected $primaryKey = "ids"; 
    protected $table = "agenda_tb";

    public $timestamps = false;
    // public $incrementing = false;
}
