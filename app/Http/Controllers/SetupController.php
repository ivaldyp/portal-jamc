<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;

use App\Hu_kategori;
use App\Hu_dasarhukum;
use App\Sec_menu;

session_start();

class SetupController extends Controller
{
    use SessionCheckTraits;

	public function __construct()
	{
		$this->middleware('auth');
		set_time_limit(300);
	}

	public function kategoriall(Request $request)
	{
		$this->checkSessionTime();
		$currentpath = str_replace("%20", " ", $_SERVER['REQUEST_URI']);
		$currentpath = explode("?", $currentpath)[0];
		$thismenu = Sec_menu::where('urlnew', $currentpath)->first('ids');
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], $thismenu['ids']);

		$kategoris = Hu_kategori::
						where('sts', 1)
						->orderBy('nm_kat')
						->get();

		return view('pages.bpaddasarhukum.kategori')
				->with('access', $access)
				->with('kategoris', $kategoris);
	}

	public function forminsertkategori(Request $request)
	{
		$insertkategori = [
				'sts'       => 1,
				'uname'     => Auth::user()->usname,
				'tgl'       => date('Y-m-d H:i:s'),
				'nm_kat'    => $request->nm_kat,
				'singkatan' => ($request->singkatan ?: ''),
			];

		Hu_kategori::insert($insertkategori);

		return redirect('/setup/kategori')
					->with('message', 'Berhasil membuat kategori baru')
					->with('msg_num', 1);
	}

	public function formupdatekategori(Request $request)
	{
		Hu_kategori::where('ids', $request->ids)
			->update([
				'nm_kat'    => $request->nm_kat,
				'singkatan' => ($request->singkatan ?: ''),
			]);

		return redirect('/setup/kategori')
					->with('message', 'Berhasil mengubah kategori')
					->with('msg_num', 1);
	}

	public function formdeletekategori(Request $request)
	{
		Hu_kategori::where('ids', $request->ids)
			->update([
				'sts'    => 0,
			]);

		return redirect('/setup/kategori')
					->with('message', 'Berhasil menghapus kategori')
					->with('msg_num', 1);
	}

	public function fileall(Request $request)
	{
		$this->checkSessionTime();
		$currentpath = str_replace("%20", " ", $_SERVER['REQUEST_URI']);
		$currentpath = explode("?", $currentpath)[0];
		$thismenu = Sec_menu::where('urlnew', $currentpath)->first('ids');
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], $thismenu['ids']);

		$kategoris = Hu_kategori::
						where('sts', 1)
						->orderBy('nm_kat')
						->get();

		if ($request->katnow) {
			$qkat = "AND nm_kat = '".$request->katnow."' ";
		} else {
			$qkat = "";
		}

		if ($request->yearnow) {
			$qyear = "AND tahun = '".$request->yearnow."' ";
		} else {
			$qyear = "";
		}

		$files = DB::select( DB::raw("  
					SELECT dsr.[ids]
					      ,dsr.[sts]
					      ,dsr.[tgl]
					      ,dsr.[uname]
					      ,[id_kat]
					      ,kat.nm_kat
					      ,kat.singkatan
					      ,[nomor]
					      ,[tahun]
					      ,[tentang]
					      ,[views]
					      ,[url]
					      ,[img_file]
					      ,[status]
					      ,[created_at]
					      ,[updated_at]
					FROM bpaddasarhukum.dbo.hu_dasarhukum dsr
					JOIN bpaddasarhukum.dbo.hu_kategori as kat on kat.ids = dsr.id_kat 
					where dsr.sts = 1 
					$qkat
					$qyear
					order by tahun desc, id_kat, nomor asc, tgl desc") );
		$files = json_decode(json_encode($files), true);

		return view('pages.bpaddasarhukum.file')
				->with('access', $access)
				->with('kategoris', $kategoris)
				->with('katnow', $request->katnow)
				->with('yearnow', $request->yearnow)
				->with('files', $files);
	}

	public function filetambah(Request $request)
	{
		$kategoris = Hu_kategori::
						where('sts', 1)
						->orderBy('nm_kat')
						->get();

		return view('pages.bpaddasarhukum.filetambah')
				->with('kategoris', $kategoris);
	}

	public function fileubah(Request $request)
	{
		$ids = $request->ids;

		$file = DB::select( DB::raw("  
					SELECT dsr.[ids]
					      ,dsr.[sts]
					      ,dsr.[tgl]
					      ,dsr.[uname]
					      ,[id_kat]
					      ,kat.nm_kat
					      ,kat.singkatan
					      ,[nomor]
					      ,[tahun]
					      ,[tentang]
					      ,[views]
					      ,[url]
					      ,[img_file]
					      ,[status]
					      ,[created_at]
					      ,[updated_at]
					FROM bpaddasarhukum.dbo.hu_dasarhukum dsr
					JOIN bpaddasarhukum.dbo.hu_kategori as kat on kat.ids = dsr.id_kat 
					where dsr.ids = $request->ids") )[0];
		$file = json_decode(json_encode($file), true);

		$kategoris = Hu_kategori::
						where('sts', 1)
						->orderBy('nm_kat')
						->get();

		return view('pages.bpaddasarhukum.fileubah')
				->with('kategoris', $kategoris)
				->with('file', $file);
	}

	public function forminsertfile(Request $request)
	{
		$insertfile = [
				'sts'       => 1,
				'uname'     => Auth::user()->usname,
				'tgl'       => date('Y-m-d H:i:s'),
				'id_kat'	=> $request->id_kat,
				'nomor'		=> $request->nomor,
				'tahun'		=> $request->tahun,
				'tentang'	=> $request->tentang,
				'views'		=> 0,
				'url'		=> $request->url,
				'created_at'=> date('Y-m-d H:i:s',strtotime(str_replace('/', '-', $request->updated_at))),
				'updated_at'=> date('Y-m-d H:i:s',strtotime(str_replace('/', '-', $request->updated_at))),
			];

		Hu_dasarhukum::insert($insertfile);

		return redirect('/setup/file')
					->with('message', 'Berhasil menambahkan dasar hukum')
					->with('msg_num', 1);
	}

	public function formupdatefile(Request $request)
	{
		Hu_dasarhukum::where('ids', $request->ids)
			->update([
				'id_kat'	=> $request->id_kat,
				'nomor'		=> $request->nomor,
				'tahun'		=> $request->tahun,
				'tentang'	=> $request->tentang,
				'url'		=> $request->url,
				'updated_at'=> date('Y-m-d H:i:s'),
			]);

		return redirect('/setup/file')
					->with('message', 'Berhasil mengubah file dasar hukum')
					->with('msg_num', 1);
	}

	public function formdeletefile(Request $request)
	{
		Hu_dasarhukum::where('ids', $request->ids)
			->update([
				'sts'    => 0,
			]);

		return redirect('/setup/file')
					->with('message', 'Berhasil menghapus file dasar hukum')
					->with('msg_num', 1);
	}
}