<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_ruang extends Model
{
    protected $connection = 'sqlsrv';
    // protected $primaryKey = "ids"; 
    protected $table = "book_ruang";

    public $timestamps = false;
    // public $incrementing = false;
}
