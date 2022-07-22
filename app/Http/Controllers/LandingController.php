<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Content_tb;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Content;

session_start();

class LandingController extends Controller
{
	public function index2(Request $request)
	{
        $beritas = Content_tb::
        where('sts', 1)
        ->where('idkat', 1)
        ->where('appr', 'Y')
        ->where('suspend', '')
        ->orderBy('tanggal', 'desc')
        ->offset(0)->limit(4)
        ->get();

        $galeris = Content_tb::
        where('sts', 1)
        ->where('idkat', 5)
        ->where('appr', 'Y')
        ->where('suspend', '')
        ->orderBy('tanggal', 'desc')
        ->offset(0)->limit(4)
        ->get();

		return view('index')
				->with('beritas', $beritas)
                ->with('galeris', $galeris);
	}

    public function index(Request $request)
	{
        $beritas = Content_tb::
        where('sts', 1)
        ->where('idkat', 1)
        ->where('appr', 'Y')
        ->where('suspend', '')
        ->orderBy('tanggal', 'desc')
        ->offset(0)->limit(4)
        ->get();

        $galeris = Content_tb::
        where('sts', 1)
        ->where('idkat', 5)
        ->where('appr', 'Y')
        ->where('suspend', '')
        ->orderBy('tanggal', 'desc')
        ->offset(0)->limit(6)
        ->get();

		return view('index-mega')
				->with('beritas', $beritas)
                ->with('galeris', $galeris);
	}

	public function logout()
	{
		unset($_SESSION['user_jamcportal']);
        unset($_SESSION['menus_jamcportal']);
		Auth::logout();
		return redirect('/');
	}	
}