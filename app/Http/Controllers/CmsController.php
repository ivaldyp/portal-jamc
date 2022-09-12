<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;
use App\Traits\TraitsCheckActiveMenu;

use App\Content_tb;
use App\Emp_data;
use App\Glo_kategori;
use App\Glo_subkategori;
use App\New_icon_produk;
use App\Sec_access;
use App\Sec_menu;
use App\Content_can_approve;
use PhpOffice\PhpSpreadsheet\Reader\Xls\RC4;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Content;

session_start();

class CmsController extends Controller
{
	use SessionCheckTraits;
    use TraitsCheckActiveMenu;

	public function __construct()
	{
		$this->middleware('auth');
	}

	// ------------------ MENU ------------------ //

	public function display_roles($query, $idgroup, $access, $parent, $level = 0)
	{

		if ($parent == 0) {
			$sao = "(sao = 0 or sao is null)";
		} else {
			$sao = "(sao = ".$parent.")";
		}

        $query = Sec_menu::
                whereRaw($sao)
                ->orderBy('urut')
                ->orderBy('ids')
                ->get();

		$result = '';

		if (count($query) > 0) {
			foreach ($query as $menu) {
				$padding = ($level * 20) + 8;
				$result .= '<tr style="background-color:">
								<td class="col-md-1">'.$level.'</td>
								<td class="col-md-1">'.$menu['ids'].'</td>
								<td style="padding-left:'.$padding.'px; '.(($level == 0) ? 'font-weight: bold;"' : '').'">'.$menu['desk'].' '.(($menu['child'] == 1)? '<i class="fa fa-arrow-down"></i>' : '').'</td>
								<td>'.($menu['zket'] ? $menu['zket'] : '-').'</td>
								<td>'.($menu['iconnew'] ? $menu['iconnew'] : '-').'</td>
								<td>'.($menu['urlnew'] ? $menu['urlnew'] : '-').'</td>
								<td class="text-center">'.intval($menu['urut']).'</td>
								<td class="text-center">'.(($menu['child'] == 1)? '<i style="color:green;" class="fa fa-check"></i>' : '<i style="color:red;" class="fa fa-times"></i>').'</td>
								<td class="text-center">'.(($menu['tampilnew'] == 1)? '<i style="color:green;" class="fa fa-check"></i>' : '<i style="color:red;" class="fa fa-times"></i>').'</td>
								
								'.(($access['zadd'] == 'y') ? 
									'<td class="text-center"><button type="button" class="btn btn-success btn-insert" data-toggle="modal" data-target="#modal-insert" data-ids="'.$menu['ids'].'" data-desk="'.$menu['desk'].'"><i class="fa fa-plus"></i></button></td>'
								: '' ).'


								'.(($access['zupd'] == 'y' || $access['zdel'] == 'y') ? 
									'<td class="col-md-2">
										'.(($access['zupd'] == 'y') ? 
											'<button type="button" class="btn btn-info btn-update" data-toggle="modal" data-target="#modal-update" data-ids="'.$menu['ids'].'" data-desk="'.$menu['desk'].'" data-child="'.$menu['child'].'" data-iconnew="'.$menu['iconnew'].'" data-urlnew="'.$menu['urlnew'].'" data-urut="'.$menu['urut'].'" data-tampilnew="'.$menu['tampilnew'].'" data-zket="'.$menu['zket'].'"><i class="fa fa-edit"></i></button>
											<a href="/'.config('app.name').'/cms/menuakses?menu='.$menu['ids'].'&nama='.$menu['desk'].'"><button type="button" class="btn btn-warning"><i class="fa fa-key"></i></button></a>
											'
										: '').'
										'.(($access['zdel'] == 'y') ? 
											'<button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#modal-delete" data-ids="'.$menu['ids'].'" data-sao="'.$menu['sao'].'" data-desk="'.$menu['desk'].'"><i class="fa fa-trash"></i></button>'
										: '').'
									</td>'
								: '' ).'
								
							</tr>';

				if ($menu['child'] == 1) {
					$result .= $this->display_roles($query, $idgroup, $access, $menu['ids'], $level+1);
				}
			}
		}
		return $result;
	}

	public function menuall(Request $request)
	{
        $this->checkSessionTime();
        $thismenu = $this->trimmenu($_SERVER['REQUEST_URI']);
		$access = $this->checkAccess($_SESSION['user_jamcportal']['idgroup'], $thismenu['ids']);
        $activemenus = $this->checkactivemenu(config('app.name'), url()->current());

		$all_menu = [];

		$menus = $this->display_roles($all_menu, $request->name, $access, 0);
		
		return view('pages.bpadcms.menu')
				->with('access', $access)
				->with('menus', $menus)
                ->with('activemenus', $activemenus);
	}

	public function forminsertmenu(Request $request)
	{
		$this->checkSessionTime();

		$maxids = Sec_menu::max('ids');
		$urut = intval(Sec_menu::where('sao', $request->sao)
				->max('urut'));

		if ($request->urut) {
			$urut = $request->urut;
		} else {
			if (is_null($urut)) {
				$urut = 1;
			} else {
				$urut = $urut + 1;
			}
		}
		is_null($request->desk) ? $desk = '' : $desk = $request->desk;
		is_null($request->zket) ? $zket = '' : $zket = $request->zket;
		$request->sao == 0 ? $sao = '' : $sao = $request->sao;  

		$insert = [
				'sts'       => 1,
				'uname'     => Auth::user()->usname,
				'tgl'       => date('Y-m-d H:i:s'),
				'ip'        => '',
				'logbuat'   => '',
				'suspend'   => '',
				'urut'      => $urut,
				'desk'      => $desk,
				'validat'   => '',
				'isi'       => '',
				'ipserver'  => '',
				'child'     => 0,
				'sao'       => $sao,
				'tipe'      => '',
				'icon'      => '',
				'zfile'     => '',
				'zket'      => $zket,
				'iconnew'   => $request->iconnew,
				'urlnew'    => $request->urlnew,
				'tampilnew' => $request->tampilnew,
			];

		if (Sec_menu::insert($insert) && $sao > 0) {
			$query = Sec_menu::
						where('ids', $sao)
						->update([
							'child' => 1,
						]);
		}

		$idgroups = Sec_access::
					distinct('idgroup')
					->orderBy('idgroup', 'asc')
					->get('idgroup');

		$result = array();
		$thisid = Sec_menu::max('ids');
		foreach ($idgroups as $key => $group) {
			array_push($result, [
				'sts' => 1,
				'uname' => Auth::user()->usname,
				'tgl' => date('Y-m-d H:i:s'),
				'ip' => '',
				'logbuat' => '',
				'idgroup' => $group['idgroup'],
				'idtop' => $thisid,
			]);
		}
		Sec_access::insert($result);

		return redirect('/cms/menu')
                    ->with('success', 'Menu '.$request->desk.' berhasil ditambah');
	}

	public function formupdatemenu(Request $request)
	{
		$this->checkSessionTime();

		Sec_menu::
			where('ids', $request->ids)
			->update([
				'desk'      => $request->desk,
				'zket'      => $request->zket,
				'urut'      => $request->urut,
				'iconnew'   => $request->iconnew,
				'urlnew'    => $request->urlnew,
				'tampilnew' => $request->tampilnew
			]);

		return redirect('/cms/menu')
                    ->with('success', 'Menu '.$request->desk.' berhasil diubah');
	}

	public function deleteLoopAccess($ids)
	{
		$childids = Sec_menu::
					where('sao', $ids)
					->get('ids');

		foreach ($childids as $id) {
			$this->deleteLoopAccess($id['ids']);
			Sec_access::
				where('idtop', $id['ids'])
				->delete();
		}

		return 1;
	}

	public function deleteLoopMenu($ids)
	{
		$childids = Sec_menu::
					where('sao', $ids)
					->get('ids');

		foreach ($childids as $id) {
			$this->deleteLoopMenu($id['ids']);
			Sec_menu::
				where('sao', $id['ids'])
				->delete();
		}

		return 1;
	}

	public function formdeletemenu(Request $request)
	{
		$this->checkSessionTime();

		// hapus menu dari tabel access
		$this->deleteLoopAccess($request->ids);

		$deletechildaccess = Sec_access::
								where('idtop', $request->ids)
								->delete();

		// hapus menu dari tabel menu
		$this->deleteLoopMenu($request->ids);

		$delete = Sec_menu::
					where('ids', $request->ids)
					->delete();
		
		// cek if menu masih punya child
		$cekchild = Sec_menu::
					where('sao', $request->sao)
					->count();

		if ($cekchild == 0) {
			$updatechild = Sec_menu::
							where('ids', $request->sao)
							->update([
								'child' => 0,
							]);
		}

		return redirect('/cms/menu')
                    ->with('success', 'Menu '.$request->desk.' berhasil dihapus');
	}

	public function menuakses(Request $request)
	{
		$this->checkSessionTime();

		$idtop = $request->menu;
		$desk = $request->nama;
		$accesses = Sec_access::
					where('idtop', $idtop)
					->orderBy('idgroup')
					->get();

		return view('pages.bpadcms.menuakses')
				->with('now_idtop', $idtop)
				->with('now_desk', $desk)
				->with('accesses', $accesses);
	}

	public function formupdateaccess(Request $request)
	{
		$this->checkSessionTime();

		$idtop = $request->idtop;
		$desk = $request->desk;

		Sec_access::where('idtop', $idtop)
					->update([
						'zviw' => null,
						'zadd' => null,
						'zupd' => null,
						'zdel' => null,
					]);

		if ($request->zviw) {
			foreach ($request->zviw as $zviw) {
				Sec_access::
					where('idtop', $idtop)
					->where('idgroup', $zviw)
					->update([
						'zviw' => 'y',
					]);
			}
		}

		if ($request->zadd) {
			foreach ($request->zadd as $zadd) {
				Sec_access::
					where('idtop', $idtop)
					->where('idgroup', $zadd)
					->update([
						'zadd' => 'y',
					]);
			}
		}

		if ($request->zupd) {
			foreach ($request->zupd as $zupd) {
				Sec_access::
					where('idtop', $idtop)
					->where('idgroup', $zupd)
					->update([
						'zupd' => 'y',
					]);
			}
		}

		if ($request->zdel) {
			foreach ($request->zdel as $zdel) {
				Sec_access::
					where('idtop', $idtop)
					->where('idgroup', $zdel)
					->update([
						'zdel' => 'y',
					]);
			}
		}

		return redirect('/cms/menuakses?menu='.$idtop.'&nama='.$desk)
                    ->with('success', 'Hak akses '.$desk.' berhasil diubah');
	}

	// ------------------ MENU ------------------ //
    
    // ----------------- CONTENT ---------------- //

    public function contentall(Request $request)
	{
        $this->checkSessionTime();
        $thismenu = $this->trimmenu($_SERVER['REQUEST_URI']);
		$access = $this->checkAccess($_SESSION['user_jamcportal']['idgroup'], $thismenu['ids']);
        $activemenus = $this->checkactivemenu(config('app.name'), url()->current());

		if (!(is_null($request->katnow))) {
			$katnow = $request->katnow;
		} else {
			$katnow = 1;
		}

		if (is_null($request->suspnow) || $request->suspnow == 'N') {
			$suspnow = '';
		} elseif ($request->suspnow == 'Y') {
			$suspnow = 'Y';
		}

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
			$signnow = "<=";
		}

        $kategoris = DB::select( DB::raw("
					SELECT *, (select count (ids) from bpadjamc.dbo.content_tb as con where appr = 'N' and sts = 1 and suspend = '$suspnow' and idkat = kat.ids) as total
					FROM bpadjamc.dbo.glo_kategori as kat
					WHERE sts = 1
					ORDER BY nmkat
				"));
		$kategoris = json_decode(json_encode($kategoris), true);

		$katnowdetail = DB::select( DB::raw("
					SELECT *, lower(nmkat) as nama
					FROM bpadjamc.dbo.glo_kategori kat
					WHERE ids = $katnow
				"))[0];
		$katnowdetail = json_decode(json_encode($katnowdetail), true);

		$subkats = Glo_subkategori::
					get();

		$contents = DB::select( DB::raw("
					SELECT TOP (1000) con.ids, con.suspend, con.ids, con.tanggal, con.subkat, con.judul, con.editor, con.editor, con.tfile, con.tipe, con.appr, con.tgl, con.idkat, lower(kat.nmkat) as nmkat 
                      from bpadjamc.dbo.content_tb con
					  join bpadjamc.dbo.glo_kategori kat on kat.ids = con.idkat
					  where idkat = $katnow
					  and suspend = '$suspnow'
					  and con.sts = 1
					  and month(con.tanggal) $signnow $monthnow
					  and year(con.tanggal) $signnow $yearnow
					  order by con.appr, con.tgl desc 
				    "));
		$contents = json_decode(json_encode($contents), true);

		$approve = Content_can_approve::first();
		$splitappr = explode("::", $approve['can_approve']);

        if ($_SESSION['user_jamcportal']['id_emp']) {
			$thisid = $_SESSION['user_jamcportal']['id_emp'];
		} else {
			$thisid = $_SESSION['user_jamcportal']['usname'];
		} 

		foreach ($splitappr as $key => $data) {
			if ($thisid == $data) {
				$flagapprove = 1;
				break;
			} else {
				$flagapprove = 0;
			}
		}
		
		return view('pages.bpadmedia.content')
				->with('access', $access)
				->with('kategoris', $kategoris)
				->with('subkats', $subkats)
				->with('contents', $contents)
				->with('katnow', $katnow)
				->with('katnowdetail', $katnowdetail)
				->with('suspnow', $suspnow)
				->with('flagapprove', $flagapprove)
				->with('signnow', $signnow)
				->with('monthnow', $monthnow)
				->with('yearnow', $yearnow)
                ->with('activemenus', $activemenus);
	}

    public function contenttambah(Request $request)
    {
        if(count($_SESSION) == 0) {
			return redirect('home');
		}
		//$this->checkSessionTime();

		$subkats = Glo_subkategori::
					where('idkat', $request->kat)
                    ->orderBy('urut_subkat', 'asc')
					->get();

		$kat = Glo_kategori::
					where('ids', $request->kat)
					->first();

		return view('pages.bpadmedia.contenttambah')
				->with('subkats', $subkats)
				->with('kat', $kat)
				->with('idkat', $request->kat);
    }

    public function contentubah(Request $request)
	{
		if(count($_SESSION) == 0) {
			return redirect('home');
		}
		//$this->checkSessionTime();

		$ids = $request->ids;
		$idkat = $request->idkat;

		$subkats = Glo_subkategori::
        where('idkat', $idkat)
        ->get();

        $kat = Glo_kategori::
        where('ids', $idkat)
        ->first();
   
        $content = Content_tb::
        join('bpadjamc.dbo.glo_kategori', 'bpadjamc.dbo.content_tb.idkat', '=', 'bpadjamc.dbo.glo_kategori.ids')
        ->whereRaw('bpadjamc.dbo.content_tb.ids = '.$ids)
        ->orderBy('bpadjamc.dbo.content_tb.tanggal', 'desc')
        ->first();		

		$approve = Content_can_approve::first();
		$splitappr = explode("::", $approve['can_approve']);

		if ($_SESSION['user_jamcportal']['id_emp']) {
			$thisid = $_SESSION['user_jamcportal']['id_emp'];
		} else {
			$thisid = $_SESSION['user_jamcportal']['usname'];
		}   

		foreach ($splitappr as $key => $data) {
			if ($thisid == $data) {
				$flagapprove = 1;
				break;
			} else {
				$flagapprove = 0;
			}
		}

		return view('pages.bpadmedia.contentubah')
				->with('ids', $ids)
				->with('idkat', $idkat)
				->with('kat', $kat)
				->with('subkats', $subkats)
				->with('content', $content)
				->with('flagapprove', $flagapprove)
				->with('signnow', $request->signnow)
				->with('monthnow', $request->monthnow)
				->with('yearnow', $request->yearnow);
    }

    public function forminsertcontent(Request $request)
    {
        if(count($_SESSION) == 0) {
			return redirect('home');
		}
		//$this->checkSessionTime();

		$kat = Glo_kategori::
					where('ids', $request->idkat)
					->first();

		if (isset($request->tfile)) {
			$file = $request->tfile;

			if ($file->getSize() > 1024000) {
				// return redirect('/media/content?katnow='.$request->idkat)->with('message', 'Ukuran file terlalu besar (Maksimal 1MB)');
				return redirect()->back()->with('error', 'Ukuran file terlalu besar (Maksimal 1MB)');
			} 
			if (strtolower($file->getClientOriginalExtension()) != "png" && strtolower($file->getClientOriginalExtension()) != "jpg" && strtolower($file->getClientOriginalExtension()) != "jpeg") {
				return redirect()->back()->with('error', 'File yang diunggah harus berbentuk JPG / JPEG / PNG');     
			} 

			$file_name = "media" . preg_replace("/[^0-9]/", "", $request->tanggal);
			$file_name .= $_SESSION['user_jamcportal']['nrk_emp'];
			$file_name .= ".". $file->getClientOriginalExtension();

			if ($request->idkat == 1) {
				$tujuan_upload = config('app.savefileimgberita');
			} elseif ($request->idkat == 5) {
				$tujuan_upload = config('app.savefileimggambar');
			}

			// if (strtolower($kat['nmkat']) == 'lelang') {
			// 	$tujuan_upload = config('app.savefileimglelang');
			// } elseif (strtolower($kat['nmkat']) == 'infografik') {
			// 	$tujuan_upload = config('app.savefileimginfografik');
			// } elseif (strtolower($kat['nmkat']) == 'infografik epem') {
			// 	$tujuan_upload = config('app.savefileimginfografikepem');
			// }
		
			$file->move($tujuan_upload, $file_name);
		}
			
		if (!(isset($file_name))) {
			$file_name = '';
		}

		if (!(isset($request->subkat))) {
			$subkat = '';
		} else {
			$subkat = $request->subkat;
		}

		if (!(isset($request->url))) {
			$url = '';
		} else {
			$url = $request->url;
		}

		if (!(isset($request->isi1))) {
			$isi1 = '';
		} else {
			$isi1 = $request->isi1;
		}

		if (!(isset($request->isi2))) {
			$isi2 = '';
		} else {
			$isi2 = $request->isi2;
		}

		if ($request->suspend == 'Y') {
			$suspend = 'Y';
		} else {
			$suspend = '';
		}

		if ($request->headline == 'H,' ) {
			$headline = 'H,';
		} else {
			$headline = '';
		}

		if (strtolower($kat['nmkat']) == 'lelang' && $headline == 'H,') {
			Content_tb::where('idkat', $request->idkat)
			->update([
				'tipe' => '',
			]);
		}

		if ($request->kode_kat == 'VID') {
			$isi2 = $isi2;
		} else {
			$isi2 = htmlentities($isi2);
		}
		
		$insert = [
				'sts'       => 1,
				'uname'     => (Auth::user()->usname ? Auth::user()->usname : Auth::user()->id_emp),
				'tgl'       => date('Y-m-d H:i:s'),
				'ip'        => '',
				'logbuat'   => '',
				'suspend'   => $suspend,
				'idkat'     => $request->idkat,
				'subkat'    => $subkat,
				'tipe'      => $headline,
				'tanggal'   => (is_null($request->tanggal) ? date('Y-m-d H:i:s') : date('Y-m-d H:i:s',strtotime(str_replace('/', '-', $request->tanggal))) ),
				'judul'     => $request->judul,
				'isi1'      => htmlentities($isi1),
				'isi2'      => $isi2,
				'tglinput'  => (is_null($request->tanggal) ? date('Y-m-d H:i:s') : date('Y-m-d H:i:s',strtotime(str_replace('/', '-', $request->tanggal))) ),
				'editor'    => $request->editor,
				'link'      => '',
				'thits'     => 0,
				'ipserver'  => '',
				'tfile'     => $file_name,
				'likes'     => 0,
				'privacy'   => '',
				'url'       => $url,
				'kd_cms'    => '1.20.512',
				'appr'      => "N",
				'usrinput'  => $request->usrinput,
				'contentnew'=> $request->contentnew,
			];

		Content_tb::insert($insert);

		return redirect('/media/content?katnow='.$request->idkat)
					->with('success', 'Konten berhasil ditambah');
    }

    public function formupdatecontent(Request $request)
	{
		if(count($_SESSION) == 0) {
			return redirect('home');
		}
		//$this->checkSessionTime();

		$kat = Glo_kategori::
					where('ids', $request->idkat)
					->first();

		$thiscontent = Content_tb::where('ids', $request->ids)->first();

		if (isset($request->tfile)) {
			$file = $request->tfile;

			if ($file->getSize() > 2222222) {
				return redirect('/media/content?katnow='.$request->idkat)->with('error', 'Ukuran file terlalu besar (Maksimal 2MB)');     
			} 
			if ($file->getClientOriginalExtension() != "png" && $file->getClientOriginalExtension() != "jpg" && $file->getClientOriginalExtension() != "jpeg") {
				return redirect('/media/content?katnow='.$request->idkat)->with('error', 'File yang diunggah harus berbentuk JPG / JPEG / PNG');     
			} 

			// $file_name = "cms" . preg_replace("/[^0-9]/", "", $request->tanggal);
			$file_name = "cms" . date('dmyHis');
			$file_name .= $_SESSION['user_jamcportal']['nrk_emp'];
			$file_name .= ".". $file->getClientOriginalExtension();

			if ($request->idkat == 1) {
				$tujuan_upload = config('app.savefileimgberita');
			} elseif ($request->idkat == 5) {
				$tujuan_upload = config('app.savefileimggambar');
			}

			if (strtolower($kat['nmkat']) == 'lelang') {
				$tujuan_upload = config('app.savefileimglelang');
			} elseif (strtolower($kat['nmkat']) == 'infografik') {
				$tujuan_upload = config('app.savefileimginfografik');
			}

			$file->move($tujuan_upload, $file_name);
		}

		if (isset($request->tfiledownload)) {
			$file = $request->tfiledownload;

			if ($file->getSize() > 5555000) {
				return redirect('/media/content?katnow='.$request->idkat)->with('error', 'Ukuran file terlalu besar (Maksimal 5MB)');     
			} 

			$file_name = $file->getClientOriginalName();

			$tujuan_upload = config('app.savefiledocs');
			$file->move($tujuan_upload, $file_name);
		}
			
		if (!(isset($file_name))) {
			$file_name = '';
		}

		if (!(isset($request->subkat))) {
			$subkat = '';
		} else {
			$subkat = $request->subkat;
		}

		if (!(isset($request->url))) {
			$url = '';
		} else {
			$url = $request->url;
		}

		if (!(isset($request->isi1))) {
			$isi1 = '';
		} else {
			$isi1 = $request->isi1;
		}

		if (!(isset($request->isi2))) {
			$isi2 = '';
		} else {
			$isi2 = $request->isi2;
		}

		if ($request->kode_kat == 'VID') {
			$isi2 = $isi2;
		} else {
			$isi2 = htmlentities($isi2);
		}

		if ($request->headline == 'H,' ) {
			$headline = 'H,';
		} else {
			$headline = '';
		}

		if (strtolower($kat['nmkat']) == 'lelang' && $headline == 'H,') {
			Content_tb::where('idkat', $request->idkat)
			->update([
				'tipe' => '',
			]);
		}

		if (isset($request->btnAppr)) {

			if (Auth::user()->usname) {
				$approved_by = Auth::user()->usname;
			} else {
				$approved_by = Auth::user()->id_emp;
			}

			if (strtolower($kat['nmkat']) == 'lelang' && $request->appr == 'Y') {
				Content_tb::where('idkat', $request->idkat)
				->update([
					'appr' => 'N',
					'approved_by' => $approved_by,
				]);
			}

			Content_tb::where('ids', $request->ids)
			->update([
				'appr' => $request->appr,
				'approved_by' => $approved_by,
			]);
		}


		if ($request->suspend == 'Y') {
			$suspend = 'Y';
			$headline = '';
			
			Content_tb::where('ids', $request->ids)
			->update([
				'appr' => 'N',
			]);

            // // NOTIF MOBILE KALAU KONTEN DITOLAK
			// date_default_timezone_set('Asia/Jakarta');
			// if ($request->suspnow == '') {
			// 	$notifsuspend = [
			// 		'sts'       => 1,
			// 		'tgl'       => date('Y-m-d H:i:s'),
			// 		'id_emp'	=> $request->usrinput,
			// 		'jns_notif'	=> 'KONTEN',
			// 		'message1'	=> 'Konten anda dengan judul <b>'.$request->judul.'</b> telah di suspend',
			// 		'message2'	=> $request->suspend_teks,
			// 		'rd'		=> 'N',
			// 	];
			// 	Emp_notif::insert($notifsuspend);
			// }

		} else {
			$suspend = '';
		}

        // // NOTIF MOBILE KALAU KONTEN DISETUJUI
		// date_default_timezone_set('Asia/Jakarta');
		// if ($request->appr == 'Y' && $suspend == '') {
		// 	$notifapprcontent = [
		// 			'sts'       => 1,
		// 			'tgl'       => date('Y-m-d H:i:s'),
		// 			'id_emp'	=> $request->usrinput,
		// 			'jns_notif'	=> 'KONTENAPPR',
		// 			'message1'	=> 'Konten anda dengan judul <b>'.$request->judul.'</b> telah disetujui',
		// 			'message2'	=> '',
		// 			'rd'		=> 'N',
		// 		];
		// 	Emp_notif::insert($notifapprcontent);
		// }

		Content_tb::
			where('ids', $request->ids)
			->update([
				'subkat'     => $subkat,
				'tipe'      => $headline,
				'tanggal'   => (is_null($request->tanggal) ? date('Y-m-d H:i:s') : date('Y-m-d H:i:s',strtotime(str_replace('/', '-', $request->tanggal))) ),
				'judul'   => $request->judul,
				'isi1'   => htmlentities($request->isi1),
				'isi2'   => $isi2,
				'url'       => $url,
				'suspend' => $suspend,
				'suspend_teks' => $request->suspend_teks,
			]);

		if ($file_name != '') {
			Content_tb::where('ids', $request->ids)
			->update([
				'tfile' => $file_name,
			]);
		}

		if ($request->suspnow == 'Y') {
			$suspnow = 'Y';
		} elseif ($request->suspnow == '') {
			$suspnow = 'N';
		}

		return redirect('/media/content?katnow='.$request->idkat.'&suspnow='.$suspnow)
					->with('success', 'Konten berhasil diubah');
	}

    public function formdeletecontent(Request $request)
	{
		if(count($_SESSION) == 0) {
			return redirect('home');
		}
		//$this->checkSessionTime();

		// hapus menu dari tabel kategori
		Content_tb::
					where('ids', $request->ids)
					->update([
						'sts' => 0,
					]);

		return redirect('/media/content?katnow='.$request->idkat)
					->with('success', 'Konten berhasil dihapus');
	}

    // ----------------- CONTENT ---------------- //

    // ---------------- APPROVE ------------------- //

	public function approve (Request $request)
	{
		if(count($_SESSION) == 0) {
			return redirect('home');
		}
		//$this->checkSessionTime();

        $this->checkSessionTime();
        $thismenu = $this->trimmenu($_SERVER['REQUEST_URI']);
		$access = $this->checkAccess($_SESSION['user_jamcportal']['idgroup'], $thismenu['ids']);
        $activemenus = $this->checkactivemenu(config('app.name'), url()->current());

		$approveds = Content_can_approve::first();

        $empapproveds = explode("::rp::valadmin::", $approveds['can_approve']);
		$splitapprove = explode("::", $empapproveds[0]);
		$peopleappr = '';
		foreach ($splitapprove as $key => $split) {
			
			if (substr($split, 0, 8) == '1.20.512') {
				$query = Emp_data::where('id_emp', $split)->first(['nm_emp']);
				$peopleappr .= $query['nm_emp'];
			} else {
				$peopleappr .= $split;
			}
			$peopleappr .= '::';
		}

		$pegawai1 = Emp_data::where('is_jamc', '1')
                    ->orderBy('nm_emp')
                    ->get();

		return view('pages.bpadmedia.approve')
				->with('approveds', $peopleappr)
				->with('pegawai1', $pegawai1)
				->with('activemenus', $activemenus);
	}

	public function formsaveapprove (Request $request)
	{
		if(count($_SESSION) == 0) {
			return redirect('home');
		}
		
		$approve = '';

		if ($request->approve) {
			foreach ($request->approve as $key => $data) {
				$approve .= $data . "::";
			}
		}

        $approve .= "rp::valadmin::";

		Content_can_approve::where('can_approve', 'like', '%%')->delete();

		$query = [
				'updated_at'    => date('Y-m-d H:i:s'),
				'can_approve'   => $approve,
			];
		Content_can_approve::insert($query);

		return redirect('/media/approve')
					->with('success', 'Pegawai approval berhasil diubah');
	}

	// ---------------- APPROVE ------------------- //
}

	