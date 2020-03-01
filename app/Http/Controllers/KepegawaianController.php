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
		$id_emp = explode(".", Emp_data::max('id_emp'));
		$new_id_emp = $id_emp[0] + $id_emp[1] + $id_emp[2] + ($id_emp[3] + 1);

		// (IDENTITAS) cek dan set variabel untuk file foto pegawai
		if (isset($request->filefoto)) {
			$file = $request->filefoto;

			if ($file->getSize() > 2222222) {
				return redirect('/kepegawaian/tambah pegawai')->with('message', 'Ukuran file foto pegawai terlalu besar (Maksimal 2MB)');     
			} 

			$filefoto .= $new_id_emp . ".". $file->getClientOriginalExtension();

			$tujuan_upload = config('app.savefiledocs');
			$file->move($tujuan_upload, $filefoto);
		}
			
		if (!(isset($filefoto))) {
			$filefoto = null;
		}

		// (IDENTITAS) cek dan set variabel untuk file foto ttd pegawai
		if (isset($request->filettd)) {
			$file = $request->filettd;

			if ($file->getSize() > 2222222) {
				return redirect('/kepegawaian/tambah pegawai')->with('message', 'Ukuran file foto tandatangan terlalu besar (Maksimal 2MB)');     
			} 

			$filettd .= $new_id_emp . ".". $file->getClientOriginalExtension();

			$tujuan_upload = config('app.savefiledocs');
			$file->move($tujuan_upload, $filettd);
		}
			
		if (!(isset($filettd))) {
			$filettd = null;
		}

		// (PENDIDIKAN) cek dan set variabel untuk file foto ijazah
		if (isset($request->fileijazah)) {
			$file = $request->fileijazah;

			if ($file->getSize() > 2222222) {
				return redirect('/kepegawaian/tambah pegawai')->with('message', 'Ukuran file foto ijazah terlalu besar (Maksimal 2MB)');     
			} 

			$fileijazah .= $new_id_emp . ".". $file->getClientOriginalExtension();

			$tujuan_upload = config('app.savefiledocs');
			$file->move($tujuan_upload, $fileijazah);
		}
			
		if (!(isset($fileijazah))) {
			$fileijazah = null;
		}

		// (GOLONGAN) cek dan set variabel untuk file SK Golongan
		if (isset($request->fileskgol)) {
			$file = $request->fileskgol;

			if ($file->getSize() > 2222222) {
				return redirect('/kepegawaian/tambah pegawai')->with('message', 'Ukuran file foto SK golongan terlalu besar (Maksimal 2MB)');     
			} 

			$fileskgol .= $new_id_emp . ".". $file->getClientOriginalExtension();

			$tujuan_upload = config('app.savefiledocs');
			$file->move($tujuan_upload, $fileskgol);
		}
			
		if (!(isset($fileskgol))) {
			$fileskgol = null;
		}

		// (JABATAN) cek dan set variabel untuk file SK Jabatan
		if (isset($request->fileskjab)) {
			$file = $request->fileskjab;

			if ($file->getSize() > 2222222) {
				return redirect('/kepegawaian/tambah pegawai')->with('message', 'Ukuran file foto SK jabatan terlalu besar (Maksimal 2MB)');    
			} 

			$fileskjab .= $new_id_emp . ".". $file->getClientOriginalExtension();

			$tujuan_upload = config('app.savefiledocs');
			$file->move($tujuan_upload, $fileskjab);
		}
			
		if (!(isset($fileskjab))) {
			$fileskjab = null;
		}

		// ubah semua variabel tanggal jadi format 'Ymd'
		if (isset($request->tgl_join)) {
			$tgl_join = DateTime::createFromFormat('d/m/Y',$request->tgl_join);
		} else {
			$tgl_join = null
		}

		if (isset($request->tgl_lahir)) {
			$tgl_lahir = DateTime::createFromFormat('d/m/Y',$request->tgl_lahir);
		} else {
			$tgl_lahir = null
		}

		if (isset($request->tmt_gol)) {
			$tmt_gol = DateTime::createFromFormat('d/m/Y',$request->tmt_gol);
		} else {
			$tmt_gol = null
		}

		if (isset($request->tmt_sk_gol)) {
			$tmt_sk_gol = DateTime::createFromFormat('d/m/Y',$request->tmt_sk_gol);
		} else {
			$tmt_sk_gol = null
		}

		if (isset($request->tmt_jab)) {
			$tmt_jab = DateTime::createFromFormat('d/m/Y',$request->tmt_jab);
		} else {
			$tmt_jab = null
		}

		if (isset($request->tmt_sk_jab)) {
			$tmt_sk_jab = DateTime::createFromFormat('d/m/Y',$request->tmt_sk_jab);
		} else {
			$tmt_sk_jab = null
		}
	
		// mulai insert
		$jabatan = explode("||", $request->jabatan);
		$insert_emp_data = [
				// IDENTITAS
				'id_emp' => $new_id_emp,
				'tgl_join' => $tgl_join->format("Y-m-d"),
				'status_emp' => $request->status_emp,
				'nip_emp' => $request->nip_emp,
				'nrk_emp' => $request->nrk_emp,
				'nama_emp' => $request->nama_emp,
				'gelar_dpn' => $request->gelar_dpn,
				'gelar_blk' => $request->gelar_blk,
				'jnkel_emp' => $request->jnkel_emp,
				'tempat_lahir' => $request->tempat_lahir,
				'tgl_lahir' => $tgl_lahir->format("Y-m-d"),
				'idagama' => $request->idagama,
				'alamat_emp' => $request->alamat_emp,
				'tlp_emp' => $request->tlp_emp,
				'email_emp' => $request->email_emp,
				'status_nikah' => $request->status_nikah,
				'gol_darah' => $request->gol_darah,
				'nm_bank' => $request->nm_bank,
				'cb_bank' => $request->cb_bank,
				'an_bank' => $request->an_bank,
				'nr_bank' => $request->nr_bank,
				'no_taspen' => $request->no_taspen,
				'no_askes' => $request->no_askes,
				'no_jamsos' => $request->no_jamsos,
				'idgroup' => $request->idgroup,
				'filefoto' => $filefoto,
				'filettd' => $filettd,
			];

		$insert_emp_dik = [
				// PENDIDIKAN
				'iddik' => $request->iddik,
				'prog_sek' => $request->prog_sek,
				'nm_sek' => $request->nm_sek,
				'no_sek' => $request->no_sek,
				'th_sek' => $request->th_sek,
				'gelar_dpn_sek' => $request->gelar_dpn_sek,
				'gelar_blk_sek' => $request->gelar_blk_sek,
				'ijz_cpns' => $request->ijz_cpns,
				'fileijazah' => $fileijazah,
			];

		$insert_emp_gol = [
				// GOLONGAN
				'tmt_gol' => $tmt_gol->format("Y-m-d"),
				'no_sk_gol' => $request->no_sk_gol,
				'tmt_sk_gol' => $tmt_sk_gol->format("Y-m-d"),
				'idgol' => $request->idgol,
				'jns_kp' => $request->jns_kp,
				'mk_thn' => $request->mk_thn,
				'mk_bln' => $request->mk_bln,
				'fileskgol' => $fileskgol,
			];

		$insert_emp_jab = [
				// JABATAN
				'jabatan' => $request->jabatan,
				'idunit' => $request->idunit,
				'idlok' => $request->idlok,
				'eselon' => $request->eselon,
				'tmt_jab' => $tmt_jab->format("Y-m-d"),
				'no_sk_jab' => $request->no_sk_jab,
				'tmt_sk_jab' => $tmt_sk_jab->format("Y-m-d"),
				'fileskjab' => $fileskjab,
			];

		Emp_data::insert($insert_emp_data);
		Emp_dik::insert($insert_emp_dik);
		Emp_gol::insert($insert_emp_gol);
		Emp_jab::insert($insert_emp_jab);

		return redirect('/kepegawaian/data pegawai')
					->with('message', 'Pegawai '.$request->nm_emp.' berhasil ditambah')
					->with('msg_num', 1);

	}

	public function formdeletepegawai(Request $request)
	{
		$this->checkSessionTime();

		Emp_data::where('id_emp', $request->id_emp)
					->update([
						'sts' => 0,
					]);

		Emp_dik::where('id_emp', $request->id_emp)
					->update([
						'sts' => 0,
					]);

		Emp_gol::where('id_emp', $request->id_emp)
					->update([
						'sts' => 0,
					]);

		Emp_jab::where('id_emp', $request->id_emp)
					->update([
						'sts' => 0,
					]);
					
		return redirect('/kepegawaian/data pegawai')
					->with('message', 'Pegawai '.$request->nm_emp.' berhasil dihapus')
					->with('msg_num', 1);
	}
}