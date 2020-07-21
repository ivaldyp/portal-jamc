<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;

use App\Book_ruang;
use App\Book_transact;
use App\Glo_org_lokasi;
use App\GLo_org_unitkerja;
use App\Sec_menu;

session_start();

class BookingController extends Controller
{
    use SessionCheckTraits;

	public function __construct()
	{
		$this->middleware('auth');
		set_time_limit(300);
	}

	public function manageruang(Request $request)
	{
		$this->checkSessionTime();

		$currentpath = str_replace("%20", " ", $_SERVER['REQUEST_URI']);
		$currentpath = explode("?", $currentpath)[0];
		$thismenu = Sec_menu::where('urlnew', $currentpath)->first('ids');
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], $thismenu['ids']);

		$lokasis = Glo_org_lokasi::
						orderBy('kd_lok')
						->get();

		$units = GLo_org_unitkerja::
						whereRaw('LEN(kd_unit) = 6')
						->orderBy('kd_unit')
						->get();

		$ruangs = Book_ruang::
					where('sts', 1)
					->orderBy('kd_unit')
					->orderBy('nm_ruang')
					->get();
		
		return view('pages.bpadbooking.manageruang')
				->with('access', $access)
				->with('lokasis', $lokasis)
				->with('ruangs', $ruangs)
				->with('units', $units);
	}

	public function forminsertruang(Request $request)
	{

		$splitunit = explode("::", $request->unit);
		$kd_unit = $splitunit[0];
		$unit = $splitunit[1];

		$splitlokasi = explode("::", $request->lokasi);
		$kd_lokasi = $splitlokasi[0];
		$lokasi = $splitlokasi[1];

		$insertruang = [
			'sts' => 1,
			'uname'     => (Auth::user()->usname ? Auth::user()->usname : Auth::user()->id_emp),
			'tgl'       => date('Y-m-d H:i:s'),
			'nm_ruang' => ($request->nm_ruang ? $request->nm_ruang : ''),
			'kd_lokasi' => $kd_lokasi,
			'lokasi' => $lokasi,
			'kd_unit' => $kd_unit,
			'unit' => $unit,
			'lantai' => ($request->lantai ? $request->lantai : ''),
			'jumlah' => ($request->jumlah ? $request->jumlah : ''),
		];

		Book_ruang::insert($insertruang);

		return redirect('/booking/manageruang')
				->with('message', 'Ruang berhasil dibuat')
				->with('msg_num', 1);

	}

	public function formupdateruang(Request $request)
	{

		$splitunit = explode("::", $request->unit);
		$kd_unit = $splitunit[0];
		$unit = $splitunit[1];

		$splitlokasi = explode("::", $request->lokasi);
		$kd_lokasi = $splitlokasi[0];
		$lokasi = $splitlokasi[1];

		Book_ruang::where('ids', $request->ids)
			->update([
				'nm_ruang' => ($request->nm_ruang ? $request->nm_ruang : ''),
				'kd_lokasi' => $kd_lokasi,
				'lokasi' => $lokasi,
				'kd_unit' => $kd_unit,
				'unit' => $unit,
				'lantai' => ($request->lantai ? $request->lantai : ''),
				'jumlah' => ($request->jumlah ? $request->jumlah : ''),
			]);

		return redirect('/booking/manageruang')
				->with('message', 'Ruang berhasil diubah')
				->with('msg_num', 1);

	}

	public function formdeleteruang(Request $request)
	{

		Book_ruang::where('ids', $request->ids)
			->update([
				'sts' => 0,
			]);

		return redirect('/booking/manageruang')
				->with('message', 'Ruang berhasil dihapus')
				->with('msg_num', 1);
	}

	public function formpinjam(Request $request)
	{
		$this->checkSessionTime();

		$currentpath = str_replace("%20", " ", $_SERVER['REQUEST_URI']);
		$currentpath = explode("?", $currentpath)[0];
		$thismenu = Sec_menu::where('urlnew', $currentpath)->first('ids');
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], $thismenu['ids']);

		$ruangs = Book_ruang::
					where('sts', 1)
					->orderBy('kd_unit')
					->orderBy('nm_ruang')
					->get();

		$units = GLo_org_unitkerja::
						whereRaw('LEN(kd_unit) = 6')
						->orderBy('kd_unit')
						->get();
		
		return view('pages.bpadbooking.formpinjam')
				->with('access', $access)
				->with('ruangs', $ruangs)
				->with('units', $units);
	}

	public function forminsertpinjam(Request $request)
	{
		$tgl_pinjam = date('Y-m-d',strtotime(str_replace('/', '-', $request->tgl_pinjam)));
		$jam_mulai = $request->time1;
		$jam_selesai = $request->time2;

		$findbooking = DB::select( DB::raw("
							SELECT ids
							FROM bpaddtfake.dbo.book_transact
							WHERE ruang = '$request->ruang'
							and tgl_pinjam = '$tgl_pinjam'
							and (jam_mulai <= '$jam_mulai' 
							and jam_selesai > '$jam_mulai')
						") );
		$findbooking = json_decode(json_encode($findbooking), true);

		if (count($findbooking) > 0) {
			return redirect('/booking/pinjam')
					->with('message', 'Jadwal yang dipilih telah terisi')
					->with('msg_num', 2);
		} 

		$filebook = '';

		if (isset($request->nm_file)) {
			$file = $request->nm_file;

			if ($file->getSize() > 5500000) {
				return redirect('/booking/pinjam')->with('message', 'Ukuran file terlalu besar (Maksimal 5MB)');     
			} 

			$filebook .= $file->getClientOriginalName();

			$tujuan_upload = config('app.savefilebooking');
			$tujuan_upload .= "\\" . $request->ruang . explode(":", $jam_mulai)[0] . date('dmY',strtotime($tgl_pinjam)); 
			$file->move($tujuan_upload, $filebook);
		}
			
		if (!(isset($request->nm_file))) {
			$filebook = '';
		}

		$splitunit = explode("::", $request->unit);
		$kd_unit = $splitunit[0];
		$unit = $splitunit[1];

		if (strpos($_SESSION['user_data']['idunit'], $kd_unit) == true) {
			$status = 'S';
			$appr_usr = Auth::user()->id_emp;
			$appr_time = date('Y-m-d H:i:s');
		} else {
			$status = 'Y';
			$appr_usr = '';
			$appr_time = null;
		}

		$insertpinjam = [
			'sts' => 1,
			'uname'     => (Auth::user()->usname ? Auth::user()->usname : Auth::user()->id_emp),
			'tgl'       => date('Y-m-d H:i:s'),
			'nm_emp'	=> $request->nm_emp,
			'id_emp'	=> $request->id_emp,
			'unit_emp' => $kd_unit,
			'nmunit_emp' => $unit,
			'tujuan'	=> ($request->tujuan ? $request->tujuan : ''),
			'peserta'	=> ($request->peserta ? $request->peserta : ''),
			'ruang'		=> $request->ruang,
			'tgl_pinjam' => date('Y-m-d',strtotime(str_replace('/', '-', $request->tgl_pinjam))),
			'jam_mulai'	=> $request->time1,
			'jam_selesai' => $request->time2,
			'nm_file'	=> $filebook,
			'status'	=> $status,
			'appr_time' => $appr_time,
			'appr_usr' 	=> $appr_usr,
		];

		Book_transact::insert($insertpinjam);

		return redirect('/booking/listpinjam')
				->with('message', 'Pinjaman baru berhasil dibuat')
				->with('msg_num', 1);
	}

	public function listpinjam(Request $request)
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
			$qsearchnow = "and tujuan = '".$request->searchnow."'";
		} else {
			$qsearchnow = "";
		}

		$bookingyes = DB::select( DB::raw("
							SELECT TOP (1000) [ids]
							      ,[sts]
							      ,[uname]
							      ,[tgl]
							      ,[nm_emp]
							      ,[id_emp]
							      ,[unit_emp]
							      ,[nmunit_emp]
							      ,[tujuan]
							      ,[peserta]
							      ,[ruang]
							      ,[tgl_pinjam]
							      ,[jam_mulai]
							      ,[jam_selesai]
							      ,[nm_file]
							      ,[status]
							      ,[alasan_tolak]
							      ,[appr_usr]
							      ,[appr_time]
						  	FROM [bpaddtfake].[dbo].[book_transact]
						  	where status = 'S'
						  		$qsearchnow
						  		and month(tgl_pinjam) $signnow $monthnow
								and year(tgl_pinjam) = $yearnow
								and sts = 1
						") );

		$bookingno = DB::select( DB::raw("
							SELECT TOP (1000) [ids]
							      ,[sts]
							      ,[uname]
							      ,[tgl]
							      ,[nm_emp]
							      ,[id_emp]
							      ,[unit_emp]
							      ,[nmunit_emp]
							      ,[tujuan]
							      ,[peserta]
							      ,[ruang]
							      ,[tgl_pinjam]
							      ,[jam_mulai]
							      ,[jam_selesai]
							      ,[nm_file]
							      ,[status]
							      ,[alasan_tolak]
							      ,[appr_usr]
							      ,[appr_time]
						  	FROM [bpaddtfake].[dbo].[book_transact]
						  	where status = 'N'
						  		$qsearchnow
						  		and month(tgl_pinjam) $signnow $monthnow
								and year(tgl_pinjam) = $yearnow
								and sts = 1
						") );
		$bookingwait = DB::select( DB::raw("
							SELECT TOP (1000) [ids]
							      ,[sts]
							      ,[uname]
							      ,[tgl]
							      ,[nm_emp]
							      ,[id_emp]
							      ,[unit_emp]
							      ,[nmunit_emp]
							      ,[tujuan]
							      ,[peserta]
							      ,[ruang]
							      ,[tgl_pinjam]
							      ,[jam_mulai]
							      ,[jam_selesai]
							      ,[nm_file]
							      ,[status]
							      ,[alasan_tolak]
							      ,[appr_usr]
							      ,[appr_time]
						  	FROM [bpaddtfake].[dbo].[book_transact]
						  	where status = 'Y'
						  		$qsearchnow
						  		and month(tgl_pinjam) $signnow $monthnow
								and year(tgl_pinjam) = $yearnow
								and sts = 1
						") );



		if (Auth::user()->id_emp) {
			$user_data = DB::select( DB::raw("
						SELECT id_emp,a.uname+'::'+convert(varchar,a.tgl)+'::'+a.ip,createdate,nip_emp,nrk_emp,nm_emp,nrk_emp+'-'+nm_emp as c2,gelar_dpn,gelar_blk,jnkel_emp,tempat_lahir,tgl_lahir,CONVERT(VARCHAR(10), tgl_lahir, 103) AS [DD/MM/YYYY],idagama,alamat_emp,tlp_emp,email_emp,status_emp,ked_emp,status_nikah,gol_darah,nm_bank,cb_bank,an_bank,nr_bank,no_taspen,npwp,no_askes,no_jamsos,tgl_join,CONVERT(VARCHAR(10), tgl_join, 103) AS [DD/MM/YYYY],tgl_end,reason,a.idgroup,pass_emp,foto,ttd,a.telegram_id,a.lastlogin,tbgol.tmt_gol,CONVERT(VARCHAR(10), tbgol.tmt_gol, 103) AS [DD/MM/YYYY],tbgol.tmt_sk_gol,CONVERT(VARCHAR(10), tbgol.tmt_sk_gol, 103) AS [DD/MM/YYYY],tbgol.no_sk_gol,tbgol.idgol,tbgol.jns_kp,tbgol.mk_thn,tbgol.mk_bln,tbgol.gambar,tbgol.nm_pangkat,tbjab.tmt_jab,CONVERT(VARCHAR(10), tbjab.tmt_jab, 103) AS [DD/MM/YYYY],tbjab.idskpd,tbjab.idunit,tbjab.idjab, tbunit.child, tbjab.idlok,tbjab.tmt_sk_jab,CONVERT(VARCHAR(10), tbjab.tmt_sk_jab, 103) AS [DD/MM/YYYY],tbjab.no_sk_jab,tbjab.jns_jab,tbjab.idjab,tbjab.eselon,tbjab.gambar,tbdik.iddik,tbdik.prog_sek,tbdik.no_sek,tbdik.th_sek,tbdik.nm_sek,tbdik.gelar_dpn_sek,tbdik.gelar_blk_sek,tbdik.ijz_cpns,tbdik.gambar,tbdik.nm_dik,b.nm_skpd,c.nm_unit,c.notes,d.nm_lok, tbunit.sao FROM bpaddtfake.dbo.emp_data as a
							CROSS APPLY (SELECT TOP 1 tmt_gol,tmt_sk_gol,no_sk_gol,idgol,jns_kp,mk_thn,mk_bln,gambar,nm_pangkat FROM  bpaddtfake.dbo.emp_gol,bpaddtfake.dbo.glo_org_golongan WHERE a.id_emp = emp_gol.noid AND emp_gol.idgol=glo_org_golongan.gol AND emp_gol.sts='1' AND glo_org_golongan.sts='1' ORDER BY tmt_gol DESC) tbgol
							CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  bpaddtfake.dbo.emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
							CROSS APPLY (SELECT TOP 1 iddik,prog_sek,no_sek,th_sek,nm_sek,gelar_dpn_sek,gelar_blk_sek,ijz_cpns,gambar,nm_dik FROM  bpaddtfake.dbo.emp_dik,bpaddtfake.dbo.glo_dik WHERE a.id_emp = emp_dik.noid AND emp_dik.iddik=glo_dik.dik AND emp_dik.sts='1' AND glo_dik.sts='1' ORDER BY th_sek DESC) tbdik
							CROSS APPLY (SELECT TOP 1 * FROM bpaddtfake.dbo.glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
							,bpaddtfake.dbo.glo_skpd as b,bpaddtfake.dbo.glo_org_unitkerja as c,bpaddtfake.dbo.glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1' 
							and id_emp like '". Auth::user()->id_emp ."'
							"))[0];
			$user_data = json_decode(json_encode($user_data), true);
			$idunit = $user_data['idunit'];
		} else {
			$idunit = '01';
		}

		$bookingmy = DB::select( DB::raw("
							SELECT TOP (1000) [ids]
							      ,[sts]
							      ,[uname]
							      ,[tgl]
							      ,[nm_emp]
							      ,[id_emp]
							      ,[unit_emp]
							      ,[nmunit_emp]
							      ,[tujuan]
							      ,[peserta]
							      ,[ruang]
							      ,[tgl_pinjam]
							      ,[jam_mulai]
							      ,[jam_selesai]
							      ,[nm_file]
							      ,[status]
							      ,[alasan_tolak]
							      ,[appr_usr]
							      ,[appr_time]
						  	FROM [bpaddtfake].[dbo].[book_transact]
						  	where status = 'Y'
						  		$qsearchnow
						  		and month(tgl_pinjam) $signnow $monthnow
								and year(tgl_pinjam) = $yearnow
								and sts = 1
						") );
		$bookingyes = json_decode(json_encode($bookingyes), true);
		$bookingwait = json_decode(json_encode($bookingwait), true);
		$bookingno = json_decode(json_encode($bookingno), true);

		var_dump($bookingwait[0]['jam_mulai']);
		die();
		return view('pages.bpadbooking.listpinjam')
				->with('access', $access)
				->with('bookingwait', $bookingwait)
				->with('bookingyes', $bookingyes)
				->with('bookingno', $bookingno)
				->with('signnow', $signnow)
				->with('searchnow', $request->searchnow)
				->with('monthnow', $monthnow)
				->with('yearnow', $yearnow);
	}
}
