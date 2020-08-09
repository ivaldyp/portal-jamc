<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    //protected $guard = 'logins';

    protected $connection = 'sqlsrv';
    protected $table = 'sec_logins';
    protected $primaryKey = 'usname';
    public $incrementing = false;
    // protected $keyType = 'string';

    public function getAuthPassword()
    {
        return $this->passmd5;
    }
}