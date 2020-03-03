<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;

use App\Emp_data;
use App\Emp_dik;
use App\Emp_gol;
use App\Emp_jab;
use App\Glo_dik;
use App\Glo_org_golongan;
use App\Glo_org_jabatan;
use App\Glo_org_kedemp;
use App\Glo_org_lokasi;
use App\Glo_org_statusemp;
use App\Glo_org_unitkerja;
use App\Sec_access;

session_start();

class ProfilController extends Controller
{
    use SessionCheckTraits;

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function pegawai(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 369);

		$emp_data = Emp_data::
						where('id_emp', Auth::user()->id_emp)
						->where('sts', 1)
						->first();

		$emp_dik = Emp_dik::with('dik')
						->where('noid', Auth::user()->id_emp)
						->where('sts', 1)
						->get();

		$emp_gol = Emp_gol::with('gol')
						->where('noid', Auth::user()->id_emp)
						->where('sts', 1)
						->get();

		$emp_jab = Emp_jab::with('jabatan')
						->with('lokasi')
						->with('unit')
						->whereIn('noid', ['1.20.512.17002',
'1.20.512.17008',
'1.20.512.17010',
'1.20.512.17014',
'1.20.512.17015',
'1.20.512.17021',
'1.20.512.17024',
'1.20.512.17029',
'1.20.512.17030',
'1.20.512.17031',
'1.20.512.17032',
'1.20.512.17037',
'1.20.512.17039',
'1.20.512.17041',
'1.20.512.17044',
'1.20.512.17045',
'1.20.512.17047',
'1.20.512.17048',
'1.20.512.17057',
'1.20.512.17067',
'1.20.512.17072',
'1.20.512.17073',
'1.20.512.17074',
'1.20.512.17077',
'1.20.512.17080',
'1.20.512.17082',
'1.20.512.17083',
'1.20.512.17085',
'1.20.512.17087',
'1.20.512.17094',
'1.20.512.17095',
'1.20.512.17097',
'1.20.512.17098',
'1.20.512.17099',
'1.20.512.17100',
'1.20.512.17102',
'1.20.512.17108',
'1.20.512.17109',
'1.20.512.17110',
'1.20.512.17111',
'1.20.512.17114',
'1.20.512.17115',
'1.20.512.17116',
'1.20.512.17118',
'1.20.512.17121',
'1.20.512.17125',
'1.20.512.17127',
'1.20.512.17129',
'1.20.512.17139',
'1.20.512.17141',
'1.20.512.17144',
'1.20.512.17146',
'1.20.512.17154',
'1.20.512.17161',
'1.20.512.17164',
'1.20.512.17167',
'1.20.512.17170',
'1.20.512.17178',
'1.20.512.17180',
'1.20.512.17182',
'1.20.512.17183',
'1.20.512.17184',
'1.20.512.17188',
'1.20.512.17189',
'1.20.512.17194',
'1.20.512.17197',
'1.20.512.17198',
'1.20.512.17199',
'1.20.512.17200',
'1.20.512.17202',
'1.20.512.17203',
'1.20.512.17204',
'1.20.512.17207',
'1.20.512.17213',
'1.20.512.17217',
'1.20.512.17218',
'1.20.512.17228',
'1.20.512.17229',
'1.20.512.17233',
'1.20.512.17260',
'1.20.512.17261',
'1.20.512.17263',
'1.20.512.17265',
'1.20.512.17267',
'1.20.512.17268',
'1.20.512.17273',
'1.20.512.17274',
'1.20.512.17279',
'1.20.512.17283',
'1.20.512.17289',
'1.20.512.17294',
'1.20.512.17297',
'1.20.512.17301',
'1.20.512.17304',
'1.20.512.17305',
'1.20.512.17314',
'1.20.512.17325',
'1.20.512.17328',
'1.20.512.17329',
'1.20.512.17330',
'1.20.512.18005',
'1.20.512.18034',
'1.20.512.18039',
'1.20.512.18043',
'1.20.512.18060',
'1.20.512.19379'])
						->where('sts', 1)
						->get();

		return view('pages.bpadprofil.pegawai')
				->with('id_emp', Auth::user()->id_emp)
				->with('emp_data', $emp_data)
				->with('emp_dik', $emp_dik)
				->with('emp_gol', $emp_gol)
				->with('emp_jab', $emp_jab)
				->with('access', $access);	
	}
}
