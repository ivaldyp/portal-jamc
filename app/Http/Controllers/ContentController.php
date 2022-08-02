<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;
use App\Traits\TraitsCheckActiveMenu;

use App\Content_tb;
use App\Glo_kategori;
use App\Glo_subkategori;

class ContentController extends Controller
{
    public function berita(Request $request)
    {
        if (isset($request->cari)) {
			$cari = $request->cari;
		} else {
			$cari = '';
		}
        
		$beritas = Content_tb::
                    where('sts', 1)
					->where('idkat', 1)
					->where('appr', 'Y')
					->where('suspend', '')
					->whereRaw("judul like '%".$cari."%'")
					->orderBy('tanggal', 'desc')
					->paginate(10);
		$beritas->appends($request->only('cari'));

		$aside_top_view = Content_tb::take(3)
							->where('appr', 'Y')
							->where('sts', 1)
							->where('suspend', '')
							->where('idkat', 1)
							->orderBy('thits', 'desc')
							->get();

		$aside_recent = Content_tb::take(3)
							->where('appr', 'Y')
							->where('sts', 1)
							->where('suspend', '')
							->where('idkat', 1)
							->orderBy('tanggal', 'desc')
							->get();

        $needdarkerbgcolor = 1;

		return view('pages.bpadcontent.berita')
                ->with('cari', $cari)
				->with('beritas', $beritas)
				->with('aside_top_view', $aside_top_view)
				->with('aside_recent', $aside_recent)
				->with('needdarkerbgcolor', $needdarkerbgcolor);
    }

    public function beritasingle(Request $request)
    {
        $thiscontent = Content_tb::where('ids', $request->ids)->first();
        
        $aside_top_view = Content_tb::take(3)
							->where('appr', 'Y')
							->where('suspend', '')
							->where('idkat', 1)
							->where('sts', 1)
							->orderBy('thits', 'desc')
							->get();

		$aside_recent = Content_tb::take(3)
							->where('appr', 'Y')
							->where('suspend', '')
							->where('idkat', 1)
							->where('sts', 1)
							->orderBy('tanggal', 'desc')
							->get();

        return view ('pages.bpadcontent.berita-single')
            ->with('thiscontent', $thiscontent)
            ->with('aside_top_view', $aside_top_view)
            ->with('aside_recent', $aside_recent);
    }

    public function galeri(Request $request)
    {
        if (isset($request->cari)) {
			$cari = $request->cari;
		} else {
			$cari = '';
		}

		$subkat = $request->subkategori;
		
        $galeris = Content_tb::
					where('idkat', 5)
					->where('sts', 1)
					->where('appr', 'Y')
					->where('suspend', '')
					->whereRaw("judul like '%".$cari."%'")
					->orderBy('tgl', 'desc')
					->paginate(10);

		if (is_null($subkat)) {
			$galeris->where('subkat', $subkat);
		} 

		$galeris->appends($request->only('cari', 'subkategori'));
		
		$foto_kategori = Glo_subkategori::
						where('idkat', 5)
						->orderBy('urut_subkat', 'asc')
						->get();

		$aside_recent = Content_tb::take(3)
							->where('appr', 'Y')
							->where('suspend', '')
							->where('sts', 1)
							->where('idkat', 5)
							->orderBy('tgl', 'desc')
							->get();

        $needdarkerbgcolor = 1;

		return view('pages.bpadcontent.galeri')
				->with('galeris', $galeris)
				->with('foto_kategori', $foto_kategori)
				->with('aside_recent', $aside_recent)
				->with('subkat', $subkat)
				->with('cari', $cari)
				->with('needdarkerbgcolor', $needdarkerbgcolor);
    }
}
