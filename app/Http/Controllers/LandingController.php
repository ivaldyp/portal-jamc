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

        $jamc_pegawais = DB::select( DB::raw("
        SELECT count(*) as total_pegawai FROM bpaddtfake.dbo.emp_data as a
        CROSS APPLY (SELECT TOP 1 tmt_jab,idskpd,idunit,idlok,tmt_sk_jab,no_sk_jab,jns_jab,replace(idjab,'NA::','') as idjab,eselon,gambar FROM  bpaddtfake.dbo.emp_jab WHERE a.id_emp=emp_jab.noid AND emp_jab.sts='1' ORDER BY tmt_jab DESC) tbjab
        CROSS APPLY (SELECT TOP 1 * FROM bpaddtfake.dbo.glo_org_unitkerja WHERE glo_org_unitkerja.kd_unit = tbjab.idunit) tbunit
        ,bpaddtfake.dbo.glo_skpd as b,bpaddtfake.dbo.glo_org_unitkerja as c,bpaddtfake.dbo.glo_org_lokasi as d WHERE tbjab.idskpd=b.skpd AND tbjab.idskpd+'::'+tbjab.idunit=c.kd_skpd+'::'+c.kd_unit AND tbjab.idskpd+'::'+tbjab.idlok=d.kd_skpd+'::'+d.kd_lok AND a.sts='1' AND b.sts='1' AND c.sts='1' AND d.sts='1'
        and ked_emp = 'aktif' and tgl_end is null
        and a.sts = 1
        and tbunit.kd_unit like '010108%'
        "))[0];
        $jamc_pegawais = json_decode(json_encode($jamc_pegawais), true);

		return view('index')
				->with('beritas', $beritas)
                ->with('galeris', $galeris)
                ->with('jamc_pegawais', $jamc_pegawais);
	}

	public function logout()
	{
		unset($_SESSION['user_jamcportal']);
        unset($_SESSION['menus_jamcportal']);
		Auth::logout();
		return redirect('/');
	}	
}