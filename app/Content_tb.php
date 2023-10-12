<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content_tb extends Model
{
    protected $connection = 'server12';
	protected $table = "bpadjamc.dbo.content_tb";
    public $incrementing = false;
	public $timestamps = false;
}
