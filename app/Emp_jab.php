<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emp_jab extends Model
{
    protected $connection = 'server12';
    protected $table = 'bpaddtfake.dbo.emp_jab';
    public $incrementing = 'false';
    public $timestamps = false;
}
