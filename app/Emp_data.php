<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emp_data extends Model
{
    protected $connection = 'server12';
    protected $table = 'bpaddtfake.dbo.emp_data';
    public $incrementing = 'false';
    public $timestamps = false;
}
