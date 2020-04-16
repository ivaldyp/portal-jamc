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
use App\Fr_suratkeluar;
use App\Fr_disposisi;
use App\Glo_dik;
use App\Glo_disposisi_kode;
use App\Glo_org_golongan;
use App\Glo_org_jabatan;
use App\Glo_org_kedemp;
use App\Glo_org_lokasi;
use App\Glo_org_statusemp;
use App\Glo_org_unitkerja;
use App\Kinerja_data;
use App\Kinerja_detail;
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

	// --------------- STRUKTUR ORGANISASI --------------- //

	public function strukturorganisasi()
	{
		$this->checkSessionTime();

		return view('pages.bpadkepegawaian.struktur');
	}

	// --------------- STRUKTUR ORGANISASI --------------- //

	// ---------------- STATUS DISPOSISI ---------------- //

	public function statusdisposisi()
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 373);

		$ids = Auth::user()->id_emp;

		$data_self = DB::select( DB::raw("  
							SELECT top 1 id_emp, nrk_emp, nip_emp, nm_emp, tbjab.idjab, tbjab.idunit, tbunit.child from bpaddtfake.dbo.emp_data as a
							CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM bpaddtfake.dbo.emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
							CROSS APPLY (SELECT TOP 1 * FROM bpaddtfake.dbo.glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
							,bpaddtfake.dbo.glo_skpd as b,bpaddtfake.dbo.glo_org_unitkerja as c,bpaddtfake.dbo.glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1' 
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
						FROM bpaddtfake.dbo.v_disposisi
						where id_emp like '".$ids."'
						and rd = 'N'
					"))[0]), true);

			$baca = json_decode(json_encode(DB::select( DB::raw("
						SELECT Count(id_emp) as baca
						FROM bpaddtfake.dbo.v_disposisi
						where id_emp like '".$ids."'
						and rd = 'Y'
					"))[0]), true);

			$balas = json_decode(json_encode(DB::select( DB::raw("
						SELECT Count(id_emp) as balas
						FROM bpaddtfake.dbo.v_disposisi
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
						FROM bpaddtfake.dbo.v_disposisi
						where id_emp like '".$ids."'
						and rd = 'N'
					"))[0]), true);

			$baca = json_decode(json_encode(DB::select( DB::raw("
						SELECT Count(id_emp) as baca
						FROM bpaddtfake.dbo.v_disposisi
						where id_emp like '".$ids."'
						and rd = 'Y'
					"))[0]), true);

			$balas = json_decode(json_encode(DB::select( DB::raw("
						SELECT Count(id_emp) as balas
						FROM bpaddtfake.dbo.v_disposisi
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
						SELECT id_emp, nrk_emp, nip_emp, nm_emp, tbjab.idjab, tbjab.idunit, tbunit.child from bpaddtfake.dbo.emp_data as a
						CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM bpaddtfake.dbo.emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
						CROSS APPLY (SELECT TOP 1 * FROM bpaddtfake.dbo.glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
						,bpaddtfake.dbo.glo_skpd as b,bpaddtfake.dbo.glo_org_unitkerja as c,bpaddtfake.dbo.glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1' 
						and tbunit.sao like '$idunit%' and ked_emp = 'aktif'
						order by tbunit.kd_unit") );
			$querys = json_decode(json_encode($querys), true);

			foreach ($querys as $key => $query) {
				$result .= '<tr>
								<td>'.(is_null($query['nrk_emp']) || $query['nrk_emp'] == '' ? '-' : $query['nrk_emp'] ).'</td>
								<td>'.ucwords(strtolower($query['nm_emp'])).'</td>
								<td>'.ucwords(strtolower($query['idjab'])).'</td>
							';

				$belum = json_decode(json_encode(DB::select( DB::raw("
							SELECT Count(id_emp) as belum
							FROM bpaddtfake.dbo.v_disposisi
							where id_emp like '".$query['id_emp']."'
							and rd = 'N'
						"))[0]), true);

				$baca = json_decode(json_encode(DB::select( DB::raw("
							SELECT Count(id_emp) as baca
							FROM bpaddtfake.dbo.v_disposisi
							where id_emp like '".$query['id_emp']."'
							and rd = 'Y'
						"))[0]), true);

				$balas = json_decode(json_encode(DB::select( DB::raw("
							SELECT Count(id_emp) as balas
							FROM bpaddtfake.dbo.v_disposisi
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

	public function suratkeluar()
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 1375);

		$surats = Fr_suratkeluar::
					orderBy('tgl_input', 'desc')
					->get();

		return view('pages.bpadkepegawaian.suratkeluar')
				->with('access', $access)
				->with('surats', $surats);
	}

	public function suratkeluartambah()
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 1375);

		$disposisis = Fr_disposisi::
						limit(200)
						->whereNotNull('kode_disposisi')
						->Where('kode_disposisi', '<>', '')
						->orderBy('no_form', 'desc')
						->get();

		$dispkodes = Glo_disposisi_kode::orderBy('kd_jnssurat')->get();

		return view('pages.bpadkepegawaian.suratkeluartambah')
				->with('access', $access)
				->with('disposisis', $disposisis)
				->with('dispkodes', $dispkodes);
	}

	public function suratkeluarubah(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 1375);

		$surat = Fr_suratkeluar::
					where('ids', $request->ids)
					->first();

		$disposisis = Fr_disposisi::
						limit(200)
						->whereNotNull('kode_disposisi')
						->Where('kode_disposisi', '<>', '')
						->orderBy('no_form', 'desc')
						->get();

		$dispkodes = Glo_disposisi_kode::orderBy('kd_jnssurat')->get();

		return view('pages.bpadkepegawaian.suratkeluarubah')
				->with('access', $access)
				->with('surat', $surat)
				->with('disposisis', $disposisis)
				->with('dispkodes', $dispkodes);
	}

	public function forminsertsuratkeluar(Request $request)
	{
		$this->checkSessionTime();
		$accessid = $this->checkAccess($_SESSION['user_data']['idgroup'], 1375);

		$maxnoform = Fr_suratkeluar::max('no_form');
		if (is_null($maxnoform)) {
			$newnoform = '1.20.512.20200001';
		} else {
			$splitnoform = explode(".", $maxnoform); 
			$newnoform = $splitnoform[0] . "." . $splitnoform[1] . "." . $splitnoform[2] . "." . ($splitnoform[3]+1);
		}

		$filesuratkeluar = '';

		if (isset($request->nm_file)) {
			$file = $request->nm_file;

			if ($file->getSize() > 2222222) {
				return redirect('/kepegawaian/surat keluar tambah')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
			} 

			$filesuratkeluar .= $file->getClientOriginalName();

			$tujuan_upload = config('app.savefilesuratkeluar');
			$file->move($tujuan_upload, $filesuratkeluar);
		}
			
		if (!(isset($filesuratkeluar))) {
			$filesuratkeluar = null;
		}

		$insertsurat = [
			'sts' => 1,
			'tgl' => date('Y-m-d H:i:s'),
			'kd_skpd' => '1.20.512',
			'kd_unit' => '01',
			'no_form' => $newnoform,
			'tgl_terima' => date('Y-m-d',strtotime(str_replace('/', '-', $request->tgl_terima))),
			'usr_input' => (isset(Auth::user()->usname) ? Auth::user()->usname : Auth::user()->id_emp),
			'tgl_input' => date('Y-m-d H:i:s'),
			'kode_disposisi' => $request->kode_disposisi,
			'perihal' => $request->perihal,
			'tgl_surat' => $request->tgl_surat,
			'no_surat' => $request->no_surat,
			'asal_surat' => $request->asal_surat,
			'ket_lain' => $request->ket_lain,
			'kepada' => $request->kepada,
			'no_form_in' => $request->no_form_in,
			'nm_file' => $filesuratkeluar,
		];

		Fr_suratkeluar::insert($insertsurat);

		return redirect('/kepegawaian/surat keluar')
				->with('message', 'Surat Keluar berhasil dibuat')
				->with('msg_num', 1);
	}

	public function formupdatesuratkeluar(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 1375);

		$filesuratkeluar = '';

		if (isset($request->nm_file)) {
			$file = $request->nm_file;

			if ($file->getSize() > 2222222) {
				return redirect('/kepegawaian/surat keluar tambah')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
			} 

			$filesuratkeluar .= $file->getClientOriginalName();

			$tujuan_upload = config('app.savefilesuratkeluar');
			$file->move($tujuan_upload, $filesuratkeluar);
		}
			
		if (!(isset($filesuratkeluar))) {
			$filesuratkeluar = null;
		}

		Fr_suratkeluar::where('ids', $request->ids)
						->update([
							'sts' => 1,
							'tgl' => date('Y-m-d H:i:s'),
							'kd_skpd' => '1.20.512',
							'kd_unit' => '01',
							'tgl_terima' => date('Y-m-d',strtotime(str_replace('/', '-', $request->tgl_terima))),
							'kode_disposisi' => $request->kode_disposisi,
							'perihal' => $request->perihal,
							'tgl_surat' => $request->tgl_surat,
							'no_surat' => $request->no_surat,
							'asal_surat' => $request->asal_surat,
							'ket_lain' => $request->ket_lain,
							'kepada' => $request->kepada,
							'no_form_in' => $request->no_form_in,
						]);
		
		if ($filesuratkeluar != '') {
			Fr_suratkeluar::where('ids', $request->ids)
			->update([
				'nm_file' => $filesuratkeluar,
			]);
		}

		return redirect('/kepegawaian/surat keluar')
					->with('message', 'Surat Keluar berhasil diubah')
					->with('msg_num', 1);
	}

	public function formdeletesuratkeluar(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 1375);

		Fr_suratkeluar::
				where('ids', $request->ids)
				->delete();

		$filepath = '';
		$filepath .= config('app.savefilesuratkeluar');
		$filepath .= '/' . $request->nm_file;

		if ($request->nm_file) {
			unlink($filepath);
		}

		return redirect('/kepegawaian/surat keluar')
					->with('message', 'Surat Keluar berhasil dihapus')
					->with('msg_num', 1);
	}

	// ---------------- STATUS DISPOSISI ---------------- //

	// -------------------- EKINERJA -------------------- //

	public function entrikinerja(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 335);

		$idemp = Auth::user()->id_emp;

		$laporans = DB::select( DB::raw("
					SELECT *
					from bpaddtfake.dbo.kinerja_data
					where idemp = '$idemp'
					and stat is null
					order by tgl_trans desc
					"));
		$laporans = json_decode(json_encode($laporans), true);

		return view('pages.bpadkepegawaian.kinerjaentri')
				->with('access', $access)
				->with('laporans', $laporans);
	}

	public function kinerjatambah(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 335);

		if ($request->now_tgl_trans) {
			$now_tgl_trans = date('d/m/Y', strtotime(str_replace('/', '-', $request->now_tgl_trans)));
		} else {
			$now_tgl_trans = date('d/m/Y', strtotime(str_replace('/', '-', now('Asia/Jakarta'))));
		}

		if ($request->now_tipe_hadir) {
			$now_tipe_hadir = $request->now_tipe_hadir;
		} else {
			$now_tipe_hadir = 1;
		}

		if ($request->now_jns_hadir) {
			$now_jns_hadir = $request->now_jns_hadir;
		} else {
			$now_jns_hadir = 'Tepat Waktu (8,5 jam/hari)';
		}

		if ($request->now_lainnya) {
			$now_lainnya = $request->now_lainnya;
		} else {
			$now_lainnya = '';
		}

		return view('pages.bpadkepegawaian.kinerjatambah')
				->with('access', $access)
				->with('now_tgl_trans', $now_tgl_trans)
				->with('now_tipe_hadir', $now_tipe_hadir)
				->with('now_jns_hadir', $now_jns_hadir)
				->with('now_lainnya', $now_lainnya);
	}

	public function getaktivitas()
	{
		$idemp = Auth::user()->id_emp;
		// $query = DB::select( DB::raw("
		// 			SELECT a.sts as data_sts, a.tgl as data_tgl, a.idemp as data_idemp, a.tgl_trans as data_tgl_trans, tipe_hadir, jns_hadir, lainnya, stat, tipe_hadir_app, jns_hadir_app, catatan_app,
		// 					b.sts as detail_sts, b.tgl as detail_sts, b.idemp as detail_idemp, b.tgl_trans as detail_tgl_trans, time1, time2, uraian, keterangan
		// 			from bpaddtfake.dbo.kinerja_data a
		// 			join bpaddtfake.dbo.kinerja_detail b on b.idemp = a.idemp
		// 			where b.idemp = '$idemp' 
		// 			and a.tgl_trans = b.tgl_trans
		// 			and a.stat is null
		// 			order by b.tgl_trans desc, time1 asc
		// 			"));

		$query = DB::select( DB::raw("
					SELECT *
					from bpaddtfake.dbo.v_kinerja
					where idemp = '$idemp'
					and stat is null
					"));
		$query = json_decode(json_encode($query), true);

		return $query;
	}

	public function forminsertkinerja(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 335);

		$idemp = Auth::user()->id_emp;
		$splittgltrans = explode("/", $request->tgl_trans);
		$tgl_trans = $splittgltrans[2] . "-" . $splittgltrans[1] . "-" . $splittgltrans[0];

		$cekkinerja = DB::select( DB::raw("
						SELECT *
						from bpaddtfake.dbo.kinerja_data
						where idemp = '$idemp'
						and tgl_trans = '$tgl_trans'
						"));
		$cekkinerja = json_decode(json_encode($cekkinerja), true);

		if ($request->tipe_hadir == 2) {
			Kinerja_detail::	
				where('idemp', $idemp)
				->where('tgl_trans', $tgl_trans)
				->delete();
		}

		if (count($cekkinerja) == 0) {
			Kinerja_data::insert([
				'sts' => 1,
				'tgl' => date('Y-m-d H:i:s'),
				'uname' => Auth::user()->id_emp,
				'idemp' => Auth::user()->id_emp,
				'tgl_trans' => $tgl_trans,
				'tipe_hadir' => $request->tipe_hadir,
				'jns_hadir' => $request->jns_hadir,
				'lainnya' => ($request->lainnya ? $request->lainnya : ''),
				'stat' => null,
				'tipe_hadir_app' => null,
				'jns_hadir_app' => null,
				'catatan_app' => null,
			]);
		} else {
			Kinerja_data::
				where('idemp', $idemp)
				->where('tgl_trans', $tgl_trans)
				->update([
					'sts' => 1,
					'tgl' => date('Y-m-d H:i:s'),
					'uname' => Auth::user()->id_emp,
					'idemp' => Auth::user()->id_emp,
					'tgl_trans' => $tgl_trans,
					'tipe_hadir' => $request->tipe_hadir,
					'jns_hadir' => $request->jns_hadir,
					'lainnya' => ($request->lainnya ? $request->lainnya : ''),
					'stat' => null,
					'tipe_hadir_app' => null,
					'jns_hadir_app' => null,
					'catatan_app' => null,
				]);
		}

		return redirect('/kepegawaian/entri kinerja');
	}

	public function formdeletekinerja(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 335);

		Kinerja_data::	
			where('idemp', $request->idemp)
			->where('tgl_trans', $request->tgl_trans)
			->delete();

		Kinerja_detail::	
			where('idemp', $request->idemp)
			->where('tgl_trans', $request->tgl_trans)
			->delete();

		return redirect('/kepegawaian/entri kinerja')
					->with('message', 'Data kinerja berhasil dihapus')
					->with('msg_num', 1);
	}

	public function forminsertaktivitas(Request $request)
	{
		$idemp = Auth::user()->id_emp;
		$tgl_trans = $request->tgltrans;

		$cekaktivitas = DB::select( DB::raw("
						SELECT *
						from bpaddtfake.dbo.kinerja_data
						where idemp = '$idemp'
						and tgl_trans = CONVERT(datetime, '$tgl_trans')
						"));
		$cekaktivitas = json_decode(json_encode($cekaktivitas), true);

		if (count($cekaktivitas) == 0) {

			$insertkinerja = [
				'sts' => 1,
				'tgl' => date('Y-m-d H:i:s'),
				'uname' => Auth::user()->id_emp,
				'idemp' => Auth::user()->id_emp,
				'tgl_trans' => $request->tgltrans,
				'tipe_hadir' => $request->tipehadir,
				'jns_hadir' => $request->jnshadir,
				'lainnya' => ($request->lainnya ? $request->lainnya : ''),
				'stat' => null,
				'tipe_hadir_app' => null,
				'jns_hadir_app' => null,
				'catatan_app' => null,
			];
			Kinerja_data::insert($insertkinerja);
		}

		$insertaktivitas = [
			'sts' => 1,
			'tgl' => date('Y-m-d H:i:s'),
			'uname' => Auth::user()->id_emp,
			'idemp' => Auth::user()->id_emp,
			'tgl_trans' => $request->tgltrans,
			'time1' => $request->time1,
			'time2' => $request->time2,
			'uraian' => $request->uraian,
			'keterangan' => $request->keterangan,
		];

		if (Kinerja_detail::insert($insertaktivitas)) {
			// $query = DB::select( DB::raw("
			// 			SELECT a.sts as data_sts, a.tgl as data_tgl, a.idemp as data_idemp, a.tgl_trans as data_tgl_trans, tipe_hadir, jns_hadir, lainnya, stat, tipe_hadir_app, jns_hadir_app, catatan_app,
			// 					b.sts as detail_sts, b.tgl as detail_sts, b.idemp as detail_idemp, b.tgl_trans as detail_tgl_trans, time1, time2, uraian, keterangan
			// 			from bpaddtfake.dbo.kinerja_data a
			// 			join bpaddtfake.dbo.kinerja_detail b on b.idemp = a.idemp
			// 			where b.idemp = '$idemp' 
			// 			and a.tgl_trans = b.tgl_trans
			// 			and a.stat is null
			// 			order by b.tgl_trans desc, time1 asc
			// 			"));
			$query = DB::select( DB::raw("
					SELECT *
					from bpaddtfake.dbo.v_kinerja
					where idemp = '$idemp'
					and stat is null
					"));
			$query = json_decode(json_encode($query), true);

			$body_append = '';
			$now_date = '';
			foreach ($query as $key => $data) {
				if ($data['tipe_hadir'] != 2 && $data['time1'] && $data['time2']) {
					$splittime1 = explode(":", $data['time1']);
					$time1 = $splittime1[0] . ":" . $splittime1[1];

					$splittime2 = explode(":", $data['time2']);
					$time2 = $splittime2[0] . ":" . $splittime2[1];

					$splitdate1 = explode(" ", $data['tgl_trans'])[0];
					$splitdate2 = explode("-", $splitdate1);
					$date = $splitdate2[2] . "-" . $splitdate2[1] . "-" . $splitdate2[0];

					if ($now_date != $data['tgl_trans']) {
						$now_date = $data['tgl_trans'];
						$body_append .= '<tr style="background-color: #f7fafc !important">
											<td colspan="5"><b>TANGGAL: '.$date.'</b></td>
										</tr>';
					}

					$body_append .= '<tr>
										<td>'.$time1.'</td>
										<td>'.$time2.'</td>
										<td>'.$data['uraian'].'</td>
										<td>'.$data['keterangan'].'</td>
										<td>
											<input id="idemp-'.$key.'" type="hidden" value="'.$idemp.'"></input>
											<input id="tgl_trans-'.$key.'" type="hidden" value="'.$data['tgl_trans'].'"></input>
											<input id="time1-'.$key.'" type="hidden" value="'.$data['time1'].'"></input>
											<button type="button" class="btn btn-danger btn-outline btn-circle m-r-5 btn_delete_aktivitas" id="'.$key.'"><i class="fa fa-trash"></i></button></td>
										</td>
									</tr>';
				}
			}
			return json_encode($body_append);
		} else {
			return 0;
		}
	}

	public function formdeleteaktivitas(Request $request)
	{
		$idemp = $request->idemp;
		$tgl_trans = $request->tgltrans;
		$time1 = $request->time1;

		Kinerja_detail::	
			where('idemp', $idemp)
			->where('tgl_trans', $tgl_trans)
			->where('time1', $time1)
			->delete();

		// $query = DB::select( DB::raw("
		// 			SELECT a.sts as data_sts, a.tgl as data_tgl, a.idemp as data_idemp, a.tgl_trans as data_tgl_trans, tipe_hadir, jns_hadir, lainnya, stat, tipe_hadir_app, jns_hadir_app, catatan_app,
		// 					b.sts as detail_sts, b.tgl as detail_sts, b.idemp as detail_idemp, b.tgl_trans as detail_tgl_trans, time1, time2, uraian, keterangan
		// 			from bpaddtfake.dbo.kinerja_data a
		// 			join bpaddtfake.dbo.kinerja_detail b on b.idemp = a.idemp
		// 			where b.idemp = '$idemp' 
		// 			and a.tgl_trans = b.tgl_trans
		// 			and a.stat is null
		// 			order by b.tgl_trans desc, time1 asc
		// 			"));
		$query = DB::select( DB::raw("
					SELECT *
					from bpaddtfake.dbo.v_kinerja
					where idemp = '$idemp'
					and stat is null
					"));
		$query = json_decode(json_encode($query), true);

		$body_append = '';
		$now_date = '';
		foreach ($query as $key => $data) {
			if ($data['tipe_hadir'] != 2 && $data['time1'] && $data['time2']) {
				$splittime1 = explode(":", $data['time1']);
				$time1 = $splittime1[0] . ":" . $splittime1[1];

				$splittime2 = explode(":", $data['time2']);
				$time2 = $splittime2[0] . ":" . $splittime2[1];

				$splitdate1 = explode(" ", $data['tgl_trans'])[0];
				$splitdate2 = explode("-", $splitdate1);
				$date = $splitdate2[2] . "-" . $splitdate2[1] . "-" . $splitdate2[0];

				if ($now_date != $data['tgl_trans']) {
					$now_date = $data['tgl_trans'];
					$body_append .= '<tr style="background-color: #f7fafc !important">
										<td colspan="5"><b>TANGGAL: '.$date.'</b></td>
									</tr>';
				}

				$body_append .= '<tr>
									<td>'.$time1.'</td>
									<td>'.$time2.'</td>
									<td>'.$data['uraian'].'</td>
									<td>'.$data['keterangan'].'</td>
									<td>
										<input id="idemp-'.$key.'" type="hidden" value="'.$idemp.'"></input>
										<input id="tgl_trans-'.$key.'" type="hidden" value="'.$data['tgl_trans'].'"></input>
										<input id="time1-'.$key.'" type="hidden" value="'.$data['time1'].'"></input>
										<button type="button" class="btn btn-danger btn-outline btn-circle m-r-5 btn_delete_aktivitas" id="'.$key.'"><i class="fa fa-trash"></i></button></td>
									</td>
								</tr>';
			}
		}
		return json_encode($body_append);
	}

	public function approvekinerja(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 336);

		if ($_SESSION['user_data']['idunit']) {
			$idunit = $_SESSION['user_data']['idunit'];
		} else {
			$idunit = '01';
		}

		$pegawais = DB::select( DB::raw("
					SELECT id_emp, nm_emp, nrk_emp FROM bpaddtfake.dbo.emp_data as a
					CROSS APPLY (SELECT TOP 1 tmt_gol,tmt_sk_gol,no_sk_gol,idgol,jns_kp,mk_thn,mk_bln,gambar,nm_pangkat FROM  bpaddtfake.dbo.emp_gol,bpaddtfake.dbo.glo_org_golongan WHERE a.id_emp = emp_gol.noid AND emp_gol.idgol=glo_org_golongan.gol AND emp_gol.sts='1' AND glo_org_golongan.sts='1' ORDER BY tmt_gol DESC) tbgol
					CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  bpaddtfake.dbo.emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
					CROSS APPLY (SELECT TOP 1 iddik,prog_sek,no_sek,th_sek,nm_sek,gelar_dpn_sek,gelar_blk_sek,ijz_cpns,gambar,nm_dik FROM  bpaddtfake.dbo.emp_dik,bpaddtfake.dbo.glo_dik WHERE a.id_emp = emp_dik.noid AND emp_dik.iddik=glo_dik.dik AND emp_dik.sts='1' AND glo_dik.sts='1' ORDER BY th_sek DESC) tbdik
					CROSS APPLY (SELECT TOP 1 * FROM bpaddtfake.dbo.glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
					,bpaddtfake.dbo.glo_skpd as b,bpaddtfake.dbo.glo_org_unitkerja as c,bpaddtfake.dbo.glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1'
					and ked_emp = 'aktif' and tgl_end is null and tbunit.sao like '$idunit%'
					order by nm_emp"));
		$pegawais = json_decode(json_encode($pegawais), true);

		if ($request->now_id_emp) {
			//kalo ada input milih pegawai
			$now_id_emp = $request->now_id_emp;
		} else {
			// kalo gada milih pegawai
			if (Auth::user()->usname) {
				// kalo yg login admin -> ambil id_emp pertama
				$now_id_emp = $pegawais[0]['id_emp'];
			} elseif (Auth::user()->id_emp) {
				// kalo yg login pegawai
				if (strlen($_SESSION['user_data']['idunit']) == 10) {
					// set id_emp sekarang = id_emp pegawai yg login
					$now_id_emp = Auth::user()->id_emp;
				} else {
					// set id_emp sekarang = id_emp pertama dari query list pegawai
					$now_id_emp = $pegawais[0]['id_emp'];
				}
			}
		}

		$laporans = DB::select( DB::raw("
					SELECT kinerja_data.*, emp_data.nm_emp					
					from bpaddtfake.dbo.kinerja_data
					join bpaddtfake.dbo.emp_data on emp_data.id_emp = kinerja_data.idemp
					where idemp = '$now_id_emp'
					and stat is null
					order by tgl_trans desc, nm_emp asc
					"));

		$laporans = json_decode(json_encode($laporans), true);

		return view('pages.bpadkepegawaian.kinerjaapprove')
				->with('access', $access)
				->with('laporans', $laporans)
				->with('pegawais', $pegawais)
				->with('now_id_emp', $now_id_emp);
	}

	public function formapprovekinerja(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 336);

		foreach ($request->laporan as $key => $data) {
			$idemp = $request->{'idemp_'.$data};
			Kinerja_data::
				where('idemp', $request->{'idemp_'.$data})
				->where('tgl_trans', $request->{'tgl_trans_'.$data})
				->update([
					'stat' => 1,
					'tipe_hadir_app' => $request->{'tipe_hadir_'.$data},
					'jns_hadir_app' => $request->{'jns_hadir_'.$data},
					'catatan_app' => '',
				]);
		}

		return redirect('/kepegawaian/approve kinerja?now_id_emp='.$idemp)
					->with('message', 'Data kinerja berhasil disetujui')
					->with('msg_num', 1);
	}

	public function formapprovekinerjasingle(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 336);

		$tgl_trans = date('Y-m-d',strtotime($request->tgl_trans));

		if ($request->lainnya) {
			Kinerja_data::
			where('idemp', $request->idemp)
			->where('tgl_trans', $tgl_trans)
			->update([
				'stat' => 1,
				'lainnya' => $request->lainnya,
				'tipe_hadir_app' => $request->tipe_hadir,
				'jns_hadir_app' => $request->jns_hadir,
				'catatan_app' => $request->catatan_app,
			]);
		} else {
			Kinerja_data::
			where('idemp', $request->idemp)
			->where('tgl_trans', $tgl_trans)
			->update([
				'stat' => 1,
				'tipe_hadir_app' => $request->tipe_hadir,
				'jns_hadir_app' => $request->jns_hadir,
				'catatan_app' => $request->catatan_app,
			]);
		}

		return redirect('/kepegawaian/approve kinerja?now_id_emp='.$request->idemp)
					->with('message', 'Data kinerja berhasil disetujui')
					->with('msg_num', 1);
	}

	public function laporankinerja(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 337);

		if ($_SESSION['user_data']['idunit']) {
			$idunit = $_SESSION['user_data']['idunit'];
		} else {
			$idunit = '01';
		}

		$pegawais = DB::select( DB::raw("
					SELECT id_emp, nm_emp, nrk_emp FROM bpaddtfake.dbo.emp_data as a
					CROSS APPLY (SELECT TOP 1 tmt_gol,tmt_sk_gol,no_sk_gol,idgol,jns_kp,mk_thn,mk_bln,gambar,nm_pangkat FROM  bpaddtfake.dbo.emp_gol,bpaddtfake.dbo.glo_org_golongan WHERE a.id_emp = emp_gol.noid AND emp_gol.idgol=glo_org_golongan.gol AND emp_gol.sts='1' AND glo_org_golongan.sts='1' ORDER BY tmt_gol DESC) tbgol
					CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  bpaddtfake.dbo.emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
					CROSS APPLY (SELECT TOP 1 iddik,prog_sek,no_sek,th_sek,nm_sek,gelar_dpn_sek,gelar_blk_sek,ijz_cpns,gambar,nm_dik FROM  bpaddtfake.dbo.emp_dik,bpaddtfake.dbo.glo_dik WHERE a.id_emp = emp_dik.noid AND emp_dik.iddik=glo_dik.dik AND emp_dik.sts='1' AND glo_dik.sts='1' ORDER BY th_sek DESC) tbdik
					CROSS APPLY (SELECT TOP 1 * FROM bpaddtfake.dbo.glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
					,bpaddtfake.dbo.glo_skpd as b,bpaddtfake.dbo.glo_org_unitkerja as c,bpaddtfake.dbo.glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1'
					and ked_emp = 'aktif' and tgl_end is null and tbunit.sao like '$idunit%'
					order by nm_emp"));
		$pegawais = json_decode(json_encode($pegawais), true);

		if ($request->now_id_emp) {
			//kalo ada input milih pegawai
			$now_id_emp = $request->now_id_emp;
		} else {
			// kalo gada milih pegawai
			if (Auth::user()->usname) {
				// kalo yg login admin -> ambil id_emp pertama
				$now_id_emp = $pegawais[0]['id_emp'];
			} elseif (Auth::user()->id_emp) {
				// kalo yg login pegawai
				if (strlen($_SESSION['user_data']['idunit']) == 10) {
					// set id_emp sekarang = id_emp pegawai yg login
					$now_id_emp = Auth::user()->id_emp;
				} else {
					// set id_emp sekarang = id_emp pertama dari query list pegawai
					$now_id_emp = $pegawais[0]['id_emp'];
				}
			}
		}

		if ($request->now_month) {
			$now_month = (int)$request->now_month;
		} else {
			$now_month = (int)date('m');
		}

		if ($request->now_year) {
			$now_year = (int)$request->now_year;
		} else {
			$now_year = (int)date('Y');
		}

		if ($request->now_valid) {
			$now_valid = $request->now_valid;
		} else {
			$now_valid = "= 1";
		}

		$laporans = DB::select( DB::raw("
					SELECT *
					from bpaddtfake.dbo.v_kinerja
					where idemp = '$now_id_emp'
					and stat $now_valid
					and YEAR(tgl_trans) = $now_year
		 			and MONTH(tgl_trans) = $now_month
					"));
		$laporans = json_decode(json_encode($laporans), true);

		return view('pages.bpadkepegawaian.kinerjalaporan')
				->with('access', $access)
				->with('pegawais', $pegawais)
				->with('now_id_emp', $now_id_emp)
				->with('now_month', $now_month)
				->with('now_year', $now_year)
				->with('now_valid', $now_valid)
				->with('laporans', $laporans);
	}

	// -------------------- EKINERJA -------------------- //
}