<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Content_tb;
use App\Glo_kategori;
use App\Help;
use App\Produk_aset;
use App\Setup_tb;
use App\Fr_disposisi;

session_start();

class LandingController extends Controller
{
	public function index(Request $request)
	{
		// if ($request->yearnow) {
		// 	$yearnow = (int)$request->yearnow;
		// } else {
		// 	$yearnow = (int)date('Y');
		// }

		// if ($request->monthnow) {
		// 	$monthnow = (int)$request->monthnow;
		// } else {
		// 	$monthnow = (int)date('m');
		// }

		// if ($request->signnow) {
		// 	$signnow = $request->signnow;
		// } else {
		// 	$signnow = "=";
		// }

		// if ($request->searchnow) {
		// 	$qsearchnow = "and (kd_surat = '".$request->searchnow."' or no_form = '".$request->searchnow."' or perihal like '%".$request->searchnow."%' or asal_surat like '%".$request->searchnow."%')";
		// } else {
		// 	$qsearchnow = "";
		// }

		return view('index');
	}

	public function logout()
	{
		unset($_SESSION['user_data']);
		Auth::logout();
		return redirect('/');
	}	
}