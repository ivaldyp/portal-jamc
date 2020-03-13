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
use App\Fr_disposisi;
use App\Glo_dik;
use App\Glo_disposisi_kode;
use App\Glo_disposisi_penanganan;
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

	public function test(Request $request)
	{
		return $request->another;
	}

	public function pegawai(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 369);

		$accessid = $this->checkAccess($_SESSION['user_data']['idgroup'], 37);
		$accessdik = $this->checkAccess($_SESSION['user_data']['idgroup'], 65);
		$accessgol = $this->checkAccess($_SESSION['user_data']['idgroup'], 71);
		$accessjab = $this->checkAccess($_SESSION['user_data']['idgroup'], 72);

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
						->where('noid', Auth::user()->id_emp)
						->where('sts', 1)
						->get();

		$statuses = Glo_org_statusemp::get();
		$pendidikans = Glo_dik::
						orderBy('urut')
						->get();

		return view('pages.bpadprofil.pegawai')
				->with('id_emp', Auth::user()->id_emp)
				->with('emp_data', $emp_data)
				->with('emp_dik', $emp_dik)
				->with('emp_gol', $emp_gol)
				->with('emp_jab', $emp_jab)
				->with('access', $access)
				->with('accessid', $accessid)
				->with('accessdik', $accessdik)
				->with('accessgol', $accessgol)
				->with('accessjab', $accessjab)
				->with('statuses', $statuses)
				->with('pendidikans', $pendidikans);	
	}

	public function formupdateidpegawai(Request $request)
	{
		$this->checkSessionTime();
		$accessid = $this->checkAccess($_SESSION['user_data']['idgroup'], 37);

		$id_emp = $_SESSION['user_data']['id_emp'];
		$filefoto = '';

		// (IDENTITAS) cek dan set variabel untuk file foto pegawai
		if (isset($request->filefoto)) {
			$file = $request->filefoto;

			if ($file->getSize() > 2222222) {
				return redirect('/profil/pegawai')->with('message', 'Ukuran file foto pegawai terlalu besar (Maksimal 2MB)');     
			} 

			$filefoto .= $id_emp . ".". $file->getClientOriginalExtension();

			$tujuan_upload = config('app.savefileimg');
			$file->move($tujuan_upload, $filefoto);
		}
			
		if (!(isset($filefoto))) {
			$filefoto = null;
		}

		Emp_data::where('id_emp', $id_emp)
			->update([
				'tgl_join' => (isset($request->tgl_join) ? date('Y-m-d',strtotime($request->tgl_join)) : null),
				'status_emp' => $request->status_emp,
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
			]);

		if ($filefoto != '') {
			Emp_data::where('id_emp', $id_emp)
			->update([
				'tampilnew' => 1,
				'foto' => $filefoto,
			]);
		}

		return redirect('/profil/pegawai')
					->with('message', 'Pegawai '.$request->nm_emp.' berhasil diubah')
					->with('msg_num', 1);
	}

	public function forminsertdikpegawai (Request $request)
	{
		$this->checkSessionTime();
		$accessid = $this->checkAccess($_SESSION['user_data']['idgroup'], 65);

		$id_emp = $_SESSION['user_data']['id_emp'];
		$fileijazah = '';

		// (PENDIDIKAN) cek dan set variabel untuk file foto ijazah
		if (isset($request->fileijazah)) {
			$file = $request->fileijazah;

			if ($file->getSize() > 2222222) {
				return redirect('/profil/pegawai')->with('message', 'Ukuran file foto ijazah terlalu besar (Maksimal 2MB)');     
			} 

			$fileijazah .= "dik_" . $request->iddik . "_" . $id_emp . ".". $file->getClientOriginalExtension();

			$tujuan_upload = config('app.savefileimg');
			$tujuan_upload .= "/" . $id_emp;

			$file->move($tujuan_upload, $fileijazah);
		}
			
		if (!(isset($fileijazah))) {
			$fileijazah = null;
		}

		$insert_emp_dik = [
				// PENDIDIKAN
				'sts' => 1,
				'tgl' => date('Y-m-d H:i:s'),
				'noid' => $id_emp,
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

		Emp_dik::insert($insert_emp_dik);

		return redirect('/profil/pegawai')
					->with('message', 'Data pendidikan pegawai berhasil ditambah')
					->with('msg_num', 1);
	}

	public function formupdatedikpegawai (Request $request)
	{
		$this->checkSessionTime();
		$accessdik = $this->checkAccess($_SESSION['user_data']['idgroup'], 65);

		$id_emp = $_SESSION['user_data']['id_emp'];
		$fileijazah = '';

		// (PENDIDIKAN) cek dan set variabel untuk file foto ijazah
		if (isset($request->fileijazah)) {
			$file = $request->fileijazah;

			if ($file->getSize() > 2222222) {
				return redirect('/profil/pegawai')->with('message', 'Ukuran file foto ijazah terlalu besar (Maksimal 2MB)');     
			} 

			$fileijazah .= "dik_" . $request->iddik . "_" . $id_emp . ".". $file->getClientOriginalExtension();

			$tujuan_upload = config('app.savefileimg');
			$tujuan_upload .= "/" . $id_emp;

			$file->move($tujuan_upload, $fileijazah);
		}
			
		if (!(isset($fileijazah))) {
			$fileijazah = null;
		}

		Emp_dik::where('noid', $id_emp)
			->where('ids', $request->ids)
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

		if ($fileijazah != '') {
			Emp_dik::where('noid', $id_emp)
			->where('ids', $request->ids)
			->update([
				'tampilnew' => 1,
				'gambar' => $fileijazah,
			]);
		}

		return redirect('/profil/pegawai')
					->with('message', 'Data pendidikan pegawai berhasil diubah')
					->with('msg_num', 1);
	}

	public function formdeletedikpegawai(Request $request)
	{
		$this->checkSessionTime();
		$accessdik = $this->checkAccess($_SESSION['user_data']['idgroup'], 65);

		$id_emp = $_SESSION['user_data']['id_emp'];

		Emp_dik::where('noid', $id_emp)
		->where('ids', $request->ids)
		->update([
			'sts' => 0,
		]);

		return redirect('/profil/pegawai')
					->with('message', 'Data pendidikan pegawai berhasil dihapus')
					->with('msg_num', 1);
	}

	public function disposisi(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 35);

		$idgroup = $_SESSION['user_data']['idgroup'];
		if (substr($idgroup, 0, 8) == 'EMPLOYEE' || $idgroup == 'ADMIN DIA' || $idgroup == 'TYPIST') {
			$disposisiinboxs = DB::select( DB::raw("select disp.*, emp1.nm_emp as from_pm, emp2.nm_emp as to_pm, disp.from_pm as from_id, disp.to_pm as to_id
										  from fr_disposisi disp
										  left join emp_data emp1 on disp.from_pm = emp1.id_emp
										  left join emp_data emp2 on disp.to_pm = emp2.id_emp
										  where no_form in (SELECT distinct(no_form)
										  FROM [bpaddt].[dbo].[fr_disposisi]
										  where to_pm = '".$_SESSION['user_data']['id_emp'] ."')
										  and disp.sts = 1
										  order by disp.no_form DESC, disp.ids ASC") );

			if (strlen($_SESSION['user_data']['idunit']) == 10) {
				$disposisiends = DB::select( DB::raw("select disp.*, emp1.nm_emp as from_pm, emp2.nm_emp as to_pm, disp.from_pm as from_id, disp.to_pm as to_id
										  from fr_disposisi disp
										  left join emp_data emp1 on disp.from_pm = emp1.id_emp
										  left join emp_data emp2 on disp.to_pm = emp2.id_emp
										  where no_form in (SELECT distinct(no_form)
										  FROM [bpaddt].[dbo].[fr_disposisi]
										  where to_pm = '".$_SESSION['user_data']['id_emp'] ."')
										  and disp.sts = 1
										  order by disp.no_form DESC, disp.ids ASC") );
				$disposisisents = 0;
			} else {
				$disposisisents = DB::select( DB::raw("select disp.*, emp1.nm_emp as from_pm, emp2.nm_emp as to_pm, disp.from_pm as from_id, disp.to_pm as to_id
										  from fr_disposisi disp
										  left join emp_data emp1 on disp.from_pm = emp1.id_emp
										  left join emp_data emp2 on disp.to_pm = emp2.id_emp
										  where no_form in (SELECT distinct(no_form)
										  FROM [bpaddt].[dbo].[fr_disposisi]
										  where from_pm = '".$_SESSION['user_data']['id_emp'] ."')
										  and disp.sts = 1
										  order by disp.no_form DESC, disp.ids ASC") );
				$disposisiends = 0;
			}

			$isEmployee = 1;
			$disposisiinboxs = json_decode(json_encode($disposisiinboxs), true);
			$disposisisents = json_decode(json_encode($disposisisents), true);
			$disposisiends = json_decode(json_encode($disposisiends), true);
			$disposisis = 0;
		} else {
			$disposisis = DB::select( DB::raw("select TOP 500 *
										  from fr_disposisi
										  where (kode_disposisi is not null 
										  or kode_disposisi != '')
										  and sts = 1
										  order by no_form DESC") );
			$isEmployee = 0;
			$disposisis = json_decode(json_encode($disposisis), true);
			$disposisiinboxs = 0;
			$disposisisents = 0;
			$disposisiends = 0;
		}

		return view('pages.bpadprofil.disposisi')
				->with('access', $access)
				->with('disposisis', $disposisis)
				->with('disposisiinboxs', $disposisiinboxs)
				->with('disposisisents', $disposisisents)
				->with('disposisiends', $disposisiends)
				->with('isEmployee', $isEmployee);
	}

	public function disposisilihat (Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 35);

		Fr_disposisi::
					where('ids', $request->ids)
					->update([
						'rd' => 'Y',
					]);

		$opendisposisi = Fr_disposisi::
							join('glo_disposisi_kode', 'glo_disposisi_kode.kd_jnssurat', '=', 'fr_disposisi.kode_disposisi')
							->where('no_form', $request->no_form)
							->orderBy('ids')
							->get();

		$kddispos = Glo_disposisi_kode::orderBy('kd_jnssurat')->get();

		if ($_SESSION['user_data']['child'] == 1 || $_SESSION['user_data']['idgroup'] == 'SKPD INTERNAL') {

			if ($_SESSION['user_data']['idgroup'] == 'SKPD INTERNAL') {
				$idunits = '%';
			} else {
				$idunits = $_SESSION['user_data']['idunit'];
			}

			$stafs = DB::select( DB::raw("
						SELECT id_emp,a.uname+'::'+convert(varchar,a.tgl)+'::'+a.ip,createdate,nip_emp,nrk_emp,nm_emp,nrk_emp+'-'+nm_emp as c2,gelar_dpn,gelar_blk,jnkel_emp,tempat_lahir,tgl_lahir,CONVERT(VARCHAR(10), tgl_lahir, 103) AS [DD/MM/YYYY],idagama,alamat_emp,tlp_emp,email_emp,status_emp,ked_emp,status_nikah,gol_darah,nm_bank,cb_bank,an_bank,nr_bank,no_taspen,npwp,no_askes,no_jamsos,tgl_join,CONVERT(VARCHAR(10), tgl_join, 103) AS [DD/MM/YYYY],tgl_end,reason,a.idgroup,pass_emp,foto,ttd,a.telegram_id,a.lastlogin,tbgol.tmt_gol,CONVERT(VARCHAR(10), tbgol.tmt_gol, 103) AS [DD/MM/YYYY],tbgol.tmt_sk_gol,CONVERT(VARCHAR(10), tbgol.tmt_sk_gol, 103) AS [DD/MM/YYYY],tbgol.no_sk_gol,tbgol.idgol,tbgol.jns_kp,tbgol.mk_thn,tbgol.mk_bln,tbgol.gambar,tbgol.nm_pangkat,tbjab.tmt_jab,CONVERT(VARCHAR(10), tbjab.tmt_jab, 103) AS [DD/MM/YYYY],tbjab.idskpd,tbjab.idunit,tbjab.idjab, tbunit.child, tbjab.idlok,tbjab.tmt_sk_jab,CONVERT(VARCHAR(10), tbjab.tmt_sk_jab, 103) AS [DD/MM/YYYY],tbjab.no_sk_jab,tbjab.jns_jab,tbjab.idjab,tbjab.eselon,tbjab.gambar,tbdik.iddik,tbdik.prog_sek,tbdik.no_sek,tbdik.th_sek,tbdik.nm_sek,tbdik.gelar_dpn_sek,tbdik.gelar_blk_sek,tbdik.ijz_cpns,tbdik.gambar,tbdik.nm_dik,b.nm_skpd,c.nm_unit,c.notes,d.nm_lok FROM emp_data as a
							CROSS APPLY (SELECT TOP 1 tmt_gol,tmt_sk_gol,no_sk_gol,idgol,jns_kp,mk_thn,mk_bln,gambar,nm_pangkat FROM  emp_gol,glo_org_golongan WHERE a.id_emp = emp_gol.noid AND emp_gol.idgol=glo_org_golongan.gol AND emp_gol.sts='1' AND glo_org_golongan.sts='1' ORDER BY tmt_gol DESC) tbgol
							CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
							CROSS APPLY (SELECT TOP 1 iddik,prog_sek,no_sek,th_sek,nm_sek,gelar_dpn_sek,gelar_blk_sek,ijz_cpns,gambar,nm_dik FROM  emp_dik,glo_dik WHERE a.id_emp = emp_dik.noid AND emp_dik.iddik=glo_dik.dik AND emp_dik.sts='1' AND glo_dik.sts='1' ORDER BY th_sek DESC) tbdik
							CROSS APPLY (SELECT TOP 1 * FROM glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
							,glo_skpd as b,glo_org_unitkerja as c,glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1' 
							and idunit like '".$idunits."%' and ked_emp = 'aktif' order by nm_emp") );
			$stafs = json_decode(json_encode($stafs), true);
		} else {
			$stafs = 0;
		}

		if ($_SESSION['user_data']['idgroup'] == 'SKPD INTERNAL') {
			$jabatans = Glo_org_jabatan::
					where('jabatan',  'like', '%Kepala Badan%')
					->get();
		} else {
			$jabatans = Glo_org_jabatan::
					whereRaw("LEFT(jabatan, 6) = 'kepala'")
					->orWhereRaw("LEFT(jabatan, 5) = 'sekre'")
					->orderBy('jabatan')
					->get();
		}

		$penanganans = Glo_disposisi_penanganan::
						orderBy('urut')
						->get();

		$idgroup = $_SESSION['user_data']['idgroup'];
		if (substr($idgroup, 0, 8) == 'EMPLOYEE' || $idgroup == 'ADMIN DIA' || $idgroup == 'TYPIST') {
			$isEmployee = 1;
		} else {
			$isEmployee = 0;
		}	

		return view('pages.bpadprofil.lihatdisposisi')
				->with('access', $access)
				->with('opendisposisi', $opendisposisi)
				->with('kddispos', $kddispos)
				->with('stafs', $stafs)
				->with('jabatans', $jabatans)
				->with('penanganans', $penanganans)
				->with('isEmployee', $isEmployee);
	}

	public function disposisitambah (Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 35);

		$maxnoform = Fr_disposisi::max('no_form');
		$kddispos = Glo_disposisi_kode::orderBy('kd_jnssurat')->get();

		if ($_SESSION['user_data']['child'] == 1 || $_SESSION['user_data']['idgroup'] == 'SKPD INTERNAL') {

			if ($_SESSION['user_data']['idgroup'] == 'SKPD INTERNAL') {
				$idunits = '%';
			} else {
				$idunits = $_SESSION['user_data']['idunit'];
			}

			$stafs = DB::select( DB::raw("
						SELECT id_emp,a.uname+'::'+convert(varchar,a.tgl)+'::'+a.ip,createdate,nip_emp,nrk_emp,nm_emp,nrk_emp+'-'+nm_emp as c2,gelar_dpn,gelar_blk,jnkel_emp,tempat_lahir,tgl_lahir,CONVERT(VARCHAR(10), tgl_lahir, 103) AS [DD/MM/YYYY],idagama,alamat_emp,tlp_emp,email_emp,status_emp,ked_emp,status_nikah,gol_darah,nm_bank,cb_bank,an_bank,nr_bank,no_taspen,npwp,no_askes,no_jamsos,tgl_join,CONVERT(VARCHAR(10), tgl_join, 103) AS [DD/MM/YYYY],tgl_end,reason,a.idgroup,pass_emp,foto,ttd,a.telegram_id,a.lastlogin,tbgol.tmt_gol,CONVERT(VARCHAR(10), tbgol.tmt_gol, 103) AS [DD/MM/YYYY],tbgol.tmt_sk_gol,CONVERT(VARCHAR(10), tbgol.tmt_sk_gol, 103) AS [DD/MM/YYYY],tbgol.no_sk_gol,tbgol.idgol,tbgol.jns_kp,tbgol.mk_thn,tbgol.mk_bln,tbgol.gambar,tbgol.nm_pangkat,tbjab.tmt_jab,CONVERT(VARCHAR(10), tbjab.tmt_jab, 103) AS [DD/MM/YYYY],tbjab.idskpd,tbjab.idunit,tbjab.idjab, tbunit.child, tbjab.idlok,tbjab.tmt_sk_jab,CONVERT(VARCHAR(10), tbjab.tmt_sk_jab, 103) AS [DD/MM/YYYY],tbjab.no_sk_jab,tbjab.jns_jab,tbjab.idjab,tbjab.eselon,tbjab.gambar,tbdik.iddik,tbdik.prog_sek,tbdik.no_sek,tbdik.th_sek,tbdik.nm_sek,tbdik.gelar_dpn_sek,tbdik.gelar_blk_sek,tbdik.ijz_cpns,tbdik.gambar,tbdik.nm_dik,b.nm_skpd,c.nm_unit,c.notes,d.nm_lok FROM emp_data as a
							CROSS APPLY (SELECT TOP 1 tmt_gol,tmt_sk_gol,no_sk_gol,idgol,jns_kp,mk_thn,mk_bln,gambar,nm_pangkat FROM  emp_gol,glo_org_golongan WHERE a.id_emp = emp_gol.noid AND emp_gol.idgol=glo_org_golongan.gol AND emp_gol.sts='1' AND glo_org_golongan.sts='1' ORDER BY tmt_gol DESC) tbgol
							CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
							CROSS APPLY (SELECT TOP 1 iddik,prog_sek,no_sek,th_sek,nm_sek,gelar_dpn_sek,gelar_blk_sek,ijz_cpns,gambar,nm_dik FROM  emp_dik,glo_dik WHERE a.id_emp = emp_dik.noid AND emp_dik.iddik=glo_dik.dik AND emp_dik.sts='1' AND glo_dik.sts='1' ORDER BY th_sek DESC) tbdik
							CROSS APPLY (SELECT TOP 1 * FROM glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
							,glo_skpd as b,glo_org_unitkerja as c,glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1' 
							and idunit like '".$idunits."%' and ked_emp = 'aktif' order by nm_emp") );
			$stafs = json_decode(json_encode($stafs), true);
		} else {
			$stafs = 0;
		}

		if ($_SESSION['user_data']['idgroup'] == 'SKPD INTERNAL') {
			$jabatans = Glo_org_jabatan::
					where('jabatan',  'like', '%Kepala Badan%')
					->get();
		} else {
			$jabatans = Glo_org_jabatan::
					whereRaw("LEFT(jabatan, 6) = 'kepala'")
					->orWhereRaw("LEFT(jabatan, 5) = 'sekre'")
					->orderBy('jabatan')
					->get();
		}

		$penanganans = Glo_disposisi_penanganan::
						orderBy('urut')
						->get();

		return view('pages.bpadprofil.tambahdisposisi')
				->with('access', $access)
				->with('maxnoform', $maxnoform)
				->with('kddispos', $kddispos)
				->with('stafs', $stafs)
				->with('jabatans', $jabatans)
				->with('penanganans', $penanganans);
	}

	public function forminsertdisposisi(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 35);

		$filedispo = '';

		// (IDENTITAS) cek dan set variabel untuk file foto pegawai
		if (isset($request->nm_file)) {
			$file = $request->nm_file;

			if ($file->getSize() > 2222222) {
				return redirect('/profil/tambah disposisi')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
			} 

			$filedispo .= $file->getClientOriginalName();

			$tujuan_upload = config('app.savefiledisposisi');
			$file->move($tujuan_upload, $filedispo);
		}
			
		if (!(isset($filedispo))) {
			$filedispo = null;
		}

		$maxnoform = Fr_disposisi::max('no_form');
		$splitnoform = explode(".", $maxnoform); 
		$newnoform = $splitnoform[0] . "." . $splitnoform[1] . "." . $splitnoform[2] . "." . ($splitnoform[3]+1);

		$insertsuratmaster = [
			'sts' => 1,
			'tgl' => date('Y-m-d H:i:s'),
			'kd_skpd' => '1.20.512',
			'kd_unit' => '01',
			'no_form' => $newnoform,
			'kd_surat' => '',
			'status_surat' => '',
			'idtop' => 0,
			'tgl_masuk' => date('Y-m-d',strtotime(str_replace('/', '-', $request->tgl_masuk))),
			'usr_input' => (isset(Auth::user()->usname) ? Auth::user()->usname : Auth::user()->id_emp),
			'tgl_input' => date('Y-m-d H:i:s'),
			'no_index' => $request->no_index,
			'kode_disposisi' => $request->kode_disposisi,
			'perihal' => $request->perihal,
			'tgl_surat' => $request->tgl_surat,
			'no_surat' => $request->no_surat,
			'asal_surat' => $request->asal_surat,
			'kepada_surat' => $request->kepada_surat,
			'sifat1_surat' => $request->sifat1_surat,
			'sifat2_surat' => $request->sifat2_surat,
			'ket_lain' => $request->ket_lain,
			'nm_file' => $filedispo,
			'child' => 0,
		];

		if (Fr_disposisi::insert($insertsuratmaster)) {

			$findidemp = DB::select( DB::raw("
						SELECT id_emp,a.uname+'::'+convert(varchar,a.tgl)+'::'+a.ip,createdate,nip_emp,nrk_emp,nm_emp,nrk_emp+'-'+nm_emp as c2,gelar_dpn,gelar_blk,jnkel_emp,tempat_lahir,tgl_lahir,CONVERT(VARCHAR(10), tgl_lahir, 103) AS [DD/MM/YYYY],idagama,alamat_emp,tlp_emp,email_emp,status_emp,ked_emp,status_nikah,gol_darah,nm_bank,cb_bank,an_bank,nr_bank,no_taspen,npwp,no_askes,no_jamsos,tgl_join,CONVERT(VARCHAR(10), tgl_join, 103) AS [DD/MM/YYYY],tgl_end,reason,a.idgroup,pass_emp,foto,ttd,a.telegram_id,a.lastlogin,tbgol.tmt_gol,CONVERT(VARCHAR(10), tbgol.tmt_gol, 103) AS [DD/MM/YYYY],tbgol.tmt_sk_gol,CONVERT(VARCHAR(10), tbgol.tmt_sk_gol, 103) AS [DD/MM/YYYY],tbgol.no_sk_gol,tbgol.idgol,tbgol.jns_kp,tbgol.mk_thn,tbgol.mk_bln,tbgol.gambar,tbgol.nm_pangkat,tbjab.tmt_jab,CONVERT(VARCHAR(10), tbjab.tmt_jab, 103) AS [DD/MM/YYYY],tbjab.idskpd,tbjab.idunit,tbjab.idjab, tbunit.child, tbjab.idlok,tbjab.tmt_sk_jab,CONVERT(VARCHAR(10), tbjab.tmt_sk_jab, 103) AS [DD/MM/YYYY],tbjab.no_sk_jab,tbjab.jns_jab,tbjab.idjab,tbjab.eselon,tbjab.gambar,tbdik.iddik,tbdik.prog_sek,tbdik.no_sek,tbdik.th_sek,tbdik.nm_sek,tbdik.gelar_dpn_sek,tbdik.gelar_blk_sek,tbdik.ijz_cpns,tbdik.gambar,tbdik.nm_dik,b.nm_skpd,c.nm_unit,c.notes,d.nm_lok FROM emp_data as a
							CROSS APPLY (SELECT TOP 1 tmt_gol,tmt_sk_gol,no_sk_gol,idgol,jns_kp,mk_thn,mk_bln,gambar,nm_pangkat FROM  emp_gol,glo_org_golongan WHERE a.id_emp = emp_gol.noid AND emp_gol.idgol=glo_org_golongan.gol AND emp_gol.sts='1' AND glo_org_golongan.sts='1' ORDER BY tmt_gol DESC) tbgol
							CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
							CROSS APPLY (SELECT TOP 1 iddik,prog_sek,no_sek,th_sek,nm_sek,gelar_dpn_sek,gelar_blk_sek,ijz_cpns,gambar,nm_dik FROM  emp_dik,glo_dik WHERE a.id_emp = emp_dik.noid AND emp_dik.iddik=glo_dik.dik AND emp_dik.sts='1' AND glo_dik.sts='1' ORDER BY th_sek DESC) tbdik
							CROSS APPLY (SELECT TOP 1 * FROM glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
							,glo_skpd as b,glo_org_unitkerja as c,glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1' 
							and tbjab.idjab like '".$request->jabatans[0]."' and ked_emp = 'aktif' order by nm_emp") )[0];
			$findidemp = json_decode(json_encode($findidemp), true);

			$idnew = DB::getPdo()->lastInsertId();
			$insertsurat = [
				'sts' => 1,
				'tgl' => date('Y-m-d H:i:s'),
				'kd_skpd' => '1.20.512',
				'kd_unit' => '01',
				'no_form' => $newnoform,
				'idtop' => $idnew,
				'tgl_masuk' => date('Y-m-d',strtotime(str_replace('/', '-', $request->tgl_masuk))),
				'kepada' => $request->jabatans[0],
				'penanganan' => $request->penanganan,
				'from_pm' => (isset(Auth::user()->usname) ? Auth::user()->usname : Auth::user()->id_emp),
				'to_pm' => $findidemp['id_emp'],
				'rd' => 'N',
				'child' => 0,
			];

			if (Fr_disposisi::insert($insertsurat)) {
				return redirect('/profil/disposisi')
					->with('message', 'Disposisi berhasil dibuat')
					->with('msg_num', 1);
			}
		}
	}

	public function deleteLoopDisposisi($ids)
	{
		$querys = Fr_disposisi::
				where('idtop', $ids)
				->get(['ids', 'child']);

		foreach ($querys as $key => $query) {
			$this->deleteLoopDisposisi($query['ids']);
			Fr_disposisi::
				where('ids', $query->ids)
				->delete();
		}

		return 1;
	}

	public function formdeletedisposisi(Request $request)
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 35);

		$this->deleteLoopDisposisi($request->ids);

		Fr_disposisi::
				where('ids', $request->ids)
				->delete();

		return redirect('/profil/disposisi')
					->with('message', 'Disposisi berhasil dihapus')
					->with('msg_num', 1);
	}
}
