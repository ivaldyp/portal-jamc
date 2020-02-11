<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sec_menu;

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
    public function index()
    {
        $sec_menu = Sec_menu::
                    where('sao', '')
                    ->where('tipe', 'l')
                    ->whereRaw('LEN(urut) = 1')
                    ->orderBy('urut')
                    ->get();

        return view('home')->with('sec_menu', $sec_menu);
    }
}
