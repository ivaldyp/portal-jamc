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
use App\V_disposisi;

session_start();

class KepegawaianController extends Controller
{
	use SessionCheckTraits;

	public function __construct()
	{
		$this->middleware('auth');
		set_time_limit(300);
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

		if ($access['zfor'] == '2,') {
			$employees = Emp_data::
						where('sts', 1)
						->where('ked_emp', $kednow)
						->where('idgroup', $_SESSION['user_data']['idgroup'])
						->orderBy('nm_emp', 'asc')
						->get();
		} else {
			$employees = Emp_data::
						where('sts', 1)
						->where('ked_emp', $kednow)
						->orderBy('nm_emp', 'asc')
						->get();
		}
		
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
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 13);

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

		$kedudukans = Glo_org_kedemp::get();

		$units = Glo_org_unitkerja::get();

		return view('pages.bpadkepegawaian.pegawaitambah')
				->with('id_emp', $id_emp)
				->with('statuses', $statuses)
				->with('idgroups', $idgroups)
				->with('pendidikans', $pendidikans)
				->with('golongans', $golongans)
				->with('jabatans', $jabatans)
				->with('lokasis', $lokasis)
				->with('kedudukans', $kedudukans)
				->with('units', $units);
	}

	public function pegawaiubah(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 13);

		$id_emp = $request->id_emp;

		$emp_data = Emp_data::
						where('id_emp', $id_emp)
						->first();

		$emp_dik = Emp_dik::
						where('noid', $id_emp)
						->first();

		$emp_gol = Emp_gol::
						where('noid', $id_emp)
						->first();

		$emp_jab = Emp_jab::
						where('noid', $id_emp)
						->first();

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

		$kedudukans = Glo_org_kedemp::get();

		$units = Glo_org_unitkerja::get();

		return view('pages.bpadkepegawaian.pegawaiubah')
				->with('id_emp', $id_emp)
				->with('emp_data', $emp_data)
				->with('emp_dik', $emp_dik)
				->with('emp_gol', $emp_gol)
				->with('emp_jab', $emp_jab)
				->with('statuses', $statuses)
				->with('idgroups', $idgroups)
				->with('pendidikans', $pendidikans)
				->with('golongans', $golongans)
				->with('jabatans', $jabatans)
				->with('lokasis', $lokasis)
				->with('kedudukans', $kedudukans)
				->with('units', $units);
	}

	public function forminsertpegawai(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 13);

		$id_emp = explode(".", Emp_data::max('id_emp'));
		$new_id_emp = $id_emp[0] . "." . $id_emp[1] . "." . $id_emp[2] . "." . ($id_emp[3] + 1);

		$filefoto = '';
		$filettd = '';
		$fileijazah = '';
		$fileskgol = '';
		$fileskjab = '';

		// (IDENTITAS) cek dan set variabel untuk file foto pegawai
		if (isset($request->filefoto)) {
			$file = $request->filefoto;

			if ($file->getSize() > 2222222) {
				return redirect('/kepegawaian/tambah pegawai')->with('message', 'Ukuran file foto pegawai terlalu besar (Maksimal 2MB)');     
			} 

			$filefoto .= $new_id_emp . ".". $file->getClientOriginalExtension();

			$tujuan_upload = config('app.savefileimgemp');
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

			$tujuan_upload = config('app.savefileimgttd');
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

			$tujuan_upload = config('app.savefileimgdik');
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

			$tujuan_upload = config('app.savefileimggol');
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

			$tujuan_upload = config('app.savefileimgjab');
			$file->move($tujuan_upload, $fileskjab);
		}
			
		if (!(isset($fileskjab))) {
			$fileskjab = null;
		}
	
		// mulai insert

		$insert_emp_data = [
				// IDENTITAS
				'sts' => 1,
				'createdate' => date('Y-m-d H:i:s'),
				'id_emp' => $new_id_emp,
				'tgl_join' => (isset($request->tgl_join) ? date('Y-m-d',strtotime($request->tgl_join)) : null),
				'status_emp' => $request->status_emp,
				'ked_emp' => $request->ked_emp,
				'nip_emp' => $request->nip_emp,
				'nrk_emp' => $request->nrk_emp,
				'nm_emp' => $request->nm_emp,
				'gelar_dpn' => $request->gelar_dpn,
				'gelar_blk' => $request->gelar_blk,
				'jnkel_emp' => $request->jnkel_emp,
				'tempat_lahir' => $request->tempat_lahir,
				'tgl_lahir' => (isset($request->tgl_lahir) ? date('Y-m-d',strtotime($request->tgl_lahir)) : null),
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
				'npwp' => $request->npwp,
				'no_jamsos' => $request->no_jamsos,
				'idgroup' => $request->idgroup,
				'foto' => $filefoto,
				'ttd' => $filettd,
				'passmd5' => md5($request->passmd5),
				'tampilnew' => 1,
			];

		$insert_emp_dik = [
				// PENDIDIKAN
				'sts' => 1,
				'tgl' => date('Y-m-d H:i:s'),
				'noid' => $new_id_emp,
				'iddik' => $request->iddik,
				'prog_sek' => $request->prog_sek,
				'nm_sek' => $request->nm_sek,
				'no_sek' => $request->no_sek,
				'th_sek' => $request->th_sek,
				'gelar_dpn_sek' => $request->gelar_dpn_sek,
				'gelar_blk_sek' => $request->gelar_blk_sek,
				'ijz_cpns' => $request->ijz_cpns,
				'gambar' => $fileijazah,
				'tampilnew' => 1,
			];

		$insert_emp_gol = [
				// GOLONGAN
				'sts' => 1,
				'tgl' => date('Y-m-d H:i:s'),
				'noid' => $new_id_emp,
				'tmt_gol' => (isset($request->tmt_gol) ? date('Y-m-d',strtotime($request->tmt_gol)) : null),
				'no_sk_gol' => $request->no_sk_gol,
				'tmt_sk_gol' => (isset($request->tmt_sk_gol) ? date('Y-m-d',strtotime($request->tmt_sk_gol)) : null),
				'idgol' => $request->idgol,
				'jns_kp' => $request->jns_kp,
				'mk_thn' => $request->mk_thn,
				'mk_bln' => $request->mk_bln,
				'gambar' => $fileskgol,
				'tampilnew' => 1,
			];

		$jabatan = explode("||", $request->jabatan);
		$jns_jab = $jabatan[0];
		$idjab = $jabatan[1];
		$insert_emp_jab = [
				// JABATAN
				'sts' => 1,
				'tgl' => date('Y-m-d H:i:s'),
				'noid' => $new_id_emp,
				'idskpd' => '1.20.512',
				'jns_jab' => $jns_jab,
				'idjab' => $idjab,
				'idunit' => $request->idunit,
				'idlok' => $request->idlok,
				'eselon' => $request->eselon,
				'tmt_jab' => (isset($request->tmt_jab) ? date('Y-m-d',strtotime($request->tmt_jab)) : null),
				'no_sk_jab' => $request->no_sk_jab,
				'tmt_sk_jab' => (isset($request->tmt_sk_jab) ? date('Y-m-d',strtotime($request->tmt_sk_jab)) : null),
				'gambar' => $fileskjab,
				'tampilnew' => 1,
			];

		Emp_data::insert($insert_emp_data);
		Emp_dik::insert($insert_emp_dik);
		Emp_gol::insert($insert_emp_gol);
		Emp_jab::insert($insert_emp_jab);

		return redirect('/kepegawaian/data pegawai')
					->with('message', 'Pegawai '.$request->nm_emp.' berhasil ditambah')
					->with('msg_num', 1);
	}

	public function formupdatepegawai(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 13);

		$id_emp = $request->id_emp;
		
		$filefoto = '';
		$filettd = '';
		$fileijazah = '';
		$fileskgol = '';
		$fileskjab = '';

		// (IDENTITAS) cek dan set variabel untuk file foto pegawai
		if (isset($request->filefoto)) {
			$file = $request->filefoto;

			if ($file->getSize() > 2222222) {
				return redirect('/kepegawaian/data pegawai')->with('message', 'Ukuran file foto pegawai terlalu besar (Maksimal 2MB)');     
			} 

			$filefoto .= $new_id_emp . ".". $file->getClientOriginalExtension();

			$tujuan_upload = config('app.savefileimgemp');
			$file->move($tujuan_upload, $filefoto);
		}
			
		if (!(isset($filefoto))) {
			$filefoto = null;
		}

		// (IDENTITAS) cek dan set variabel untuk file foto ttd pegawai
		if (isset($request->filettd)) {
			$file = $request->filettd;

			if ($file->getSize() > 2222222) {
				return redirect('/kepegawaian/data pegawai')->with('message', 'Ukuran file foto tandatangan terlalu besar (Maksimal 2MB)');     
			} 

			$filettd .= $new_id_emp . ".". $file->getClientOriginalExtension();

			$tujuan_upload = config('app.savefileimgttd');
			$file->move($tujuan_upload, $filettd);
		}
			
		if (!(isset($filettd))) {
			$filettd = null;
		}

		// (PENDIDIKAN) cek dan set variabel untuk file foto ijazah
		if (isset($request->fileijazah)) {
			$file = $request->fileijazah;

			if ($file->getSize() > 2222222) {
				return redirect('/kepegawaian/data pegawai')->with('message', 'Ukuran file foto ijazah terlalu besar (Maksimal 2MB)');     
			} 

			$fileijazah .= $new_id_emp . ".". $file->getClientOriginalExtension();

			$tujuan_upload = config('app.savefileimgdik');
			$file->move($tujuan_upload, $fileijazah);
		}
			
		if (!(isset($fileijazah))) {
			$fileijazah = null;
		}

		// (GOLONGAN) cek dan set variabel untuk file SK Golongan
		if (isset($request->fileskgol)) {
			$file = $request->fileskgol;

			if ($file->getSize() > 2222222) {
				return redirect('/kepegawaian/data pegawai')->with('message', 'Ukuran file foto SK golongan terlalu besar (Maksimal 2MB)');     
			} 

			$fileskgol .= $new_id_emp . ".". $file->getClientOriginalExtension();

			$tujuan_upload = config('app.savefileimggol');
			$file->move($tujuan_upload, $fileskgol);
		}
			
		if (!(isset($fileskgol))) {
			$fileskgol = null;
		}

		// (JABATAN) cek dan set variabel untuk file SK Jabatan
		if (isset($request->fileskjab)) {
			$file = $request->fileskjab;

			if ($file->getSize() > 2222222) {
				return redirect('/kepegawaian/data pegawai')->with('message', 'Ukuran file foto SK jabatan terlalu besar (Maksimal 2MB)');    
			} 

			$fileskjab .= $new_id_emp . ".". $file->getClientOriginalExtension();

			$tujuan_upload = config('app.savefileimgjab');
			$file->move($tujuan_upload, $fileskjab);
		}
			
		if (!(isset($fileskjab))) {
			$fileskjab = null;
		}


		// ubah semua variabel tanggal jadi format 'Ymd'
		if (isset($request->tgl_join)) {
			$tgl_join = date('Y-m-d',strtotime($request->tgl_join));
		} else {
			$tgl_join = null;
		}

		if (isset($request->tgl_lahir)) {
			$tgl_lahir = date('Y-m-d',strtotime($request->tgl_lahir));
		} else {
			$tgl_lahir = null;
		}

		if (isset($request->tmt_gol)) {
			$tmt_gol = date('Y-m-d',strtotime($request->tmt_gol));
		} else {
			$tmt_gol = null;
		}

		if (isset($request->tmt_sk_gol)) {
			$tmt_sk_gol = date('Y-m-d',strtotime($request->tmt_sk_gol));
		} else {
			$tmt_sk_gol = null;
		}

		if (isset($request->tmt_jab)) {
			$tmt_jab = date('Y-m-d',strtotime($request->tmt_jab));
		} else {
			$tmt_jab = null;
		}

		if (isset($request->tmt_sk_jab)) {
			$tmt_sk_jab = date('Y-m-d',strtotime($request->tmt_sk_jab));
		} else {
			$tmt_sk_jab = null;
		}
	
		// mulai insert
		$jabatan = explode("||", $request->jabatan);
		$jns_jab = $jabatan[0];
		$idjab = $jabatan[1];

		Emp_data::where('id_emp', $id_emp)
			->update([
				'sts' => 1,
				'createdate' => date('Y-m-d H:i:s'),
				'tgl_join' => (isset($request->tgl_join) ? date('Y-m-d',strtotime($request->tgl_join)) : null),
				'status_emp' => $request->status_emp,
				'ked_emp' => $request->ked_emp,
				'nip_emp' => $request->nip_emp,
				'nrk_emp' => $request->nrk_emp,
				'nm_emp' => $request->nm_emp,
				'gelar_dpn' => $request->gelar_dpn,
				'gelar_blk' => $request->gelar_blk,
				'jnkel_emp' => $request->jnkel_emp,
				'tempat_lahir' => $request->tempat_lahir,
				'tgl_lahir' => (isset($request->tgl_lahir) ? date('Y-m-d',strtotime($request->tgl_lahir)) : null),
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
				'npwp' => $request->npwp,
				'no_jamsos' => $request->no_jamsos,
				'idgroup' => $request->idgroup,
			]);

		Emp_dik::where('noid', $id_emp)
			->update([
				'sts' => 1,
				'tgl' => date('Y-m-d H:i:s'),
				'iddik' => $request->iddik,
				'prog_sek' => $request->prog_sek,
				'nm_sek' => $request->nm_sek,
				'no_sek' => $request->no_sek,
				'th_sek' => $request->th_sek,
				'gelar_dpn_sek' => $request->gelar_dpn_sek,
				'gelar_blk_sek' => $request->gelar_blk_sek,
				'ijz_cpns' => $request->ijz_cpns,
				'gambar' => $fileijazah,
			]);

		Emp_gol::where('noid', $id_emp)
			->update([
				'sts' => 1,
				'tgl' => date('Y-m-d H:i:s'),
				'tmt_gol' => (isset($request->tmt_gol) ? date('Y-m-d',strtotime($request->tmt_gol)) : null),
				'no_sk_gol' => $request->no_sk_gol,
				'tmt_sk_gol' => (isset($request->tmt_sk_gol) ? date('Y-m-d',strtotime($request->tmt_sk_gol)) : null),
				'idgol' => $request->idgol,
				'jns_kp' => $request->jns_kp,
				'mk_thn' => $request->mk_thn,
				'mk_bln' => $request->mk_bln,
				'gambar' => $fileskgol,
			]);

		Emp_jab::where('noid', $id_emp)
			->update([
				// JABATAN
				'sts' => 1,
				'tgl' => date('Y-m-d H:i:s'),
				'idskpd' => '1.20.512',
				'jns_jab' => $jns_jab,
				'idjab' => $idjab,
				'idunit' => $request->idunit,
				'idlok' => $request->idlok,
				'eselon' => $request->eselon,
				'tmt_jab' => (isset($request->tmt_jab) ? date('Y-m-d',strtotime($request->tmt_jab)) : null),
				'no_sk_jab' => $request->no_sk_jab,
				'tmt_sk_jab' => (isset($request->tmt_sk_jab) ? date('Y-m-d',strtotime($request->tmt_sk_jab)) : null),
				'gambar' => $fileskjab,
			]);

		if ($filefoto != '') {
			Emp_data::where('id_emp', $id_emp)
			->update([
				'foto' => $filefoto,
			]);
		}

		if ($filettd != '') {
			Emp_data::where('id_emp', $id_emp)
			->update([
				'ttd' => $filettd,
			]);
		}

		if ($fileijazah != '') {
			Emp_dik::where('noid', $id_emp)
			->update([
				'gambar' => $fileijazah,
			]);
		}

		if ($fileskgol != '') {
			Emp_gol::where('noid', $id_emp)
			->update([
				'gambar' => $fileskgol,
			]);
		}

		if ($fileskjab != '') {
			Emp_jab::where('noid', $id_emp)
			->update([
				'gambar' => $fileskjab,
			]);
		}

		return redirect('/kepegawaian/data pegawai')
					->with('message', 'Pegawai '.$request->nm_emp.' berhasil diubah')
					->with('msg_num', 1);
	}

	public function formdeletepegawai(Request $request)
	{
		$this->checkSessionTime();

		Emp_data::where('id_emp', $request->id_emp)
					->update([
						'sts' => 0,
					]);

		Emp_dik::where('noid', $request->id_emp)
					->update([
						'sts' => 0,
					]);

		Emp_gol::where('noid', $request->id_emp)
					->update([
						'sts' => 0,
					]);

		Emp_jab::where('noid', $request->id_emp)
					->update([
						'sts' => 0,
					]);
					
		return redirect('/kepegawaian/data pegawai')
					->with('message', 'Pegawai '.$request->nm_emp.' berhasil dihapus')
					->with('msg_num', 1);
	}

	// ------------------ DATA PEGAWAI ------------------ //

	// ---------------- STATUS DISPOSISI ---------------- //

	public function statusdisposisi()
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 373);

		$ids = Auth::user()->id_emp;

		$data_self = DB::select( DB::raw("  
							SELECT top 1 id_emp, nrk_emp, nip_emp, nm_emp, tbjab.idjab, tbjab.idunit, tbunit.child from emp_data as a
							CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
							CROSS APPLY (SELECT TOP 1 * FROM glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
							,glo_skpd as b,glo_org_unitkerja as c,glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1' 
							and id_emp like '$ids'") )[0];
		$data_self = json_decode(json_encode($data_self), true);

		if (strlen($data_self['idunit']) == 10) {
			// kalo dia staf
			$result = '';

			$result .= '<tr>
							<td>'.(is_null($data_self['nrk_emp']) || $data_self['nrk_emp'] == '' ? '-' : $data_self['nrk_emp'] ).'</td>
							<td>'.ucwords(strtolower($data_self['nm_emp'])).'</td>
							<td>'.ucwords(strtolower($data_self['idjab'])).'</td>
						';

			$belum = json_decode(json_encode(DB::select( DB::raw("
						SELECT Count(id_emp) as belum
						FROM v_disposisi
						where id_emp like '".$ids."'
						and rd = 'N'
					"))[0]), true);

			$baca = json_decode(json_encode(DB::select( DB::raw("
						SELECT Count(id_emp) as baca
						FROM v_disposisi
						where id_emp like '".$ids."'
						and rd = 'Y'
					"))[0]), true);

			$balas = json_decode(json_encode(DB::select( DB::raw("
						SELECT Count(id_emp) as balas
						FROM v_disposisi
						where id_emp like '".$ids."'
						and rd = 'S'
					"))[0]), true);

			$total = $belum['belum'] + $baca['baca'] + $balas['balas'];
			
			$result .= '	<td '. ($belum['belum'] > 0 ? 'class="text-danger"' : '') .'>'.$belum['belum'].'</td>
								<td>'.$baca['baca'].'</td>
								<td>'.$balas['balas'].'</td>
								<td><b>'.$total.'</b></td>
							</tr>';

		} else {
			// kalo dia atasan
			$result = '<tr>
							<td>'.(is_null($data_self['nrk_emp']) || $data_self['nrk_emp'] == '' ? '-' : $data_self['nrk_emp'] ).'</td>
							<td>'.ucwords(strtolower($data_self['nm_emp'])).'</td>
							<td>'.ucwords(strtolower($data_self['idjab'])).'</td>
						';

			$belum = json_decode(json_encode(DB::select( DB::raw("
						SELECT Count(id_emp) as belum
						FROM v_disposisi
						where id_emp like '".$ids."'
						and rd = 'N'
					"))[0]), true);

			$baca = json_decode(json_encode(DB::select( DB::raw("
						SELECT Count(id_emp) as baca
						FROM v_disposisi
						where id_emp like '".$ids."'
						and rd = 'Y'
					"))[0]), true);

			$balas = json_decode(json_encode(DB::select( DB::raw("
						SELECT Count(id_emp) as balas
						FROM v_disposisi
						where id_emp like '".$ids."'
						and rd = 'S'
					"))[0]), true);

			$total = $belum['belum'] + $baca['baca'] + $balas['balas'];

			$result .= '	<td '. ($belum['belum'] > 0 ? 'class="text-danger"' : '') .'>'.$belum['belum'].'</td>
								<td>'.$baca['baca'].'</td>
								<td>'.$balas['balas'].'</td>
								<td><b>'.$total.'</b></td>
							</tr>';

			$idunit = $data_self['idunit'];
			$querys = DB::select( DB::raw("  
						SELECT id_emp, nrk_emp, nip_emp, nm_emp, tbjab.idjab, tbjab.idunit, tbunit.child from emp_data as a
						CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
						CROSS APPLY (SELECT TOP 1 * FROM glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
						,glo_skpd as b,glo_org_unitkerja as c,glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1' 
						and tbunit.sao like '$idunit%' and ked_emp = 'aktif'") );
			$querys = json_decode(json_encode($querys), true);

			foreach ($querys as $key => $query) {
				$result .= '<tr>
								<td>'.(is_null($query['nrk_emp']) || $query['nrk_emp'] == '' ? '-' : $query['nrk_emp'] ).'</td>
								<td>'.ucwords(strtolower($query['nm_emp'])).'</td>
								<td>'.ucwords(strtolower($query['idjab'])).'</td>
							';

				$belum = json_decode(json_encode(DB::select( DB::raw("
							SELECT Count(id_emp) as belum
							FROM v_disposisi
							where id_emp like '".$query['id_emp']."'
							and rd = 'N'
						"))[0]), true);

				$baca = json_decode(json_encode(DB::select( DB::raw("
							SELECT Count(id_emp) as baca
							FROM v_disposisi
							where id_emp like '".$query['id_emp']."'
							and rd = 'Y'
						"))[0]), true);

				$balas = json_decode(json_encode(DB::select( DB::raw("
							SELECT Count(id_emp) as balas
							FROM v_disposisi
							where id_emp like '".$query['id_emp']."'
							and rd = 'S'
						"))[0]), true);

				$total = $belum['belum'] + $baca['baca'] + $balas['balas'];
				
				$result .= '	<td '. ($belum['belum'] > 0 ? 'class="text-danger"' : '') .'>'.$belum['belum'].'</td>
								<td>'.$baca['baca'].'</td>
								<td>'.$balas['balas'].'</td>
								<td><b>'.$total.'</b></td>
							</tr>';
			}
		}

		return view('pages.bpadkepegawaian.statusdisposisi')
				->with('access', $access)
				->with('result', $result);

	}

	// ---------------- STATUS DISPOSISI ---------------- //
}