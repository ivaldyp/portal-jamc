<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;

use App\Sec_access;
use App\Sec_menu;

session_start();

class SecurityController extends Controller
{
	use SessionCheckTraits;

	public function grupall()
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 4);
		
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

		$all_menu = Sec_menu::
					join('sec_access', 'sec_access.idtop', '=', 'sec_menu.ids')
					// ->where('sec_menu.sao', 'not like', '')
					->where('sec_menu.tipe', 'l')
					->whereRaw('LEN(sec_menu.urut) = 1')
					->where('sec_access.idgroup', $_SESSION['user_data']['idgroup'])
					->where('sec_access.zviw', 'y')
					->where('sao', '<', 10)
					->orderByRaw('CONVERT(INT, sec_menu.sao)')
					->orderBy('sec_menu.urut')
					->get('desk', 'ids', 'sao');

		// $menus = '';
		$menus = buildTreea($sec_menu);
		echo "<pre>";
		var_dump($menus);
		die();

		$groups = Sec_access::
					distinct('idgroup')
					->get('idgroup');

		return view('pages.bpadsecurity.grupuser')
				->with('access', $access)
				->with('groups', $groups)
				->with('sec_menu', $sec_menu)
				->with('sec_menu_child', $sec_menu_child);
	}

	public function grupubah()
	{
		$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 4);
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

		return view('pages.bpadsecurity.ubahgrup')
				->with('access', $access)
				->with('groups', $groups)
				->with('sec_menu', $sec_menu)
				->with('sec_menu_child', $sec_menu_child);
	}
}
