<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;
use App\Traits\TraitsCheckActiveMenu;

use App\Emp_data;
use App\Sec_access;
use App\Sec_logins;
use App\Sec_menu;

session_start();

class HomeController extends Controller
{
	use SessionCheckTraits;
    use TraitsCheckActiveMenu;

	public function __construct()
	{
		$this->middleware('auth');
		set_time_limit(300);
	}

	public function display_menus($query, $parent, $level = 0, $idgroup)
	{
		if ($parent == 0) {
			$sao = "(sao = 0 or sao is null or sao like '')";
		} else {
			$sao = "(sao = ".$parent.")";
		}
							
		$query = DB::select( DB::raw("
                    SELECT *
					FROM bpadjamc.dbo.sec_menu
					JOIN bpadjamc.dbo.sec_access ON bpadjamc.dbo.sec_access.idtop = bpadjamc.dbo.sec_menu.ids
					WHERE bpadjamc.dbo.sec_access.idgroup = '$idgroup'
					AND bpadjamc.dbo.sec_access.zviw = 'y'
					AND $sao
					AND bpadjamc.dbo.sec_menu.tampilnew = 1
					ORDER BY bpadjamc.dbo.sec_menu.urut
					"));
		$query = json_decode(json_encode($query), true);

        // $query = Sec_menu::
        //         where('tampilnew', 1)
        //         ->whereRaw($sao)
        //         ->orderBy('urut', 'ASC')
        //         ->get();

		$result = '';

		$link = '';
		// $arrLevel = ['<ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent" id="side-menu" data-widget="treeview" role="menu" data-accordion="false">', '<ul class="nav nav-treeview nav-second-level">', '<ul class="nav nav-treeview nav-third-level">', '<ul class="nav nav-treeview nav-fourth-level">', '<ul class="nav nav-treeview nav-fifth-level">'];
		$arrLevel = ['<ul class="nav nav-pills nav-sidebar flex-column" id="side-menu" data-widget="treeview" role="menu" data-accordion="false">', '<ul class="nav nav-treeview nav-second-level">', '<ul class="nav nav-treeview nav-third-level">', '<ul class="nav nav-treeview nav-fourth-level">', '<ul class="nav nav-treeview nav-fifth-level">'];

		if (count($query) > 0) {

			$result .= $arrLevel[$level];

			// if ($level == 0) {
			// 	$result .= '<li id="li_bmddki"> <a href="/bmddki" class="waves-effect"> <i class="fa fa-globe fa-fw"></i> <span class="hide-menu">Portal BPAD</span></a></li>';
			// }
		
			foreach ($query as $menu) {
				if (is_null($menu['urlnew'])) {
					$link = 'javascript:void(0)';
				} elseif (substr($menu['urlnew'], 0, 4) == 'http') {
					$link = $menu['urlnew'];
				} else {
					if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
						$link = "https"; 
					else
						$link = "http"; 
					  
					$link .= "://";       
					$link .= $_SERVER['HTTP_HOST'];
                    $link .= "/".config('app.name'); 
					$link .= $menu['urlnew'];
				}

				if ($menu['child'] == 0) {
					$result .= '<li class="nav-item menu-li-'.$menu['ids'].'"> <a href="'.$link.'" class="waves-effect nav-link menu-a-'.$menu['ids'].' "><i class="fa '. (($menu['iconnew'])? $menu['iconnew'] :'fa-caret-right').' nav-icon"></i> <p>'.$menu['desk'].'</p></a></li>';
					
				} elseif ($menu['child'] == 1) {
					$result .= '<li class="nav-item menu-li-'.$menu['ids'].'"> <a href="'.$link.'" class="waves-effect nav-link menu-a-'.$menu['ids'].' "><i class="fa '. (($menu['iconnew'])? $menu['iconnew'] :'fa-caret-right').' nav-icon"></i> <p>'.$menu['desk'].'<i class="fa fa-angle-left right"></i></p></a>';
					
					$result .= $this->display_menus($query, $menu['ids'], $level+1, $idgroup);
					
					$result .= '</li>';
				}
			}
			
			$result .= '</ul>';
		}
		return $result;
	}

	public function password(Request $request)
	{
		if (Auth::user()->id_emp) {
			$ids = Auth::user()->id_emp;

			Emp_data::
			where('id_emp', $ids)
			->update([
				'passmd5' => md5($request->passmd5),
			]);
		} else {
			$ids = Auth::user()->usname;

			Sec_logins::
			where('usname', $ids)
			->update([
				'passmd5' => md5($request->passmd5),
			]);
		}

		return redirect('/home')
					->with('message', 'Password berhasil diubah')
					->with('msg_num', 1);
	}

	public function index(Request $request)
	{
		$this->checkSessionTime();

        $activemenus = $this->checkactivemenu(config('app.name'), url()->current()); 
		
		unset($_SESSION['user_jamcportal']);

		date_default_timezone_set('Asia/Jakarta');
		
		if (is_null(Auth::user()->usname)) {
			$iduser = Auth::user()->id_emp;

			$user_data = DB::select( DB::raw("
            SELECT a.* FROM bpaddtfake.dbo.emp_data as a
            CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  bpaddtfake.dbo.emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
            CROSS APPLY (SELECT TOP 1 * FROM bpaddtfake.dbo.glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
            ,bpaddtfake.dbo.glo_skpd as b,bpaddtfake.dbo.glo_org_unitkerja as c,bpaddtfake.dbo.glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1'
            and ked_emp = 'aktif' and tgl_end is null
            and id_emp = '".Auth::user()->id_emp."'
			"))[0];

			$user_data = json_decode(json_encode($user_data), true);

			Emp_data::where('id_emp', $user_data['id_emp'])
			->update([
				'lastlogin' => date('Y-m-d H:i:s'),
			]);	
		} else {
			$iduser = Auth::user()->usname;

			$user_data = Sec_logins::
							where('usname', $iduser)
							->first();

			Sec_logins::where('usname', $user_data['usname'])
			->update([
				'lastlogin' => date('Y-m-d H:i:s'),
			]);	
		}

		$_SESSION['user_jamcportal'] = $user_data;

		$all_menu = [];

		$menus = $this->display_menus($all_menu, 0, 0, $_SESSION['user_jamcportal']['idgroup']);

		$_SESSION['menus_jamcportal'] = $menus;

		return view('home')
				->with('iduser', $iduser)
                ->with('activemenus', $activemenus);
	}
}
