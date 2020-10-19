<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Hu_kategori;
use App\hu_dasarhukum;

session_start();

class LandingController extends Controller
{
	public function index(Request $request)
	{
		$kategoris = Hu_kategori::
						where('sts', 1)
						->orderBy('nm_kat')
						->get();

		if ($request->show) {
			$paging = (int)$request->show;
		} else {
			$paging = 10;
		}

		$files = Hu_dasarhukum::where('hu_dasarhukum.sts', 1)
					->join('hu_kategori', 'hu_kategori.ids', '=', 'hu_dasarhukum.id_kat')
					->orderBy('hu_dasarhukum.tahun', 'desc')
					->orderBy('hu_dasarhukum.created_at', 'desc')
					->orderBy('hu_dasarhukum.nomor', 'asc');
		

		if ($request->kat) {
			$files->where('hu_kategori.nm_kat', $request->kat);
		}

		if ($request->year) {
			$files->where('hu_dasarhukum.tahun', $request->year);
		}

		if ($request->tentang) {
			$files->whereRaw("hu_dasarhukum.tentang like '%".$request->tentang."%'");
		}			

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