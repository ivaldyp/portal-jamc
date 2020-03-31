<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;

use App\Agenda_tb;
use App\Berita_tb;

session_start();

class InternalController extends Controller
{
	use SessionCheckTraits;

	public function __construct()
	{
		$this->middleware('auth');
	}

	// ========== <AGENDA> ========== //
    
    public function agenda()
    {
    	$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 57);

		$agendas = Agenda_tb::limit(200)->get();

		return view('pages.bpadinternal.agenda')
				->with('access', $access)
				->with('agendas', $agendas);
    }

    // ========== </AGENDA> ========== //

    // ========== <BERITA> ========== //

    public function berita()
    {
    	$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 39);

		$beritas = Berita_tb::limit(200)->get();

		return view('pages.bpadinternal.berita')
				->with('access', $access)
				->with('beritas', $beritas);
    }

    // ========== </BERITA> ========== //
}
