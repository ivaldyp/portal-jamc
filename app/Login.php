<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    use Notifiable;
    protected $connection = 'sqlsrv2';
    protected $table = 'emp_data';

    protected $fillable = ['sts'
      ,'uname'
      ,'tgl'
      ,'ip'
      ,'logbuat'
      ,'createdate'
      ,'id_emp'
      ,'nip_emp'
      ,'nrk_emp'
      ,'nm_emp'
      ,'gelar_dpn'
      ,'gelar_blk'
      ,'jnkel_emp'
      ,'tempat_lahir'
      ,'tgl_lahir'
      ,'idagama'
      ,'alamat_emp'
      ,'tlp_emp'
      ,'email_emp'
      ,'status_emp'
      ,'ked_emp'
      ,'status_nikah'
      ,'gol_darah'
      ,'nm_bank'
      ,'cb_bank'
      ,'an_bank'
      ,'nr_bank'
      ,'no_taspen'
      ,'npwp'
      ,'no_askes'
      ,'no_jamsos'
      ,'tgl_join'
      ,'tgl_end'
      ,'reason'
      ,'idgroup'
      ,'pass_emp'
      ,'foto'
      ,'lastlogin'
      ,'lastip'
      ,'lasttemp'
      ,'dwinternal'
      ,'dwaset'
      ,'ttd'
      ,'telegram_id'
      ,'passmd5'];

    protected $hidden = ['pass_emp', 'passmd5', 'remember_token'];


}