<?php

namespace App\Http\Controllers;

use Cookie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
// use Symfony\Component\HttpFoundation\Cookie;

use App\Emp_data;
use App\Sec_access;
use App\Sec_logins;
use App\Sec_menu;

session_start();

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
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

        $sec_menu = Sec_menu::
                    join('sec_access', 'sec_access.idtop', '=', 'sec_menu.ids')
                    ->where('sec_menu.sao', '')
                    ->where('sec_menu.tipe', 'l')
                    ->whereRaw('LEN(sec_menu.urut) = 1')
                    ->where('sec_access.idgroup', $user_data['idgroup'])
                    ->where('sec_access.zviw', 'y')
                    ->orderByRaw('CONVERT(INT, sec_menu.sao)')
                    ->orderBy('sec_menu.urut')
                    ->get();

        $sec_menu_child = Sec_menu::
                    join('sec_access', 'sec_access.idtop', '=', 'sec_menu.ids')
                    ->where('sec_menu.sao', 'not like', '')
                    ->where('sec_menu.tipe', 'l')
                    ->whereRaw('LEN(sec_menu.urut) = 1')
                    ->where('sec_access.idgroup', $user_data['idgroup'])
                    ->where('sec_access.zviw', 'y')
                    ->orderByRaw('CONVERT(INT, sec_menu.sao)')
                    ->orderBy('sec_menu.urut')
                    ->get();

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

        return view('home')
                ->with('iduser', $iduser)
                ->with('sec_menu', $sec_menu)
                ->with('sec_menu_child', $sec_menu_child);
    }
}
