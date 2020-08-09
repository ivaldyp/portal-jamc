<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class book_transact extends Model
{
    protected $connection = 'sqlsrv';
    // protected $primaryKey = "ids"; 
    protected $table = "book_transact";

    public $timestamps = false;
    // public $incrementing = false;
}
