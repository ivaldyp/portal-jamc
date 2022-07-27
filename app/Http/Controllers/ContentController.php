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
}
