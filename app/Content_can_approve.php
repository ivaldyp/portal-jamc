<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content_can_approve extends Model
{
    protected $connection = 'server12';
    protected $table = 'bpadjamc.dbo.content_can_approve';
    public $timestamps = false;
}
