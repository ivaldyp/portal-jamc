<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;

use App\Hu_kategori;
use App\Hu_dasarhukum;
use App\Hu_jenis;
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
		$access = $this->checkAccess($_SESSION['user_jamcportal']['idgroup'], $thismenu['ids']);

		$kategoris = Hu_kategori::
						where('sts', 1)
						->orderBy('nm_kat')
						->get();

		return view('pages.bpadjamc.kategori')
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

	////////////////////////////////////////////////////////////////////////////

	public function jenisall(Request $request)
	{
		$this->checkSessionTime();
		$currentpath = str_replace("%20", " ", $_SERVER['REQUEST_URI']);
		$currentpath = explode("?", $currentpath)[0];
		$thismenu = Sec_menu::where('urlnew', $currentpath)->first('ids');
		$access = $this->checkAccess($_SESSION['user_jamcportal']['idgroup'], $thismenu['ids']);

		$jenises = Hu_jenis::
						where('sts', 1)
						->orderBy('nm_jenis')
						->get();

		return view('pages.bpadjamc.jenis')
				->with('access', $access)
				->with('jenises', $jenises);
	}

	public function forminsertjenis(Request $request)
	{
		$insertjenis = [
				'sts'       => 1,
				'uname'     => Auth::user()->usname,
				'tgl'       => date('Y-m-d H:i:s'),
				'nm_jenis'    => strtoupper($request->nm_jenis),
			];

		Hu_jenis::insert($insertjenis);

		return redirect('/setup/jenis')
					->with('message', 'Berhasil membuat jenis baru')
					->with('msg_num', 1);
	}

	public function formupdatejenis(Request $request)
	{
		Hu_jenis::where('ids', $request->ids)
			->update([
				'nm_jenis'    => strtoupper($request->nm_jenis),
			]);

		return redirect('/setup/jenis')
					->with('message', 'Berhasil mengubah jenis')
					->with('msg_num', 1);
	}

	public function formdeletejenis(Request $request)
	{
		Hu_jenis::where('ids', $request->ids)
			->update([
				'sts'    => 0,
			]);

		return redirect('/setup/jenis')
					->with('message', 'Berhasil menghapus jenis')
					->with('msg_num', 1);
	}

	////////////////////////////////////////////////////////////////////////////

	public function fileall(Request $request)
	{
		$this->checkSessionTime();
		$currentpath = str_replace("%20", " ", $_SERVER['REQUEST_URI']);
		$currentpath = explode("?", $currentpath)[0];
		$thismenu = Sec_menu::where('urlnew', $currentpath)->first('ids');
		$access = $this->checkAccess($_SESSION['user_jamcportal']['idgroup'], $thismenu['ids']);

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
					      ,[id_jns]
					      ,jns.nm_jenis
					      ,[nomor]
					      ,[tahun]
					      ,[tentang]
					      ,[views]
					      ,[url]
					      ,[img_file]
					      ,[status]
					      ,[created_at]
					      ,[updated_at]
					      ,[hukum]
					      ,[suspend]
					FROM bpadjamc.dbo.hu_dasarhukum dsr
					JOIN bpadjamc.dbo.hu_kategori as kat on kat.ids = dsr.id_kat 
					JOIN bpadjamc.dbo.hu_jenis as jns on jns.ids = dsr.id_jns 
					where dsr.sts = 1 
					$qkat
					$qyear
					order by tahun desc, created_at desc, id_kat, nomor asc") );
		$files = json_decode(json_encode($files), true);

		return view('pages.bpadjamc.file')
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

		$jenises = Hu_jenis::
						where('sts', 1)
						->orderBy('nm_jenis')
						->get();

		return view('pages.bpadjamc.filetambah')
				->with('kategoris', $kategoris)
				->with('jenises', $jenises);
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
					      ,[id_jns]
					      ,jns.nm_jenis
					      ,[nomor]
					      ,[tahun]
					      ,[tentang]
					      ,[views]
					      ,[url]
					      ,[img_file]
					      ,[status]
					      ,[created_at]
					      ,[updated_at]
					      ,[hukum]
					      ,[suspend]
					FROM bpadjamc.dbo.hu_dasarhukum dsr
					JOIN bpadjamc.dbo.hu_kategori as kat on kat.ids = dsr.id_kat 
					JOIN bpadjamc.dbo.hu_jenis as jns on jns.ids = dsr.id_jns
					where dsr.ids = $request->ids") )[0];
		$file = json_decode(json_encode($file), true);

		$kategoris = Hu_kategori::
						where('sts', 1)
						->orderBy('nm_kat')
						->get();

		$jenises = Hu_jenis::
						where('sts', 1)
						->orderBy('nm_jenis')
						->get();

		return view('pages.bpadjamc.fileubah')
				->with('kategoris', $kategoris)
				->with('jenises', $jenises)
				->with('file', $file);
	}

	public function forminsertfile(Request $request)
	{
		$countsama = Hu_dasarhukum::
						where('id_kat', $request->id_kat)
						->where('nomor', $request->nomor)
						->where('tahun', $request->tahun)
						->where('hukum', 1)
						->where('sts', 1)
						->count();

		if ($countsama > 0) {
			return redirect('/setup/tambah file')->with('message', 'File tersebut sudah ada');
		}

		$tgl = date('Y-m-d H:i:s');

		$filefoto = '';

		if (isset($request->filefoto)) {
			$file = $request->filefoto;

			$ext = $file->getClientOriginalExtension();
			if (strtolower($ext) != 'jpg' && strtolower($ext) != 'jpeg' && strtolower($ext) != 'png') {
				return redirect('/setup/tambah file')->with('message', 'File yang diunggah bukan JPG / JPEG / PNG');    
			}

			$tujuan_upload = config('app.savefilehukum');
			$tujuan_upload .= "\\" . date('Y',strtotime($tgl));
			$tujuan_upload .= "\\da" . date('YmdHis',strtotime($tgl)). "\\";

			$filefoto .= "file" . date('YmdHis',strtotime($tgl)) . ".". $file->getClientOriginalExtension();

			$file->move($tujuan_upload, $filefoto);
		}

		$insertfile = [
				'sts'       => 1,
				'uname'     => Auth::user()->usname,
				'tgl'       => date('Y-m-d H:i:s'),
				'id_kat'	=> $request->id_kat,
				'id_jns'	=> $request->jenis,
				'nomor'		=> $request->nomor,
				'tahun'		=> $request->tahun,
				'tentang'	=> $request->tentang,
				'views'		=> 0,
				'url'		=> $request->url,
				'img_file'	=> $filefoto,
				'status'	=> $request->status,
				'created_at'=> date('Y-m-d H:i:s',strtotime(str_replace('/', '-', $request->updated_at))),
				'updated_at'=> date('Y-m-d H:i:s',strtotime(str_replace('/', '-', $request->updated_at))),
				'hukum'		=> $request->hukum,
				'suspend'	=> $request->suspend,
			];

		Hu_dasarhukum::insert($insertfile);

		if($request->url && $request->tahun && $request->tentang) {
			// $url = "http://10.15.38.80/mobileaset/notif/bulk"; //release
			$url = "http://10.15.38.82/mobileasetstaging/notif/bulk"; //staging
			
			$client = new Client();
			$res = $client->request('GET', $url, [
				'headers' => [
					'Content-Type' => 'application/x-www-form-urlencoded',
				],
				'form_params' => [
					"title" => "Produk Hukum Terbaru",
					"message" => "Lihat produk hukum terbaru BPAD tentang ".ucwords($request->tentang). " disini!!",
					"data" => [
						"type" => "produkHukum",
						"ids" => 1,
						"url" => $request->url,
						// "image"
					],
				],
			]);	
		}

		return redirect('/setup/file')
					->with('message', 'Berhasil menambahkan produk hukum')
					->with('msg_num', 1);
	}

	public function formupdatefile(Request $request)
	{
		$nowhukum = Hu_dasarhukum::where('ids', $request->ids)->first();

		$filefoto = '';

		if (isset($request->filefoto)) {

			$fullpath = config('app.savefilehukum') . "\\" . date('Y',strtotime(str_replace('/', '-', $nowhukum['tgl'])));
    		$fullpath .= "\\da" . date('YmdHis',strtotime(str_replace('/', '-', $nowhukum['tgl'])));
    		$fullpath .= "\\*";

			$files = glob($fullpath); // get all file names

			foreach($files as $file) { // iterate files
			  	if(is_file($file))
			    	unlink($file); // delete file
			}

			$file = $request->filefoto;

			$ext = $file->getClientOriginalExtension();
			if (strtolower($ext) != 'jpg' && strtolower($ext) != 'jpeg' && strtolower($ext) != 'png') {
				return redirect('/setup/ubah file?ids='.$nowhukum['ids'])->with('message', 'File yang diunggah bukan JPG / JPEG / PNG');    
			}

			$tujuan_upload = config('app.savefilehukum');
			$tujuan_upload .= "\\" . date('Y',strtotime(str_replace('/', '-', $nowhukum['tgl'])));
			$tujuan_upload .= "\\da" . date('YmdHis',strtotime(str_replace('/', '-', $nowhukum['tgl']))) . "\\";

			$filefoto .= "file" . date('YmdHis',strtotime(str_replace('/', '-', $nowhukum['tgl']))) . ".". $file->getClientOriginalExtension();

			$file->move($tujuan_upload, $filefoto);
		}

		Hu_dasarhukum::where('ids', $request->ids)
			->update([
				'id_kat'	=> $request->id_kat,
				'id_jns'	=> $request->jenis,
				'nomor'		=> $request->nomor,
				'tahun'		=> $request->tahun,
				'tentang'	=> $request->tentang,
				'url'		=> $request->url,
				'status'	=> $request->status,
				'created_at'=> date('Y/m/d',strtotime(str_replace('/', '-', $request->created_at))),
				'updated_at'=> date('Y-m-d H:i:s'),
				'hukum'		=> $request->hukum,
				'suspend'	=> $request->suspend,
			]);

		if ($filefoto) {
			Hu_dasarhukum::where('ids', $request->ids)
			->update([
				'img_file'	=> $filefoto,
			]);
		}

		return redirect('/setup/file')
					->with('message', 'Berhasil mengubah file produk hukum')
					->with('msg_num', 1);
	}

	public function formdeletefile(Request $request)
	{
		$nowhukum = Hu_dasarhukum::where('ids', $request->ids)->first();

		$fullpath = config('app.savefilehukum') . "\\" . date('Y',strtotime(str_replace('/', '-', $nowhukum['tgl'])));
		$fullpath .= "\\da" . date('YmdHis',strtotime(str_replace('/', '-', $nowhukum['tgl'])));
		$fullpath .= "\\*";

		$files = glob($fullpath); // get all file names

		foreach($files as $file) { // iterate files
		  	if(is_file($file))
		    	unlink($file); // delete file
		}

		Hu_dasarhukum::where('ids', $request->ids)
			->update([
				'sts'    => 0,
			]);

		return redirect('/setup/file')
					->with('message', 'Berhasil menghapus file produk hukum')
					->with('msg_num', 1);
	}
}