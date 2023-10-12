<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sec_access extends Model
{
    protected $connection = 'server12';
    protected $table = 'bpadjamc.dbo.sec_access';
    public $timestamps = false;
}
