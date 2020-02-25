<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Content_tb;
use App\Glo_subkategori;

session_start();

class ContentController extends Controller
{
    public function berita_all()
    {
        $berita_list = Content_tb::
                    where('idkat', 1)
                    ->where('appr', 'Y')
                    ->orderBy('ids', 'desc')
                    ->orderBy('tanggal', 'desc')
                    ->paginate(10);

        $aside_top_view = Content_tb::take(3)
                            ->where('appr', 'Y')
                            ->where('idkat', 1)
                            ->orderBy('thits', 'desc')
                            ->get();

        $aside_recent = Content_tb::take(3)
                            ->where('appr', 'Y')
                            ->where('idkat', 1)
                            ->orderBy('tanggal', 'desc')
                            ->get();

        return view('pages.berita.berita')
                ->with('berita_list', $berita_list)
                ->with('aside_top_view', $aside_top_view)
                ->with('aside_recent', $aside_recent);
    }

    public function berita_read($id)
    {
        $berita = Content_tb::
                    where('ids', $id)
                    ->first();

        $aside_top_view = Content_tb::take(3)
                            ->where('appr', 'Y')
                            ->where('idkat', 1)
                            ->orderBy('thits', 'desc')
                            ->get();

        $aside_recent = Content_tb::take(3)
                            ->where('appr', 'Y')
                            ->where('idkat', 1)
                            ->orderBy('tanggal', 'desc')
                            ->get();

        return view('pages.berita.beritasingle')
                ->with('berita', $berita)
                ->with('aside_top_view', $aside_top_view)
                ->with('aside_recent', $aside_recent);
    }

    public function foto_all(Request $request)
    {
        $subkat = $request->subkategori;
        if (is_null($subkat)) {
            $foto_list = Content_tb::
                    where('idkat', 5)
                    ->where('appr', 'Y')
                    ->orderBy('ids', 'desc')
                    ->orderBy('tanggal', 'desc')
                    ->paginate(10);
        } else {
            $foto_list = Content_tb::
                    where('idkat', 5)
                    ->where('subkat', $subkat)
                    ->where('appr', 'Y')
                    ->orderBy('ids', 'desc')
                    ->orderBy('tanggal', 'desc')
                    ->paginate(10);
        }
        
        $foto_kategori = Glo_subkategori::
                        where('idkat', 5)
                        ->orderBy('urut_subkat', 'asc')
                        ->get();

        $aside_recent = Content_tb::take(3)
                            ->where('appr', 'Y')
                            ->where('idkat', 5)
                            ->orderBy('tanggal', 'desc')
                            ->get();

        return view('pages.foto.foto')
                ->with('foto_list', $foto_list)
                ->with('foto_kategori', $foto_kategori)
                ->with('aside_recent', $aside_recent)
                ->with('subkat', $subkat);
    }

    public function foto_open($id)
    {   
        $foto = Content_tb::
                    where('ids', $id)
                    ->first();

        $aside_recent = Content_tb::take(3)
                            ->where('appr', 'Y')
                            ->where('idkat', 5)
                            ->orderBy('tanggal', 'desc')
                            ->get();

        return view('pages.foto.fotosingle')
                ->with('foto', $foto)
                ->with('aside_recent', $aside_recent);
    }

    public function video_all()
    {
        $video_list = Content_tb::
                    where('idkat', 12)
                    ->where('appr', 'Y')
                    ->orderBy('ids', 'desc')
                    ->orderBy('tanggal', 'desc')
                    ->paginate(15);

        $aside_top_view = Content_tb::take(3)
                            ->where('appr', 'Y')
                            ->where('idkat', 12)
                            ->orderBy('thits', 'desc')
                            ->get();

        return view('pages.video.video')
                ->with('video_list', $video_list)
                ->with('aside_top_view', $aside_top_view);
    }

    public function video_open($id)
    {
        $video = Content_tb::
                    where('ids', $id)
                    ->first();

        $aside_top_view = Content_tb::take(3)
                            ->where('appr', 'Y')
                            ->where('idkat', 12)
                            ->orderBy('thits', 'desc')
                            ->get();

        return view('pages.video.videosingle')
                ->with('video', $video)
                ->with('aside_top_view', $aside_top_view);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
