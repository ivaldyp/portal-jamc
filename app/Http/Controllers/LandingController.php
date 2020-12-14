<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\hu_dasarhukum;
use App\Hu_jenis;
use App\Hu_kategori;

session_start();

class LandingController extends Controller
{
	public function index(Request $request)
	{
		$jenises = Hu_jenis::
					select(DB::raw('nm_jenis as nama'))
					->where('sts', 1);
	
		$kategoris = Hu_kategori::
					select(DB::raw('nm_kat as nama'))
					->where('sts', 1)
					->union($jenises)
					->orderBy('nama')
					->get();

		if ($request->show) {
			$paging = (int)$request->show;
		} else {
			$paging = 10;
		}

		$files = Hu_dasarhukum::where('hu_dasarhukum.sts', 1)
					->join('hu_kategori', 'hu_kategori.ids', '=', 'hu_dasarhukum.id_kat')
					->join('hu_jenis', 'hu_jenis.ids', '=', 'hu_dasarhukum.id_jns')
					->orderBy('hu_dasarhukum.tahun', 'desc')
					->orderBy('hu_dasarhukum.created_at', 'desc')
					->orderBy('hu_dasarhukum.nomor', 'asc');
		

		if ($request->kat) {
			$kat = $request->kat;
			$files
			->where(function ($q) use ($kat) {
				$q->where('hu_kategori.nm_kat', $kat)
				  ->orWhere('hu_jenis.nm_jenis', $kat);
				}
			);
		}

		if ($request->year) {
			$files->where('hu_dasarhukum.tahun', $request->year);
		}

		if ($request->tentang) {
			$files->whereRaw("hu_dasarhukum.tentang like '%".$request->tentang."%' or hu_dasarhukum.nomor like '%".$request->tentang."%'");
		}		

		$files
		->where(function ($q) {
			$q->where('hu_dasarhukum.suspend', 0)
			  ->orWhereNull('hu_dasarhukum.suspend');
			}
		);
		// ->where('hu_dasarhukum.suspend', 0);

		$files = $files->paginate($paging, array('hu_dasarhukum.*', 'hu_kategori.nm_kat as nm_kat', 'hu_kategori.singkatan as singkatan'));

		return view('index')
				->with('kategoris', $kategoris)
				->with('katnow', $request->kat)
				->with('yearnow', $request->year)
				->with('tentangnow', $request->tentang)
				->with('shownow', $paging)
				->with('files', $files);
	}

	public function logout()
	{
		unset($_SESSION['user_produk']);
		Auth::logout();
		return redirect('/');
	}	
}