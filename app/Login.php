<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    use Notifiable;

    protected $connection = 'sqlsrv2';
    protected $table = 'sec_logins';
    protected $primaryKey = 'ids';
    // public $incrementing = false;

    public function getAuthPassword()
    {
        return $this->passmd5;
    }
}