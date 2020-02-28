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
					->orderBy('idgroup')
					->get('idgroup');

		$pendidikans = Glo_dik::
						orderBy('urut')
						->get();

		$golongans = Glo_org_golongan::
					orderBy('gol')
					->get();

		$jabatans = Glo_org_jabatan::
					orderBy('jabatan')
					->get();

		$lokasis = Glo_org_lokasi::
					orderBy('kd_lok')
					->get();

		$units = Glo_org_unitkerja::get();

		return view('pages.bpadkepegawaian.pegawaitambah')
				->with('id_emp', $id_emp)
				->with('statuses', $statuses)
				->with('idgroups', $idgroups)
				->with('pendidikans', $pendidikans)
				->with('golongans', $golongans)
				->with('jabatans', $jabatans)
				->with('lokasis', $lokasis)
				->with('units', $units);
	}

	public function forminsertpegawai(Request $request)
	{
		if (isset($request->filefoto)) {
            $file = $request->filefoto;

            if ($file->getSize() > 2222222) {
                return redirect('/kepegawaian/tambah pegawai')->with('message', 'Ukuran file foto terlalu besar (Maksimal 2MB)');     
            } 

            $file_name = uniqid(md5(time()))."~".date('dmY')."~".$file->getClientOriginalName();

            $tujuan_upload = config('app.savefiledocs');
            $file->move($tujuan_upload, $file_name);
        }
            
        if (!(isset($file_name))) {
            $file_name = null;
        }
	}
}
