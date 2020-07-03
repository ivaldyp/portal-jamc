<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;

use App\Book_ruang;
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
		$this->checkSessionTime();

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
			'lantai' => $request->lantai,
		];

		Book_ruang::insert($insertruang);

		return redirect('/booking/manageruang')
				->with('message', 'Ruang berhasil dibuat')
				->with('msg_num', 1);

	}

	public function formupdateruang(Request $request)
	{
		$this->checkSessionTime();

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
				'lantai' => $request->lantai,
			]);

		return redirect('/booking/manageruang')
				->with('message', 'Ruang berhasil diubah')
				->with('msg_num', 1);

	}

	public function formdeleteruang(Request $request)
	{
		$this->checkSessionTime();

		Book_ruang::where('ids', $request->ids)
			->update([
				'sts' => 0,
			]);

		return redirect('/booking/manageruang')
				->with('message', 'Ruang berhasil dihapus')
				->with('msg_num', 1);
	}
}
