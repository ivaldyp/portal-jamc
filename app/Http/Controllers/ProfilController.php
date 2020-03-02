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
						->first();

		$emp_dik = Emp_dik::
						where('noid', Auth::user()->id_emp)
						->get();

		$emp_gol = Emp_gol::
						where('noid', Auth::user()->id_emp)
						->get();

		$emp_jab = Emp_jab::
						where('noid', Auth::user()->id_emp)
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
