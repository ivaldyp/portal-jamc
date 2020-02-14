<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Sec_access;
use App\Sec_menu;

session_start();

class SecurityController extends Controller
{
    public function grupall()
    {
    	$sec_menu = Sec_menu::
	                join('sec_access', 'sec_access.idtop', '=', 'sec_menu.ids')
	                ->where('sec_menu.sao', '')
	                ->where('sec_menu.tipe', 'l')
	                ->whereRaw('LEN(sec_menu.urut) = 1')
	                ->where('sec_access.idgroup', $_SESSION['user_data']['idgroup'])
	                ->where('sec_access.zviw', 'y')
	                ->orderByRaw('CONVERT(INT, sec_menu.sao)')
	                ->orderBy('sec_menu.urut')
	                ->get();

	    $sec_menu_child = Sec_menu::
	                join('sec_access', 'sec_access.idtop', '=', 'sec_menu.ids')
	                ->where('sec_menu.sao', 'not like', '')
	                ->where('sec_menu.tipe', 'l')
	                ->whereRaw('LEN(sec_menu.urut) = 1')
	                ->where('sec_access.idgroup', $_SESSION['user_data']['idgroup'])
	                ->where('sec_access.zviw', 'y')
	                ->orderByRaw('CONVERT(INT, sec_menu.sao)')
	                ->orderBy('sec_menu.urut')
	                ->get();

    	$groups = Sec_access::
    				distinct('idgroup')
    				->get('idgroup');

    	return view('pages.bpadsecurity.grupuser')
                ->with('groups', $groups)
                ->with('sec_menu', $sec_menu)
                ->with('sec_menu_child', $sec_menu_child);
    }
}
