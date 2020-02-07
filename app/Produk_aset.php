<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk_aset extends Model
{
	protected $connection = 'sqlsrv';
    protected $primaryKey = "ids"; 
    protected $table = "new_icon_produk";
}
