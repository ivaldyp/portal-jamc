<?php

namespace App\Http\Controllers;

use Cookie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;

use App\Emp_data;
use App\Sec_access;
use App\Sec_logins;
use App\Sec_menu;

session_start();

class HomeController extends Controller
{
    use SessionCheckTraits;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function display_menus($query, $parent, $level = 0)
    {
        $query = Sec_menu::
                join('sec_access', 'sec_access.idtop', '=', 'sec_menu.ids')
                ->where('sec_menu.tipe', 'l')
                ->whereRaw('LEN(sec_menu.urut) = 1')
                ->where('sec_access.idgroup', $_SESSION['user_data']['idgroup'])
                ->where('sec_access.zviw', 'y')
                ->where('sec_menu.sao', $parent)
                ->orderByRaw('CONVERT(INT, sec_menu.sao)')
                ->orderBy('sec_menu.urut')
                ->get();

        $result = '';
        $link = '';
        $arrLevel = ['<ul class="nav" id="side-menu">', '<ul class="nav nav-second-level">', '<ul class="nav nav-third-level">', '<ul class="nav nav-fourth-level">'];

        if (count($query) > 0) {

            $result .= $arrLevel[$level];
        
            foreach ($query as $menu) {
                if (is_null($menu['urlnew'])) {
                    $link = 'javascript:void(0)';
                } else {
                    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
                        $link = "https"; 
                    else
                        $link = "http"; 
                      
                    $link .= "://";       
                    $link .= $_SERVER['HTTP_HOST']; 
                    $link .= $menu['urlnew'];
                }

                if ($menu['child'] == 0) {
                    $result .= '<li> <a href="'.$link.'" class="waves-effect"><i class="fa '. (($menu['iconnew'])? $menu['iconnew'] :'').' fa-fw"></i> <span class="hide-menu">'.$menu['desk'].'</span></a></li>';
                    
                } elseif ($menu['child'] == 1) {
                    $result .= '<li> <a href="'.$link.'" class="waves-effect"><i class="fa '. (($menu['iconnew'])? $menu['iconnew'] :'').' fa-fw"></i> <span class="hide-menu">'.$menu['desk'].'<span class="fa arrow"></span></span></a>';
                    
                    $result .= $this->display_menus($query, $menu['ids'], $level+1);

                    $result .= '</li>';
                }
            }

            $result .= '</ul>';
        }
        return $result;
    }

    public function index(Request $request)
    {
        $this->checkSessionTime();
        
        if (is_null(Auth::user()->usname)) {
            $iduser = Auth::user()->id_emp;

            $user_data = Emp_data::
                            where('id_emp', $iduser)
                            ->first();
        } else {
            $iduser = Auth::user()->usname;

            $user_data = Sec_logins::
                            where('usname', $iduser)
                            ->first();
        }

        $user_access = Sec_menu::
                    join('sec_access', 'sec_access.idtop', '=', 'sec_menu.ids')
                    ->where('sec_menu.tipe', 'l')
                    ->whereRaw('LEN(sec_menu.urut) = 1')
                    ->where('sec_access.idgroup', $user_data['idgroup'])
                    ->where('sec_access.zviw', 'y')
                    ->orderByRaw('CONVERT(INT, sec_menu.sao)')
                    ->orderBy('sec_menu.urut')
                    ->get();
 
        $_SESSION['user_data'] = $user_data;
        $_SESSION['access'] = $user_access;

        $all_menu = [];

        $menus = $this->display_menus($all_menu, 0, 0);

        $_SESSION['menus'] = $menus;
 
        return view('home')
                ->with('iduser', $iduser);
    }
}
