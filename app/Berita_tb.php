<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita_tb extends Model
{
    protected $connection = 'sqlsrv';
    // protected $primaryKey = "ids"; 
    protected $table = "berita_tb";

    public $timestamps = false;
    // public $incrementing = false;
}
