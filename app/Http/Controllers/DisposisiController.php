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
use App\glo_org_unitkerja;
use App\Sec_access;
use App\Sec_menu;

session_start();

class DisposisiController extends Controller
{
	use SessionCheckTraits;

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function formdisposisi(Request $request)
	{
		$this->checkSessionTime();
		$currentpath = str_replace("%20", " ", $_SERVER['REQUEST_URI']);
		$currentpath = explode("?", $currentpath)[0];
		$thismenu = Sec_menu::where('urlnew', $currentpath)->first('ids');
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], $thismenu['ids']);

		if ($request->yearnow) {
			$yearnow = (int)$request->yearnow;
		} else {
			$yearnow = (int)date('Y');
		}

		if ($request->monthnow) {
			$monthnow = (int)$request->monthnow;
		} else {
			$monthnow = (int)date('m');
		}

		if ($request->signnow) {
			$signnow = $request->signnow;
		} else {
			$signnow = "=";
		}

		if ($request->searchnow) {
			$qsearchnow = "and (kd_surat = '".$request->searchnow."' or no_form = '".$request->searchnow."')";
		} else {
			$qsearchnow = "";
		}

		$idgroup = $_SESSION['user_data']['id_emp'];
		if (is_null($idgroup)) {
			$disposisisents = DB::select( DB::raw("SELECT TOP (500) [ids]
												  ,[sts]
												  ,[uname]
												  ,[tgl]
												  ,[ip]
												  ,[logbuat]
												  ,[kd_skpd]
												  ,[kd_unit]
												  ,[no_form]
												  ,[kd_surat]
												  ,[status_surat]
												  ,[idtop]
												  ,[tgl_masuk]
												  ,[usr_input]
												  ,[tgl_input]
												  ,[no_index]
												  ,[kode_disposisi]
												  ,[perihal]
												  ,[tgl_surat]
												  ,[no_surat]
												  ,[asal_surat]
												  ,[kepada_surat]
												  ,[sifat1_surat]
												  ,[sifat2_surat]
												  ,[ket_lain]
												  ,[nm_file]
												  ,[kepada]
												  ,[noid]
												  ,[penanganan]
												  ,[catatan]
												  ,[from_user]
												  ,[from_pm]
												  ,[to_user]
												  ,[to_pm]
												  ,[rd]
												  ,[usr_rd]
												  ,[tgl_rd]
												  ,[selesai]
												  ,[child]
												  ,[penanganan_final]
												  ,[catatan_final]
												  FROM [bpaddtfake].[dbo].[fr_disposisi]
												  where status_surat like 's'
												  $qsearchnow
												  and month(tgl_masuk) $signnow $monthnow
												  and year(tgl_masuk) = $yearnow
												  and sts = 1
												  order by tgl_masuk desc, no_form desc"));
			$disposisidrafts = DB::select( DB::raw("SELECT TOP (500) [ids]
												  ,[sts]
												  ,[uname]
												  ,[tgl]
												  ,[ip]
												  ,[logbuat]
												  ,[kd_skpd]
												  ,[kd_unit]
												  ,[no_form]
												  ,[kd_surat]
												  ,[status_surat]
												  ,[idtop]
												  ,[tgl_masuk]
												  ,[usr_input]
												  ,[tgl_input]
												  ,[no_index]
												  ,[kode_disposisi]
												  ,[perihal]
												  ,[tgl_surat]
												  ,[no_surat]
												  ,[asal_surat]
												  ,[kepada_surat]
												  ,[sifat1_surat]
												  ,[sifat2_surat]
												  ,[ket_lain]
												  ,[nm_file]
												  ,[kepada]
												  ,[noid]
												  ,[penanganan]
												  ,[catatan]
												  ,[from_user]
												  ,[from_pm]
												  ,[to_user]
												  ,[to_pm]
												  ,[rd]
												  ,[usr_rd]
												  ,[tgl_rd]
												  ,[selesai]
												  ,[child]
												  ,[penanganan_final]
												  ,[catatan_final]
												  FROM [bpaddtfake].[dbo].[fr_disposisi]
												  where status_surat like 'd'
												  $qsearchnow
												  and month(tgl_masuk) $signnow $monthnow
												  and year(tgl_masuk) = $yearnow
												  and sts = 1
												  order by tgl_masuk desc, no_form desc"));
			$disposisisents = json_decode(json_encode($disposisisents), true);
			$disposisidrafts = json_decode(json_encode($disposisidrafts), true);
		} else {
			$disposisisents = DB::select( DB::raw("SELECT TOP 100 [ids]
												  ,[sts]
												  ,[uname]
												  ,[tgl]
												  ,[ip]
												  ,[logbuat]
												  ,[kd_skpd]
												  ,[kd_unit]
												  ,[no_form]
												  ,[kd_surat]
												  ,[status_surat]
												  ,[idtop]
												  ,[tgl_masuk]
												  ,[usr_input]
												  ,[tgl_input]
												  ,[no_index]
												  ,[kode_disposisi]
												  ,[perihal]
												  ,[tgl_surat]
												  ,[no_surat]
												  ,[asal_surat]
												  ,[kepada_surat]
												  ,[sifat1_surat]
												  ,[sifat2_surat]
												  ,[ket_lain]
												  ,[nm_file]
												  ,[kepada]
												  ,[noid]
												  ,[penanganan]
												  ,[catatan]
												  ,[from_user]
												  ,[from_pm]
												  ,[to_user]
												  ,[to_pm]
												  ,[rd]
												  ,[usr_rd]
												  ,[tgl_rd]
												  ,[selesai]
												  ,[child]
												  ,[penanganan_final]
												  ,[catatan_final]
												  FROM [bpaddtfake].[dbo].[fr_disposisi]
												  where status_surat like 's'
												  $qsearchnow
												  and month(tgl_masuk) $signnow $monthnow
												  and year(tgl_masuk) = $yearnow
												  and usr_input like '$idgroup'
												  and sts = 1
												  order by tgl_masuk desc, no_form desc"));
			$disposisidrafts = DB::select( DB::raw("SELECT TOP (100) [ids]
												  ,[sts]
												  ,[uname]
												  ,[tgl]
												  ,[ip]
												  ,[logbuat]
												  ,[kd_skpd]
												  ,[kd_unit]
												  ,[no_form]
												  ,[kd_surat]
												  ,[status_surat]
												  ,[idtop]
												  ,[tgl_masuk]
												  ,[usr_input]
												  ,[tgl_input]
												  ,[no_index]
												  ,[kode_disposisi]
												  ,[perihal]
												  ,[tgl_surat]
												  ,[no_surat]
												  ,[asal_surat]
												  ,[kepada_surat]
												  ,[sifat1_surat]
												  ,[sifat2_surat]
												  ,[ket_lain]
												  ,[nm_file]
												  ,[kepada]
												  ,[noid]
												  ,[penanganan]
												  ,[catatan]
												  ,[from_user]
												  ,[from_pm]
												  ,[to_user]
												  ,[to_pm]
												  ,[rd]
												  ,[usr_rd]
												  ,[tgl_rd]
												  ,[selesai]
												  ,[child]
												  ,[penanganan_final]
												  ,[catatan_final]
												  FROM [bpaddtfake].[dbo].[fr_disposisi]
												  where status_surat like 'd'
												  $qsearchnow
												  and month(tgl_masuk) $signnow $monthnow
												  and year(tgl_masuk) = $yearnow
												  and usr_input like '$idgroup'
												  and sts = 1
												  order by tgl_masuk desc, no_form desc"));
			$disposisisents = json_decode(json_encode($disposisisents), true);
			$disposisidrafts = json_decode(json_encode($disposisidrafts), true);
		}

		return view('pages.bpaddisposisi.formdisposisi')
				->with('access', $access)
				->with('disposisisents', $disposisisents)
				->with('disposisidrafts', $disposisidrafts)
				->with('signnow', $signnow)
				->with('searchnow', $request->searchnow)
				->with('monthnow', $monthnow)
				->with('yearnow', $yearnow);
	}

	public function disposisitambah(Request $request)
	{
		$this->checkSessionTime();

		$maxnoform = Fr_disposisi::max('no_form');
		if (is_null($maxnoform)) {
			$maxnoform = '1.20.512.'.substr(date('Y'), -2).'100001';
		} else {
			$splitmaxform = explode(".", $maxnoform);
			$maxnoform = $splitmaxform[0] . '.' . $splitmaxform[1] . '.' . $splitmaxform[2] . '.' . substr(date('Y'), -2) . substr(($splitmaxform[3]+1), -6);
		}
		$kddispos = Glo_disposisi_kode::orderBy('kd_jnssurat')->get();

		$unitkerjas = DB::select( DB::raw("SELECT TOP (1000) [sts]
											  ,[uname]
											  ,[tgl]
											  ,[ip]
											  ,[logbuat]
											  ,[kd_skpd]
											  ,[kd_unit]
											  ,[nm_unit]
											  ,[cp_unit]
											  ,[notes]
											  ,[child]
											  ,[sao]
											  ,[tgl_unit]
										  FROM [bpaddtfake].[dbo].[glo_org_unitkerja]
										  order by kd_unit") );
		$unitkerjas = json_decode(json_encode($unitkerjas), true);

		$stafs = DB::select( DB::raw("
					SELECT id_emp,a.uname+'::'+convert(varchar,a.tgl)+'::'+a.ip,createdate,nip_emp,nrk_emp,nm_emp,nrk_emp+'-'+nm_emp as c2,gelar_dpn,gelar_blk,jnkel_emp,tempat_lahir,tgl_lahir,CONVERT(VARCHAR(10), tgl_lahir, 103) AS [DD/MM/YYYY],idagama,alamat_emp,tlp_emp,email_emp,status_emp,ked_emp,status_nikah,gol_darah,nm_bank,cb_bank,an_bank,nr_bank,no_taspen,npwp,no_askes,no_jamsos,tgl_join,CONVERT(VARCHAR(10), tgl_join, 103) AS [DD/MM/YYYY],tgl_end,reason,a.idgroup,pass_emp,foto,ttd,a.telegram_id,a.lastlogin,tbgol.tmt_gol,CONVERT(VARCHAR(10), tbgol.tmt_gol, 103) AS [DD/MM/YYYY],tbgol.tmt_sk_gol,CONVERT(VARCHAR(10), tbgol.tmt_sk_gol, 103) AS [DD/MM/YYYY],tbgol.no_sk_gol,tbgol.idgol,tbgol.jns_kp,tbgol.mk_thn,tbgol.mk_bln,tbgol.gambar,tbgol.nm_pangkat,tbjab.tmt_jab,CONVERT(VARCHAR(10), tbjab.tmt_jab, 103) AS [DD/MM/YYYY],tbjab.idskpd,tbjab.idunit,tbjab.idjab, tbunit.child, tbjab.idlok,tbjab.tmt_sk_jab,CONVERT(VARCHAR(10), tbjab.tmt_sk_jab, 103) AS [DD/MM/YYYY],tbjab.no_sk_jab,tbjab.jns_jab,tbjab.idjab,tbjab.eselon,tbjab.gambar,tbdik.iddik,tbdik.prog_sek,tbdik.no_sek,tbdik.th_sek,tbdik.nm_sek,tbdik.gelar_dpn_sek,tbdik.gelar_blk_sek,tbdik.ijz_cpns,tbdik.gambar,tbdik.nm_dik,b.nm_skpd,c.nm_unit,c.notes,d.nm_lok FROM bpaddtfake.dbo.emp_data as a
						CROSS APPLY (SELECT TOP 1 tmt_gol,tmt_sk_gol,no_sk_gol,idgol,jns_kp,mk_thn,mk_bln,gambar,nm_pangkat FROM bpaddtfake.dbo.emp_gol,bpaddtfake.dbo.glo_org_golongan WHERE a.id_emp = emp_gol.noid AND emp_gol.idgol=glo_org_golongan.gol AND emp_gol.sts='1' AND glo_org_golongan.sts='1' ORDER BY tmt_gol DESC) tbgol
						CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  bpaddtfake.dbo.emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
						CROSS APPLY (SELECT TOP 1 iddik,prog_sek,no_sek,th_sek,nm_sek,gelar_dpn_sek,gelar_blk_sek,ijz_cpns,gambar,nm_dik FROM  bpaddtfake.dbo.emp_dik,bpaddtfake.dbo.glo_dik WHERE a.id_emp = emp_dik.noid AND emp_dik.iddik=glo_dik.dik AND emp_dik.sts='1' AND glo_dik.sts='1' ORDER BY th_sek DESC) tbdik
						CROSS APPLY (SELECT TOP 1 * FROM bpaddtfake.dbo.glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
						,bpaddtfake.dbo.glo_skpd as b,bpaddtfake.dbo.glo_org_unitkerja as c,bpaddtfake.dbo.glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1' 
						and tbunit.kd_unit like '01%' and ked_emp = 'aktif' order by nm_emp") );
		$stafs = json_decode(json_encode($stafs), true);

		$jabatans = DB::select( DB::raw("SELECT TOP (1000) [sts]
													      ,[uname]
													      ,[tgl]
													      ,[ip]
													      ,[logbuat]
													      ,[kd_skpd]
													      ,[jns_jab]
													      ,[jabatan]
													      ,[disposisi]
													  FROM [bpaddtfake].[dbo].[glo_org_jabatan]
													  where disposisi = 'Y'
													  order by jabatan asc") );
		$jabatans = json_decode(json_encode($jabatans), true);

		$penanganans = Glo_disposisi_penanganan::
						orderBy('urut')
						->get();

		return view('pages.bpaddisposisi.disposisitambah')
				->with('maxnoform', $maxnoform)
				->with('kddispos', $kddispos)
				->with('stafs', $stafs)
				->with('unitkerjas', $unitkerjas)
				->with('jabatans', $jabatans)
				->with('penanganans', $penanganans);
	}

	public function disposisiubah(Request $request)
	{
		// if (file_exists("C:/xampp/htdocs/portal/public/publicfile/disp/1.20.512.20102228/disp19.pdf" )) {
		$dispmaster = DB::select( DB::raw("SELECT TOP (100) [ids]
												  ,[sts]
												  ,[uname]
												  ,[tgl]
												  ,[ip]
												  ,[logbuat]
												  ,[kd_skpd]
												  ,[kd_unit]
												  ,[no_form]
												  ,[kd_surat]
												  ,[status_surat]
												  ,[idtop]
												  ,[tgl_masuk]
												  ,[usr_input]
												  ,[tgl_input]
												  ,[no_index]
												  ,[kode_disposisi]
												  ,[perihal]
												  ,[tgl_surat]
												  ,[no_surat]
												  ,[asal_surat]
												  ,[kepada_surat]
												  ,[sifat1_surat]
												  ,[sifat2_surat]
												  ,[ket_lain]
												  ,[nm_file]
												  ,[kepada]
												  ,[noid]
												  ,[penanganan]
												  ,[catatan]
												  ,[from_user]
												  ,[from_pm]
												  ,[to_user]
												  ,[to_pm]
												  ,[rd]
												  ,[usr_rd]
												  ,[tgl_rd]
												  ,[selesai]
												  ,[child]
												  ,[penanganan_final]
												  ,[catatan_final]
												  FROM [bpaddtfake].[dbo].[fr_disposisi]
												  where no_form like '$request->no_form'
												  and sts = 1
												  order by tgl_masuk desc, no_form desc"))[0];
		$dispmaster = json_decode(json_encode($dispmaster), true);

		$treedisp = '<tr>
						<td>
							<span class="fa fa-book"></span> <span>'.$dispmaster['no_form'].'</span> <br>
							<span class="text-muted">Kode: '.$dispmaster['kode_disposisi'].'</span> | <span class="text-muted"> Nomor: '.$dispmaster['no_surat'].'</span><br>

						</td>
					</tr>';

		$treedisp .= $this->display_disposisi($request->no_form, $dispmaster['ids']);

		$kddispos = Glo_disposisi_kode::orderBy('kd_jnssurat')->get();

		$unitkerjas = DB::select( DB::raw("SELECT TOP (1000) [sts]
											  ,[uname]
											  ,[tgl]
											  ,[ip]
											  ,[logbuat]
											  ,[kd_skpd]
											  ,[kd_unit]
											  ,[nm_unit]
											  ,[cp_unit]
											  ,[notes]
											  ,[child]
											  ,[sao]
											  ,[tgl_unit]
										  FROM [bpaddtfake].[dbo].[glo_org_unitkerja]
										  order by kd_unit") );
		$unitkerjas = json_decode(json_encode($unitkerjas), true);

		// $stafs = DB::select( DB::raw("
		// 			SELECT id_emp,a.uname+'::'+convert(varchar,a.tgl)+'::'+a.ip,createdate,nip_emp,nrk_emp,nm_emp,nrk_emp+'-'+nm_emp as c2,gelar_dpn,gelar_blk,jnkel_emp,tempat_lahir,tgl_lahir,CONVERT(VARCHAR(10), tgl_lahir, 103) AS [DD/MM/YYYY],idagama,alamat_emp,tlp_emp,email_emp,status_emp,ked_emp,status_nikah,gol_darah,nm_bank,cb_bank,an_bank,nr_bank,no_taspen,npwp,no_askes,no_jamsos,tgl_join,CONVERT(VARCHAR(10), tgl_join, 103) AS [DD/MM/YYYY],tgl_end,reason,a.idgroup,pass_emp,foto,ttd,a.telegram_id,a.lastlogin,tbgol.tmt_gol,CONVERT(VARCHAR(10), tbgol.tmt_gol, 103) AS [DD/MM/YYYY],tbgol.tmt_sk_gol,CONVERT(VARCHAR(10), tbgol.tmt_sk_gol, 103) AS [DD/MM/YYYY],tbgol.no_sk_gol,tbgol.idgol,tbgol.jns_kp,tbgol.mk_thn,tbgol.mk_bln,tbgol.gambar,tbgol.nm_pangkat,tbjab.tmt_jab,CONVERT(VARCHAR(10), tbjab.tmt_jab, 103) AS [DD/MM/YYYY],tbjab.idskpd,tbjab.idunit,tbjab.idjab, tbunit.child, tbjab.idlok,tbjab.tmt_sk_jab,CONVERT(VARCHAR(10), tbjab.tmt_sk_jab, 103) AS [DD/MM/YYYY],tbjab.no_sk_jab,tbjab.jns_jab,tbjab.idjab,tbjab.eselon,tbjab.gambar,tbdik.iddik,tbdik.prog_sek,tbdik.no_sek,tbdik.th_sek,tbdik.nm_sek,tbdik.gelar_dpn_sek,tbdik.gelar_blk_sek,tbdik.ijz_cpns,tbdik.gambar,tbdik.nm_dik,b.nm_skpd,c.nm_unit,c.notes,d.nm_lok FROM bpaddtfake.dbo.emp_data as a
		// 				CROSS APPLY (SELECT TOP 1 tmt_gol,tmt_sk_gol,no_sk_gol,idgol,jns_kp,mk_thn,mk_bln,gambar,nm_pangkat FROM bpaddtfake.dbo.emp_gol,bpaddtfake.dbo.glo_org_golongan WHERE a.id_emp = emp_gol.noid AND emp_gol.idgol=glo_org_golongan.gol AND emp_gol.sts='1' AND glo_org_golongan.sts='1' ORDER BY tmt_gol DESC) tbgol
		// 				CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  bpaddtfake.dbo.emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
		// 				CROSS APPLY (SELECT TOP 1 iddik,prog_sek,no_sek,th_sek,nm_sek,gelar_dpn_sek,gelar_blk_sek,ijz_cpns,gambar,nm_dik FROM  bpaddtfake.dbo.emp_dik,bpaddtfake.dbo.glo_dik WHERE a.id_emp = emp_dik.noid AND emp_dik.iddik=glo_dik.dik AND emp_dik.sts='1' AND glo_dik.sts='1' ORDER BY th_sek DESC) tbdik
		// 				CROSS APPLY (SELECT TOP 1 * FROM bpaddtfake.dbo.glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
		// 				,bpaddtfake.dbo.glo_skpd as b,bpaddtfake.dbo.glo_org_unitkerja as c,bpaddtfake.dbo.glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1' 
		// 				and tbunit.kd_unit like '01%' and ked_emp = 'aktif' order by nm_emp") );
		// $stafs = json_decode(json_encode($stafs), true);

		$jabatans = DB::select( DB::raw("SELECT TOP (1000) [sts]
													      ,[uname]
													      ,[tgl]
													      ,[ip]
													      ,[logbuat]
													      ,[kd_skpd]
													      ,[jns_jab]
													      ,[jabatan]
													      ,[disposisi]
													  FROM [bpaddtfake].[dbo].[glo_org_jabatan]
													  where disposisi = 'Y'
													  order by jabatan asc") );
		$jabatans = json_decode(json_encode($jabatans), true);

		$penanganans = Glo_disposisi_penanganan::
						orderBy('urut')
						->get();

		return view('pages.bpaddisposisi.disposisiubah')
				->with('dispmaster', $dispmaster)
				->with('treedisp', $treedisp)
				->with('kepada', $dispmaster['kepada'])
				->with('kddispos', $kddispos)
				// ->with('stafs', $stafs)
				->with('unitkerjas', $unitkerjas)
				->with('jabatans', $jabatans)
				->with('penanganans', $penanganans);
	}

	public function display_disposisi($no_form, $idtop, $level = 0)
	{
		// $query = Fr_disposisi::
		// 			leftJoin('bpaddtfake.dbo.emp_data as emp1', 'emp1.id_emp', '=', 'bpaddtfake.dbo.fr_disposisi.to_pm')
		// 			->where('no_form', $no_form)
		// 			->where('idtop', $idtop)
		// 			->orderBy('ids')
		// 			->get();

		$query = DB::select( DB::raw("SELECT * 
					from bpaddtfake.dbo.fr_disposisi
					left join bpaddtfake.dbo.emp_data on bpaddtfake.dbo.emp_data.id_emp = bpaddtfake.dbo.fr_disposisi.to_pm
					where no_form = '$no_form'
					and idtop = '$idtop'
					order by ids
					") );
		$query = json_decode(json_encode($query), true);

		$result = '';

		if (count($query) > 0) {
			foreach ($query as $log) {
				$padding = ($level * 20);
				$result .= '<tr >
								<td style="padding-left:'.$padding.'px; padding-top:10px">
									<span class="fa fa-user"></span> <span>'.$log['nrk_emp'].' '.ucwords(strtolower($log['nm_emp'])).'</span> <br> 
									<span class="text-muted"> Penanganan: <b>'. ($log['penanganan_final'] ? $log['penanganan_final'] : ($log['penanganan_final'] ? $log['penanganan_final'] : $log['penanganan'] )) .'</b></span><br>
								</td>
							</tr>';

				if ($log['child'] == 1) {
					$result .= $this->display_disposisi($no_form, $log['ids'], $level+1);
				}
			}
		}
		return $result;
	}

	public function disposisihapusfile(Request $request)
	{

		if (file_exists("C:/xampp/htdocs/portal/public/publicfile/disp/" . $request->no_form . "/" . $request->nm_file )) {
			unlink(config('app.savefiledisposisi') . "/" . $request->no_form . "/" . $request->nm_file );
			$nmfilebefore = Fr_disposisi::where('ids', $request->ids)->get();
			$nmfilenew = '';
			
			$splitnmfile = explode("::", $nmfilebefore[0]['nm_file']);
			foreach ($splitnmfile as $key => $nm_file) {
				if ($nm_file != $request->nm_file) {
					if ($key != 0 && $nm_file != $request->nm_file) {
						$nmfilenew .= "::";
					}
					$nmfilenew .= $nm_file;
				}
			}

			Fr_disposisi::where('ids', $request->ids)
				->update([
					'nm_file' => $nmfilenew,
				]);

			return 0;
		} else {
			return 1;
		}
	}

	public function forminsertdisposisi(Request $request)
	{
		$this->checkSessionTime();

		if (isset($request->jabatans) && isset($request->stafs)) {
			return redirect('/disposisi/tambah disposisi')
					->with('message', 'Tidak boleh memilih jabatan & staf bersamaan')
					->with('msg_num', 2);
		}

		if (isset($request->btnDraft)) {
			$status_surat = 'd';
			$selesai = 'Y';
			$child = 0;
		} else {
			$status_surat = 's';
			if (isset($request->jabatans)) {
				$selesai = '';
				$child = 1;
			} elseif (isset($request->stafs)) {
				$selesai = '';
				$child = 1;
			} else {
				$selesai = 'Y';
				$child = 0;
			}
		}

		$ceknoform = Fr_disposisi::where('no_form', $request->newnoform)->count();
		if ($ceknoform != 0) {
			$maxnoform = Fr_disposisi::max('no_form');
			if (is_null($maxnoform)) {
				$maxnoform = '1.20.512.'.substr(date('Y'), -2).'100001';
			} else {
				$splitmaxform = explode(".", $maxnoform);
				$maxnoform = $splitmaxform[0] . '.' . $splitmaxform[1] . '.' . $splitmaxform[2] . '.' . substr(date('Y'), -2) . substr(($splitmaxform[3] + 1), -6);
			}
		} else {
			$maxnoform = $request->newnoform;
			$splitmaxform = explode(".", $maxnoform);
			$maxnoform = $splitmaxform[0] . '.' . $splitmaxform[1] . '.' . $splitmaxform[2] . '.' . substr(date('Y'), -2) . substr(($splitmaxform[3]), -6);
		}

		if (isset($request->nm_file)) {
			$file = $request->nm_file;
			if (count($file) == 1) {
				$filedispo = 'disp';

				if ($file[0]->getSize() > 52222222) {
					return redirect('/disposisi/tambah disposisi')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
				} 

				$filedispo .= ($splitmaxform[3]);
				$filedispo .= ".". $file[0]->getClientOriginalExtension();

				$tujuan_upload = config('app.savefiledisposisi');
				$tujuan_upload .= "\\" . $maxnoform;
				$file[0]->move($tujuan_upload, $filedispo);
			} else {
				$filedispo = '';
				foreach ($file as $key => $data) {
					$filenow = 'disp';

					if ($data->getSize() > 52222222) {
						return redirect('/disposisi/tambah disposisi')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
					} 

					$filenow .= $key;
					$filenow .= ($splitmaxform[3]);
					$filenow .= ".". $data->getClientOriginalExtension();

					$tujuan_upload = config('app.savefiledisposisi');
					$tujuan_upload .= "\\" . $maxnoform;
					$data->move($tujuan_upload, $filenow);

					if ($key != count($file) - 1) {
						$filedispo .= $filenow . "::";
					} else {
						$filedispo .= $filenow;
					}
				}
			}	
		} else {
			$filedispo = '';
		}


		// var_dump($request->all());
		// die();

		$kepada = '';
		if (isset($request->jabatans)) {
			for ($i=0; $i < count($request->jabatans); $i++) { 
				$kepada .= $request->jabatans[$i];
				if ($i != (count($request->jabatans) - 1)) {
					$kepada .= "::";
				}
			}
		}

		$insertsuratmaster = [
			'sts' => 1,
			'uname'     => (Auth::user()->usname ? Auth::user()->usname : Auth::user()->id_emp),
			'tgl'       => date('Y-m-d H:i:s'),
			'ip'        => '',
			'logbuat'   => '',
			'kd_skpd'	=> '1.20.512',
			'kd_unit'	=> $request->kd_unit,
			'no_form' => $maxnoform,
			'kd_surat' => $request->kd_surat,
			'status_surat' => $status_surat,
			'idtop' => 0,
			'tgl_masuk' => (isset($request->tgl_masuk) ? date('Y-m-d',strtotime(str_replace('/', '-', $request->tgl_masuk))) : date('Y-m-d')),
			'usr_input' => (isset(Auth::user()->usname) ? Auth::user()->usname : Auth::user()->id_emp),
			'tgl_input' => date('Y-m-d H:i:s'),
			'no_index' => (isset($request->no_index) ? $request->no_index : '' ),
			'kode_disposisi' => $request->kode_disposisi,
			'perihal' => (isset($request->perihal) ? $request->perihal : '' ),
			'tgl_surat' => (isset($request->tgl_surat) ? date('m-d-Y',strtotime($request->tgl_surat)) : null ),
			'no_surat' => (isset($request->no_surat) ? $request->no_surat : '' ),
			'asal_surat' => (isset($request->asal_surat) ? $request->asal_surat : '' ),
			'kepada_surat' => (isset($request->kepada_surat) ? $request->kepada_surat : '' ),
			'sifat1_surat' => (isset($request->sifat1_surat) ? $request->sifat1_surat : '' ),
			'sifat2_surat' => (isset($request->sifat2_surat) ? $request->sifat2_surat : '' ),
			'ket_lain' => (isset($request->ket_lain) ? $request->ket_lain : '' ),
			'nm_file' => $filedispo,
			'kepada' => $kepada,
			'noid' => '',
			'penanganan' => (isset($request->penanganan) ? $request->penanganan : '' ),
			'catatan' => (isset($request->catatan) ? $request->catatan : '' ),
			'from_user' => '',
			'from_pm' => '',
			'to_user' => '',
			'to_pm' => '',
			'rd' => '',
			'usr_rd' => null,
			'tgl_rd' => null,
			'selesai' => $selesai,
			'child' => $child,
		];

		Fr_disposisi::insert($insertsuratmaster);
		$idnew = Fr_disposisi::max('ids');

		if ($request->btnDraft) {
			return redirect('/disposisi/formdisposisi')
					->with('message', 'Disposisi berhasil dibuat')
					->with('msg_num', 1);
		}

		if ($request->btnKirim) {

			if (isset($request->jabatans)) {
				for ($i=0; $i < count($request->jabatans); $i++) { 
					$findidemp = DB::select( DB::raw("
							SELECT id_emp,a.uname+'::'+convert(varchar,a.tgl)+'::'+a.ip,createdate,nip_emp,nrk_emp,nm_emp,nrk_emp+'-'+nm_emp as c2,gelar_dpn,gelar_blk,jnkel_emp,tempat_lahir,tgl_lahir,CONVERT(VARCHAR(10), tgl_lahir, 103) AS [DD/MM/YYYY],idagama,alamat_emp,tlp_emp,email_emp,status_emp,ked_emp,status_nikah,gol_darah,nm_bank,cb_bank,an_bank,nr_bank,no_taspen,npwp,no_askes,no_jamsos,tgl_join,CONVERT(VARCHAR(10), tgl_join, 103) AS [DD/MM/YYYY],tgl_end,reason,a.idgroup,pass_emp,foto,ttd,a.telegram_id,a.lastlogin,tbgol.tmt_gol,CONVERT(VARCHAR(10), tbgol.tmt_gol, 103) AS [DD/MM/YYYY],tbgol.tmt_sk_gol,CONVERT(VARCHAR(10), tbgol.tmt_sk_gol, 103) AS [DD/MM/YYYY],tbgol.no_sk_gol,tbgol.idgol,tbgol.jns_kp,tbgol.mk_thn,tbgol.mk_bln,tbgol.gambar,tbgol.nm_pangkat,tbjab.tmt_jab,CONVERT(VARCHAR(10), tbjab.tmt_jab, 103) AS [DD/MM/YYYY],tbjab.idskpd,tbjab.idunit,tbjab.idjab, tbunit.child, tbjab.idlok,tbjab.tmt_sk_jab,CONVERT(VARCHAR(10), tbjab.tmt_sk_jab, 103) AS [DD/MM/YYYY],tbjab.no_sk_jab,tbjab.jns_jab,tbjab.idjab,tbjab.eselon,tbjab.gambar,tbdik.iddik,tbdik.prog_sek,tbdik.no_sek,tbdik.th_sek,tbdik.nm_sek,tbdik.gelar_dpn_sek,tbdik.gelar_blk_sek,tbdik.ijz_cpns,tbdik.gambar,tbdik.nm_dik,b.nm_skpd,c.nm_unit,c.notes,d.nm_lok FROM bpaddtfake.dbo.emp_data as a
								CROSS APPLY (SELECT TOP 1 tmt_gol,tmt_sk_gol,no_sk_gol,idgol,jns_kp,mk_thn,mk_bln,gambar,nm_pangkat FROM  bpaddtfake.dbo.emp_gol,bpaddtfake.dbo.glo_org_golongan WHERE a.id_emp = emp_gol.noid AND emp_gol.idgol=glo_org_golongan.gol AND emp_gol.sts='1' AND glo_org_golongan.sts='1' ORDER BY tmt_gol DESC) tbgol
								CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  bpaddtfake.dbo.emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
								CROSS APPLY (SELECT TOP 1 iddik,prog_sek,no_sek,th_sek,nm_sek,gelar_dpn_sek,gelar_blk_sek,ijz_cpns,gambar,nm_dik FROM  bpaddtfake.dbo.emp_dik,bpaddtfake.dbo.glo_dik WHERE a.id_emp = emp_dik.noid AND emp_dik.iddik=glo_dik.dik AND emp_dik.sts='1' AND glo_dik.sts='1' ORDER BY th_sek DESC) tbdik
								CROSS APPLY (SELECT TOP 1 * FROM bpaddtfake.dbo.glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
								,bpaddtfake.dbo.glo_skpd as b,bpaddtfake.dbo.glo_org_unitkerja as c,bpaddtfake.dbo.glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1' 
								and tbjab.idjab like '".$request->jabatans[$i]."' and ked_emp = 'aktif'") )[0];
					$findidemp = json_decode(json_encode($findidemp), true);

					$insertsurat = [
						'sts' => 1,
						'uname'     => (Auth::user()->usname ? Auth::user()->usname : Auth::user()->id_emp),
						'tgl'       => date('Y-m-d H:i:s'),
						'ip'        => '',
						'logbuat'   => '',
						'kd_skpd'	=> '1.20.512',
						'kd_unit'	=> $request->kd_unit,
						'no_form' => $maxnoform,
						'kd_surat' => null,
						'status_surat' => null,
						'idtop' => $idnew,
						'tgl_masuk' => (isset($request->tgl_masuk) ? date('Y-m-d',strtotime(str_replace('/', '-', $request->tgl_masuk))) : date('Y-m-d')),
						'usr_input' => '',
						'tgl_input' => null,
						'no_index' => '',
						'kode_disposisi' => '',
						'perihal' => '',
						'tgl_surat' => null,
						'no_surat' => '',
						'asal_surat' => '',
						'kepada_surat' => '',
						'sifat1_surat' => '',
						'sifat2_surat' => '',
						'ket_lain' => '',
						'nm_file' => '',
						'kepada' => ($request->jabatans[0] ? $request->jabatans[0] : ''),
						'noid' => '',
						'penanganan' => '',
						'catatan' => '',
						'from_user' => (Auth::user()->usname ? 'A' : 'E'),
						'from_pm' => (isset(Auth::user()->usname) ? Auth::user()->usname : Auth::user()->id_emp),
						'to_user' => 'E',
						'to_pm' => $findidemp['id_emp'],
						'rd' => 'N',
						'usr_rd' => null,
						'tgl_rd' => null,
						'selesai' => '',
						'child' => 0,
					];
					Fr_disposisi::insert($insertsurat);
				}
					
			}

			if (isset($request->stafs)) {
				for ($i=0; $i < count($request->stafs); $i++) { 
					$findidemp = DB::select( DB::raw("
							SELECT id_emp,a.uname+'::'+convert(varchar,a.tgl)+'::'+a.ip,createdate,nip_emp,nrk_emp,nm_emp,nrk_emp+'-'+nm_emp as c2,gelar_dpn,gelar_blk,jnkel_emp,tempat_lahir,tgl_lahir,CONVERT(VARCHAR(10), tgl_lahir, 103) AS [DD/MM/YYYY],idagama,alamat_emp,tlp_emp,email_emp,status_emp,ked_emp,status_nikah,gol_darah,nm_bank,cb_bank,an_bank,nr_bank,no_taspen,npwp,no_askes,no_jamsos,tgl_join,CONVERT(VARCHAR(10), tgl_join, 103) AS [DD/MM/YYYY],tgl_end,reason,a.idgroup,pass_emp,foto,ttd,a.telegram_id,a.lastlogin,tbgol.tmt_gol,CONVERT(VARCHAR(10), tbgol.tmt_gol, 103) AS [DD/MM/YYYY],tbgol.tmt_sk_gol,CONVERT(VARCHAR(10), tbgol.tmt_sk_gol, 103) AS [DD/MM/YYYY],tbgol.no_sk_gol,tbgol.idgol,tbgol.jns_kp,tbgol.mk_thn,tbgol.mk_bln,tbgol.gambar,tbgol.nm_pangkat,tbjab.tmt_jab,CONVERT(VARCHAR(10), tbjab.tmt_jab, 103) AS [DD/MM/YYYY],tbjab.idskpd,tbjab.idunit,tbjab.idjab, tbunit.child, tbjab.idlok,tbjab.tmt_sk_jab,CONVERT(VARCHAR(10), tbjab.tmt_sk_jab, 103) AS [DD/MM/YYYY],tbjab.no_sk_jab,tbjab.jns_jab,tbjab.idjab,tbjab.eselon,tbjab.gambar,tbdik.iddik,tbdik.prog_sek,tbdik.no_sek,tbdik.th_sek,tbdik.nm_sek,tbdik.gelar_dpn_sek,tbdik.gelar_blk_sek,tbdik.ijz_cpns,tbdik.gambar,tbdik.nm_dik,b.nm_skpd,c.nm_unit,c.notes,d.nm_lok FROM bpaddtfake.dbo.emp_data as a
								CROSS APPLY (SELECT TOP 1 tmt_gol,tmt_sk_gol,no_sk_gol,idgol,jns_kp,mk_thn,mk_bln,gambar,nm_pangkat FROM  bpaddtfake.dbo.emp_gol,bpaddtfake.dbo.glo_org_golongan WHERE a.id_emp = emp_gol.noid AND emp_gol.idgol=glo_org_golongan.gol AND emp_gol.sts='1' AND glo_org_golongan.sts='1' ORDER BY tmt_gol DESC) tbgol
								CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  bpaddtfake.dbo.emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
								CROSS APPLY (SELECT TOP 1 iddik,prog_sek,no_sek,th_sek,nm_sek,gelar_dpn_sek,gelar_blk_sek,ijz_cpns,gambar,nm_dik FROM  bpaddtfake.dbo.emp_dik,bpaddtfake.dbo.glo_dik WHERE a.id_emp = emp_dik.noid AND emp_dik.iddik=glo_dik.dik AND emp_dik.sts='1' AND glo_dik.sts='1' ORDER BY th_sek DESC) tbdik
								CROSS APPLY (SELECT TOP 1 * FROM bpaddtfake.dbo.glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
								,bpaddtfake.dbo.glo_skpd as b,bpaddtfake.dbo.glo_org_unitkerja as c,bpaddtfake.dbo.glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1' 
								and id_emp like '".$request->stafs[$i]."' and ked_emp = 'aktif'") )[0];
					$findidemp = json_decode(json_encode($findidemp), true);

					$insertsurat = [
						'sts' => 1,
						'uname'     => (Auth::user()->usname ? Auth::user()->usname : Auth::user()->id_emp),
						'tgl'       => date('Y-m-d H:i:s'),
						'ip'        => '',
						'logbuat'   => '',
						'kd_skpd'	=> '1.20.512',
						'kd_unit'	=> $request->kd_unit,
						'no_form' => $maxnoform,
						'kd_surat' => null,
						'status_surat' => null,
						'idtop' => $idnew,
						'tgl_masuk' => (isset($request->tgl_masuk) ? date('Y-m-d',strtotime(str_replace('/', '-', $request->tgl_masuk))) : date('Y-m-d')),
						'usr_input' => '',
						'tgl_input' => null,
						'no_index' => '',
						'kode_disposisi' => '',
						'perihal' => '',
						'tgl_surat' => null,
						'no_surat' => '',
						'asal_surat' => '',
						'kepada_surat' => '',
						'sifat1_surat' => '',
						'sifat2_surat' => '',
						'ket_lain' => '',
						'nm_file' => '',
						'kepada' => ($request->jabatans[0] ? $request->jabatans[0] : ''),
						'noid' => '',
						'penanganan' => '',
						'catatan' => '',
						'from_user' => (Auth::user()->usname ? 'A' : 'E'),
						'from_pm' => (isset(Auth::user()->usname) ? Auth::user()->usname : Auth::user()->id_emp),
						'to_user' => 'E',
						'to_pm' => $findidemp['id_emp'],
						'rd' => 'N',
						'usr_rd' => null,
						'tgl_rd' => null,
						'selesai' => '',
						'child' => 0,
					];
					Fr_disposisi::insert($insertsurat);
				}
			}
		}

		return redirect('/disposisi/formdisposisi')
					->with('message', 'Disposisi berhasil dibuat')
					->with('msg_num', 1);
	}

	public function formupdatedisposisi(Request $request)
	{
		$this->checkSessionTime();

		if (isset($request->jabatans) && isset($request->stafs)) {
			return redirect('/disposisi/tambah disposisi')
					->with('message', 'Tidak boleh memilih jabatan & staf bersamaan')
					->with('msg_num', 2);
		}

		if (isset($request->btnDraft)) {
			$status_surat = 'd';
			$selesai = 'Y';
			$child = 0;
		} else {
			$status_surat = 's';
			if (isset($request->jabatans)) {
				$selesai = '';
				$child = 1;
			} elseif (isset($request->stafs)) {
				$selesai = '';
				$child = 1;
			} else {
				$selesai = 'Y';
				$child = 0;
			}
		}

		$ceknoform = Fr_disposisi::where('no_form', $request->newnoform)->count();
		if ($ceknoform != 0) {
			$maxnoform = Fr_disposisi::max('no_form');
			if (is_null($maxnoform)) {
				$maxnoform = '1.20.512.'.substr(date('Y'), -2).'100001';
			} else {
				$splitmaxform = explode(".", $maxnoform);
				$maxnoform = $splitmaxform[0] . '.' . $splitmaxform[1] . '.' . $splitmaxform[2] . '.' . substr(date('Y'), -2) . substr(($splitmaxform[3] + 1), -6);
			}
		} else {
			$maxnoform = $request->newnoform;
			$splitmaxform = explode(".", $maxnoform);
			$maxnoform = $splitmaxform[0] . '.' . $splitmaxform[1] . '.' . $splitmaxform[2] . '.' . substr(date('Y'), -2) . substr(($splitmaxform[3]), -6);
		}
		

		if (isset($request->nm_file)) {
			$file = $request->nm_file;
			if (count($file) == 1) {
				$filedispo = 'disp';

				if ($file[0]->getSize() > 52222222) {
					return redirect('/disposisi/tambah disposisi')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
				} 

				$filedispo .= ($splitmaxform[3]);
				$filedispo .= ".". $file[0]->getClientOriginalExtension();

				$tujuan_upload = config('app.savefiledisposisi');
				$tujuan_upload .= "\\" . $maxnoform;
				$file[0]->move($tujuan_upload, $filedispo);
			} else {
				$filedispo = '';
				foreach ($file as $key => $data) {
					$filenow = 'disp';

					if ($data->getSize() > 52222222) {
						return redirect('/disposisi/tambah disposisi')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
					} 

					$filenow .= $key;
					$filenow .= ($splitmaxform[3]);
					$filenow .= ".". $data->getClientOriginalExtension();

					$tujuan_upload = config('app.savefiledisposisi');
					$tujuan_upload .= "\\" . $maxnoform;
					$data->move($tujuan_upload, $filenow);

					if ($key != count($file) - 1) {
						$filedispo .= $filenow . "::";
					} else {
						$filedispo .= $filenow;
					}
				}
			}	
		} else {
			$filedispo = '';
		}


		// var_dump($request->all());
		// die();

		$kepada = '';
		if (isset($request->jabatans)) {
			for ($i=0; $i < count($request->jabatans); $i++) { 
				$kepada .= $request->jabatans[$i];
				if ($i != (count($request->jabatans) - 1)) {
					$kepada .= "::";
				}
			}
		}

		$insertsuratmaster = [
			'sts' => 1,
			'uname'     => (Auth::user()->usname ? Auth::user()->usname : Auth::user()->id_emp),
			'tgl'       => date('Y-m-d H:i:s'),
			'ip'        => '',
			'logbuat'   => '',
			'kd_skpd'	=> '1.20.512',
			'kd_unit'	=> $request->kd_unit,
			'no_form' => $maxnoform,
			'kd_surat' => $request->kd_surat,
			'status_surat' => $status_surat,
			'idtop' => 0,
			'tgl_masuk' => (isset($request->tgl_masuk) ? date('Y-m-d',strtotime(str_replace('/', '-', $request->tgl_masuk))) : date('Y-m-d')),
			'usr_input' => (isset(Auth::user()->usname) ? Auth::user()->usname : Auth::user()->id_emp),
			'tgl_input' => date('Y-m-d H:i:s'),
			'no_index' => (isset($request->no_index) ? $request->no_index : '' ),
			'kode_disposisi' => $request->kode_disposisi,
			'perihal' => (isset($request->perihal) ? $request->perihal : '' ),
			'tgl_surat' => (isset($request->tgl_surat) ? date('m-d-Y',strtotime($request->tgl_surat)) : null ),
			'no_surat' => (isset($request->no_surat) ? $request->no_surat : '' ),
			'asal_surat' => (isset($request->asal_surat) ? $request->asal_surat : '' ),
			'kepada_surat' => (isset($request->kepada_surat) ? $request->kepada_surat : '' ),
			'sifat1_surat' => (isset($request->sifat1_surat) ? $request->sifat1_surat : '' ),
			'sifat2_surat' => (isset($request->sifat2_surat) ? $request->sifat2_surat : '' ),
			'ket_lain' => (isset($request->ket_lain) ? $request->ket_lain : '' ),
			'nm_file' => $filedispo,
			'kepada' => $kepada,
			'noid' => '',
			'penanganan' => (isset($request->penanganan) ? $request->penanganan : '' ),
			'catatan' => (isset($request->catatan) ? $request->catatan : '' ),
			'from_user' => '',
			'from_pm' => '',
			'to_user' => '',
			'to_pm' => '',
			'rd' => '',
			'usr_rd' => null,
			'tgl_rd' => null,
			'selesai' => $selesai,
			'child' => $child,
		];

		Fr_disposisi::insert($insertsuratmaster);
		$idnew = Fr_disposisi::max('ids');

		if ($request->btnDraft) {
			return redirect('/disposisi/formdisposisi')
					->with('message', 'Disposisi berhasil dibuat')
					->with('msg_num', 1);
		}

		if ($request->btnKirim) {

			if (isset($request->jabatans)) {
				for ($i=0; $i < count($request->jabatans); $i++) { 
					$findidemp = DB::select( DB::raw("
							SELECT id_emp,a.uname+'::'+convert(varchar,a.tgl)+'::'+a.ip,createdate,nip_emp,nrk_emp,nm_emp,nrk_emp+'-'+nm_emp as c2,gelar_dpn,gelar_blk,jnkel_emp,tempat_lahir,tgl_lahir,CONVERT(VARCHAR(10), tgl_lahir, 103) AS [DD/MM/YYYY],idagama,alamat_emp,tlp_emp,email_emp,status_emp,ked_emp,status_nikah,gol_darah,nm_bank,cb_bank,an_bank,nr_bank,no_taspen,npwp,no_askes,no_jamsos,tgl_join,CONVERT(VARCHAR(10), tgl_join, 103) AS [DD/MM/YYYY],tgl_end,reason,a.idgroup,pass_emp,foto,ttd,a.telegram_id,a.lastlogin,tbgol.tmt_gol,CONVERT(VARCHAR(10), tbgol.tmt_gol, 103) AS [DD/MM/YYYY],tbgol.tmt_sk_gol,CONVERT(VARCHAR(10), tbgol.tmt_sk_gol, 103) AS [DD/MM/YYYY],tbgol.no_sk_gol,tbgol.idgol,tbgol.jns_kp,tbgol.mk_thn,tbgol.mk_bln,tbgol.gambar,tbgol.nm_pangkat,tbjab.tmt_jab,CONVERT(VARCHAR(10), tbjab.tmt_jab, 103) AS [DD/MM/YYYY],tbjab.idskpd,tbjab.idunit,tbjab.idjab, tbunit.child, tbjab.idlok,tbjab.tmt_sk_jab,CONVERT(VARCHAR(10), tbjab.tmt_sk_jab, 103) AS [DD/MM/YYYY],tbjab.no_sk_jab,tbjab.jns_jab,tbjab.idjab,tbjab.eselon,tbjab.gambar,tbdik.iddik,tbdik.prog_sek,tbdik.no_sek,tbdik.th_sek,tbdik.nm_sek,tbdik.gelar_dpn_sek,tbdik.gelar_blk_sek,tbdik.ijz_cpns,tbdik.gambar,tbdik.nm_dik,b.nm_skpd,c.nm_unit,c.notes,d.nm_lok FROM bpaddtfake.dbo.emp_data as a
								CROSS APPLY (SELECT TOP 1 tmt_gol,tmt_sk_gol,no_sk_gol,idgol,jns_kp,mk_thn,mk_bln,gambar,nm_pangkat FROM  bpaddtfake.dbo.emp_gol,bpaddtfake.dbo.glo_org_golongan WHERE a.id_emp = emp_gol.noid AND emp_gol.idgol=glo_org_golongan.gol AND emp_gol.sts='1' AND glo_org_golongan.sts='1' ORDER BY tmt_gol DESC) tbgol
								CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  bpaddtfake.dbo.emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
								CROSS APPLY (SELECT TOP 1 iddik,prog_sek,no_sek,th_sek,nm_sek,gelar_dpn_sek,gelar_blk_sek,ijz_cpns,gambar,nm_dik FROM  bpaddtfake.dbo.emp_dik,bpaddtfake.dbo.glo_dik WHERE a.id_emp = emp_dik.noid AND emp_dik.iddik=glo_dik.dik AND emp_dik.sts='1' AND glo_dik.sts='1' ORDER BY th_sek DESC) tbdik
								CROSS APPLY (SELECT TOP 1 * FROM bpaddtfake.dbo.glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
								,bpaddtfake.dbo.glo_skpd as b,bpaddtfake.dbo.glo_org_unitkerja as c,bpaddtfake.dbo.glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1' 
								and tbjab.idjab like '".$request->jabatans[$i]."' and ked_emp = 'aktif'") )[0];
					$findidemp = json_decode(json_encode($findidemp), true);

					$insertsurat = [
						'sts' => 1,
						'uname'     => (Auth::user()->usname ? Auth::user()->usname : Auth::user()->id_emp),
						'tgl'       => date('Y-m-d H:i:s'),
						'ip'        => '',
						'logbuat'   => '',
						'kd_skpd'	=> '1.20.512',
						'kd_unit'	=> $request->kd_unit,
						'no_form' => $maxnoform,
						'kd_surat' => null,
						'status_surat' => null,
						'idtop' => $idnew,
						'tgl_masuk' => (isset($request->tgl_masuk) ? date('Y-m-d',strtotime(str_replace('/', '-', $request->tgl_masuk))) : date('Y-m-d')),
						'usr_input' => '',
						'tgl_input' => null,
						'no_index' => '',
						'kode_disposisi' => '',
						'perihal' => '',
						'tgl_surat' => null,
						'no_surat' => '',
						'asal_surat' => '',
						'kepada_surat' => '',
						'sifat1_surat' => '',
						'sifat2_surat' => '',
						'ket_lain' => '',
						'nm_file' => '',
						'kepada' => ($request->jabatans[0] ? $request->jabatans[0] : ''),
						'noid' => '',
						'penanganan' => '',
						'catatan' => '',
						'from_user' => (Auth::user()->usname ? 'A' : 'E'),
						'from_pm' => (isset(Auth::user()->usname) ? Auth::user()->usname : Auth::user()->id_emp),
						'to_user' => 'E',
						'to_pm' => $findidemp['id_emp'],
						'rd' => 'N',
						'usr_rd' => null,
						'tgl_rd' => null,
						'selesai' => '',
						'child' => 0,
					];
					Fr_disposisi::insert($insertsurat);
				}
					
			}

			if (isset($request->stafs)) {
				for ($i=0; $i < count($request->stafs); $i++) { 
					$findidemp = DB::select( DB::raw("
							SELECT id_emp,a.uname+'::'+convert(varchar,a.tgl)+'::'+a.ip,createdate,nip_emp,nrk_emp,nm_emp,nrk_emp+'-'+nm_emp as c2,gelar_dpn,gelar_blk,jnkel_emp,tempat_lahir,tgl_lahir,CONVERT(VARCHAR(10), tgl_lahir, 103) AS [DD/MM/YYYY],idagama,alamat_emp,tlp_emp,email_emp,status_emp,ked_emp,status_nikah,gol_darah,nm_bank,cb_bank,an_bank,nr_bank,no_taspen,npwp,no_askes,no_jamsos,tgl_join,CONVERT(VARCHAR(10), tgl_join, 103) AS [DD/MM/YYYY],tgl_end,reason,a.idgroup,pass_emp,foto,ttd,a.telegram_id,a.lastlogin,tbgol.tmt_gol,CONVERT(VARCHAR(10), tbgol.tmt_gol, 103) AS [DD/MM/YYYY],tbgol.tmt_sk_gol,CONVERT(VARCHAR(10), tbgol.tmt_sk_gol, 103) AS [DD/MM/YYYY],tbgol.no_sk_gol,tbgol.idgol,tbgol.jns_kp,tbgol.mk_thn,tbgol.mk_bln,tbgol.gambar,tbgol.nm_pangkat,tbjab.tmt_jab,CONVERT(VARCHAR(10), tbjab.tmt_jab, 103) AS [DD/MM/YYYY],tbjab.idskpd,tbjab.idunit,tbjab.idjab, tbunit.child, tbjab.idlok,tbjab.tmt_sk_jab,CONVERT(VARCHAR(10), tbjab.tmt_sk_jab, 103) AS [DD/MM/YYYY],tbjab.no_sk_jab,tbjab.jns_jab,tbjab.idjab,tbjab.eselon,tbjab.gambar,tbdik.iddik,tbdik.prog_sek,tbdik.no_sek,tbdik.th_sek,tbdik.nm_sek,tbdik.gelar_dpn_sek,tbdik.gelar_blk_sek,tbdik.ijz_cpns,tbdik.gambar,tbdik.nm_dik,b.nm_skpd,c.nm_unit,c.notes,d.nm_lok FROM bpaddtfake.dbo.emp_data as a
								CROSS APPLY (SELECT TOP 1 tmt_gol,tmt_sk_gol,no_sk_gol,idgol,jns_kp,mk_thn,mk_bln,gambar,nm_pangkat FROM  bpaddtfake.dbo.emp_gol,bpaddtfake.dbo.glo_org_golongan WHERE a.id_emp = emp_gol.noid AND emp_gol.idgol=glo_org_golongan.gol AND emp_gol.sts='1' AND glo_org_golongan.sts='1' ORDER BY tmt_gol DESC) tbgol
								CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  bpaddtfake.dbo.emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
								CROSS APPLY (SELECT TOP 1 iddik,prog_sek,no_sek,th_sek,nm_sek,gelar_dpn_sek,gelar_blk_sek,ijz_cpns,gambar,nm_dik FROM  bpaddtfake.dbo.emp_dik,bpaddtfake.dbo.glo_dik WHERE a.id_emp = emp_dik.noid AND emp_dik.iddik=glo_dik.dik AND emp_dik.sts='1' AND glo_dik.sts='1' ORDER BY th_sek DESC) tbdik
								CROSS APPLY (SELECT TOP 1 * FROM bpaddtfake.dbo.glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
								,bpaddtfake.dbo.glo_skpd as b,bpaddtfake.dbo.glo_org_unitkerja as c,bpaddtfake.dbo.glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1' 
								and id_emp like '".$request->stafs[$i]."' and ked_emp = 'aktif'") )[0];
					$findidemp = json_decode(json_encode($findidemp), true);

					$insertsurat = [
						'sts' => 1,
						'uname'     => (Auth::user()->usname ? Auth::user()->usname : Auth::user()->id_emp),
						'tgl'       => date('Y-m-d H:i:s'),
						'ip'        => '',
						'logbuat'   => '',
						'kd_skpd'	=> '1.20.512',
						'kd_unit'	=> $request->kd_unit,
						'no_form' => $maxnoform,
						'kd_surat' => null,
						'status_surat' => null,
						'idtop' => $idnew,
						'tgl_masuk' => (isset($request->tgl_masuk) ? date('Y-m-d',strtotime(str_replace('/', '-', $request->tgl_masuk))) : date('Y-m-d')),
						'usr_input' => '',
						'tgl_input' => null,
						'no_index' => '',
						'kode_disposisi' => '',
						'perihal' => '',
						'tgl_surat' => null,
						'no_surat' => '',
						'asal_surat' => '',
						'kepada_surat' => '',
						'sifat1_surat' => '',
						'sifat2_surat' => '',
						'ket_lain' => '',
						'nm_file' => '',
						'kepada' => ($request->jabatans[0] ? $request->jabatans[0] : ''),
						'noid' => '',
						'penanganan' => '',
						'catatan' => '',
						'from_user' => (Auth::user()->usname ? 'A' : 'E'),
						'from_pm' => (isset(Auth::user()->usname) ? Auth::user()->usname : Auth::user()->id_emp),
						'to_user' => 'E',
						'to_pm' => $findidemp['id_emp'],
						'rd' => 'N',
						'usr_rd' => null,
						'tgl_rd' => null,
						'selesai' => '',
						'child' => 0,
					];
					Fr_disposisi::insert($insertsurat);
				}
			}
		}

		return redirect('/disposisi/formdisposisi')
					->with('message', 'Disposisi berhasil dibuat')
					->with('msg_num', 1);
	}
}
