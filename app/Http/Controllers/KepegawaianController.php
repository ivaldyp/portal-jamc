<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;

use App\Emp_data;
use App\Glo_dik;
use App\Glo_org_golongan;
use App\Glo_org_jabatan;
use App\Glo_org_kedemp;
use App\Glo_org_lokasi;
use App\Glo_org_statusemp;
use App\Glo_org_unitkerja;
use App\Sec_access;

session_start();

class KepegawaianController extends Controller
{
	use SessionCheckTraits;

	public function __construct()
	{
		$this->middleware('auth');
	}

	// ------------------ DATA PEGAWAI ------------------ //

	public function pegawaiall(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 13);

		if (!(isset($request->kednow))) {
			$kednow = 'AKTIF';
		} else {
			$kednow = $request->kednow;
		}

		$employees = Emp_data::
						where('sts', 1)
						->where('ked_emp', $kednow)
						->orderBy('nm_emp', 'asc')
						->get();

		$kedudukans = Glo_org_kedemp::get();

		return view('pages.bpadkepegawaian.pegawai')
				->with('access', $access)
				->with('kednow', $kednow)
				->with('employees', $employees)
				->with('kedudukans', $kedudukans);
		
	}

	public function pegawaitambah()
	{
		$this->checkSessionTime();

		$id_emp = explode(".", Emp_data::max('id_emp'));

		$statuses = Glo_org_statusemp::get();

		$idgroups = Sec_access::
					distinct('idgroup')
					->where('zfor', '2,')
					->get('idgroup');

		$pendidikans = Glo_dik::
						orderBy('urut')
						->get();

		$jabatans = Glo_org_jabatan::
					orderBy('jabatan')
					->get();


		return view('pages.bpadkepegawaian.pegawaitambah')
				->with('id_emp', $id_emp)
				->with('statuses', $statuses)
				->with('idgroups', $idgroups)
				->with('pendidikans', $pendidikans)
				->with('jabatans', $jabatans);
		
	}

}
