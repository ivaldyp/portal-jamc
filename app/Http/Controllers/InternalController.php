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

		$agendas = Agenda_tb::limit(200)
					->orderBy('ids', 'desc')
					->get();

		return view('pages.bpadinternal.agenda')
				->with('access', $access)
				->with('agendas', $agendas);
    }

    public function agendatambah()
    {
    	$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 57);

		return view('pages.bpadinternal.agendatambah')
				->with('access', $access);
    }

    public function agendaubah(Request $request)
    {
    	$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 57);

		$agenda = Agenda_tb::
					where('ids', $request->ids)
					->first();

		return view('pages.bpadinternal.agendaubah')
				->with('access', $access)
				->with('ids', $request->ids)
				->with('agenda', $agenda);
    }

    public function formappragenda(Request $request)
    {
    	$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 57);

		Agenda_tb::where('ids', $request->ids)
			->update([
				'appr' => $request->appr,
			]);

		if ($request->appr == 'Y') {
			$message = 'Berhasil menyetujui agenda';
		} else {
			$message = 'Berhasil membatalkan persetujuan agenda';
		}

		return redirect('/internal/agenda')
				->with('message', $message)
				->with('msg_num', 1);
    }

    public function forminsertagenda(Request $request)
    {
    	$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 57);

		$fileagenda = '';

		if (isset($request->dfile)) {
			$file = $request->dfile;

			if ($file->getSize() > 5500000) {
				return redirect('/internal/agenda tambah')->with('message', 'Ukuran file terlalu besar (Maksimal 5MB)');     
			} 

			$fileagenda .= $file->getClientOriginalName();

			$tujuan_upload = config('app.savefileagenda');
			$file->move($tujuan_upload, $fileagenda);
		}
			
		if (!(isset($fileagenda))) {
			$fileagenda = '';
		}

		$inputipe = '';
		if ($request->tipe) {
			foreach ($request->tipe as $tipe) {
				$inputipe .= $tipe . ',';
			}
		}

		$insertagenda = [
			'sts' => 1,
			'uname'     => (Auth::user()->usname ? Auth::user()->usname : Auth::user()->id_emp),
			'tgl'       => date('Y-m-d H:i:s'),
			'ip'        => '',
			'logbuat'   => '',
			'kd_skpd' => '1.20.512',
			'dtanggal' => date('Y-m-d H:i:s',strtotime(str_replace('/', '-', $request->dtanggal))),
			'ddesk' => ($request->ddesk ? $request->ddesk : ''),
			'tipe' => $inputipe,
			'dfile' => $fileagenda,
			'an' => $request->an,
			'appr' => 'N',
			'usrinput' => $request->usrinput,
			'thits' => 0,
		];

		Agenda_tb::insert($insertagenda);

		return redirect('/internal/agenda')
				->with('message', 'Agenda baru berhasil dibuat')
				->with('msg_num', 1);
    }

    public function formupdateagenda(Request $request)
    {
    	$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 57);

		$fileagenda = '';

		if (isset($request->dfile)) {
			$file = $request->dfile;

			if ($file->getSize() > 5500000) {
				return redirect('/internal/agenda tambah')->with('message', 'Ukuran file terlalu besar (Maksimal 5MB)');     
			} 

			$fileagenda .= $file->getClientOriginalName();

			$tujuan_upload = config('app.savefileagenda');
			$file->move($tujuan_upload, $fileagenda);
		}
			
		if (!(isset($fileagenda))) {
			$fileagenda = '';
		}

		$inputipe = '';
		if ($request->tipe) {
			foreach ($request->tipe as $tipe) {
				$inputipe .= $tipe . ',';
			}
		}

		Agenda_tb::where('ids', $request->ids)
					->update([
						'dtanggal' => date('Y-m-d H:i:s',strtotime(str_replace('/', '-', $request->dtanggal))),
						'ddesk' => ($request->ddesk ? $request->ddesk : ''),
						'tipe' => $inputipe,
					]);

		if($fileagenda != '') {
			Agenda_tb::where('ids', $request->ids)
			->update([
				'dfile' => $fileagenda,
			]);
		}

		return redirect('/internal/agenda')
				->with('message', 'Agenda berhasil diubah')
				->with('msg_num', 1);
    }

    public function formdeleteagenda(Request $request)
    {
    	$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 57);

		Agenda_tb::
				where('ids', $request->ids)
				->delete();

		$filepath = '';
		$filepath .= config('app.savefileagenda');
		$filepath .= '/' . $request->dfile;

		if ($request->dfile) {
			unlink($filepath);
		}

		return redirect('/internal/agenda')
					->with('message', 'Agenda berhasil dihapus')
					->with('msg_num', 1);
    }

    // ========== </AGENDA> ========== //

    // ========== <BERITA> ========== //

    public function berita()
    {
    	$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 39);

		$beritas = Berita_tb::limit(200)
					->orderBy('ids', 'desc')
					->get();

		return view('pages.bpadinternal.berita')
				->with('access', $access)
				->with('beritas', $beritas);
    }

    public function beritatambah()
    {
    	$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 39);

		return view('pages.bpadinternal.beritatambah')
				->with('access', $access);
    }

    public function beritaubah(Request $request)
    {
    	$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 39);

		$berita = Berita_tb::
					where('ids', $request->ids)
					->first();

		return view('pages.bpadinternal.beritaubah')
				->with('access', $access)
				->with('ids', $request->ids)
				->with('berita', $berita);
    }

    public function formapprberita(Request $request)
    {
    	$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 39);

		Berita_tb::where('ids', $request->ids)
			->update([
				'appr' => $request->appr,
			]);

		if ($request->appr == 'Y') {
			$message = 'Berhasil menyetujui berita';
		} else {
			$message = 'Berhasil membatalkan persetujuan berita';
		}

		return redirect('/internal/berita')
				->with('message', $message)
				->with('msg_num', 1);
    }

    public function forminsertberita(Request $request)
    {
    	$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 39);

		if (is_null($request->isi)) {
			$isi = '';
		} else {
			$isi = $request->isi;
		}

		$insertberita = [
			'sts' => 1,
			'uname'     => (Auth::user()->usname ? Auth::user()->usname : Auth::user()->id_emp),
			'tgl'       => date('Y-m-d H:i:s'),
			'ip'        => '',
			'logbuat'   => '',
			'kd_skpd' => '1.20.512',
			'tanggal' => date('Y-m-d H:i:s',strtotime(str_replace('/', '-', $request->tanggal))),
			'an' => $request->an,
			'isi' => htmlentities($isi),
			'tipe' => $request->tipe,
			'appr' => 'N',
			'usrinput' => $request->usrinput,
		];

		Berita_tb::insert($insertberita);

		return redirect('/internal/berita')
				->with('message', 'Berita baru berhasil dibuat')
				->with('msg_num', 1);
    }

    public function formupdateberita(Request $request)
    {
    	$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 39);

		Berita_tb::where('ids', $request->ids)
					->update([
						'tanggal' => date('Y-m-d H:i:s',strtotime(str_replace('/', '-', $request->tanggal))),
						'isi' => htmlentities($request->isi),
						'tipe' => $request->tipe,
					]);

		return redirect('/internal/berita')
				->with('message', 'Berita berhasil diubah')
				->with('msg_num', 1);
    }

    public function formdeleteberita(Request $request)
    {
    	$this->checkSessionTime();
		$access = $this->checkAccess($_SESSION['user_data']['idgroup'], 39);

		Berita_tb::
				where('ids', $request->ids)
				->delete();

		return redirect('/internal/berita')
					->with('message', 'Berita berhasil dihapus')
					->with('msg_num', 1);
    }

    // ========== </BERITA> ========== //
}
