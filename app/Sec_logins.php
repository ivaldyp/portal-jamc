<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sec_logins extends Model
{
    protected $connection = 'server12';
    protected $table = 'bpadjamc.dbo.sec_logins';
    public $timestamps = false;
}
