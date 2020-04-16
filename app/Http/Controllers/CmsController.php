<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;

use App\Content_tb;
use App\Glo_kategori;
use App\Glo_subkategori;
use App\Sec_access;
use App\Sec_menu;

session_start();

class CmsController extends Controller
{
    use SessionCheckTraits;

    public function __construct()
    {
        $this->middleware('auth');
    }

    // ------------------ MENU ------------------ //

    public function display_roles($query, $idgroup, $access, $parent, $level = 0)
    {
        $query = Sec_menu::
                where('sao', $parent)
                ->orderBy('urut')
                ->orderBy('ids')
                ->get();

        $result = '';

        if (count($query) > 0) {
            foreach ($query as $menu) {
                $padding = ($level * 20) + 8;
                $result .= '<tr style="background-color:">
                                <td class="col-md-1">'.$level.'</td>
                                <td class="col-md-1">'.$menu['ids'].'</td>
                                <td style="padding-left:'.$padding.'px; '.(($level == 0) ? 'font-weight: bold;"' : '').'">'.$menu['desk'].' '.(($menu['child'] == 1)? '<i class="fa fa-arrow-down"></i>' : '').'</td>
                                <td>'.($menu['zket'] ? $menu['zket'] : '-').'</td>
                                <td>'.($menu['iconnew'] ? $menu['iconnew'] : '-').'</td>
                                <td>'.($menu['urlnew'] ? $menu['urlnew'] : '-').'</td>
                                <td class="text-center">'.intval($menu['urut']).'</td>
                                <td class="text-center">'.(($menu['child'] == 1)? '<i style="color:green;" class="fa fa-check"></i>' : '<i style="color:red;" class="fa fa-times"></i>').'</td>
                                <td class="text-center">'.(($menu['tampilnew'] == 1)? '<i style="color:green;" class="fa fa-check"></i>' : '<i style="color:red;" class="fa fa-times"></i>').'</td>
                                
                                '.(($access['zadd'] == 'y') ? 
                                    '<td class="text-center"><button type="button" class="btn btn-success btn-insert" data-toggle="modal" data-target="#modal-insert" data-ids="'.$menu['ids'].'" data-desk="'.$menu['desk'].'"><i class="fa fa-plus"></i></button></td>'
                                : '' ).'


                                '.(($access['zupd'] == 'y' || $access['zdel'] == 'y') ? 
                                    '<td class="col-md-2">
                                        '.(($access['zupd'] == 'y') ? 
                                            '<button type="button" class="btn btn-info btn-update" data-toggle="modal" data-target="#modal-update" data-ids="'.$menu['ids'].'" data-desk="'.$menu['desk'].'" data-child="'.$menu['child'].'" data-iconnew="'.$menu['iconnew'].'" data-urlnew="'.$menu['urlnew'].'" data-urut="'.$menu['urut'].'" data-tampilnew="'.$menu['tampilnew'].'" data-zket="'.$menu['zket'].'"><i class="fa fa-edit"></i></button>'
                                        : '').'
                                        '.(($access['zdel'] == 'y') ? 
                                            '<button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#modal-delete" data-ids="'.$menu['ids'].'" data-sao="'.$menu['sao'].'" data-desk="'.$menu['desk'].'"><i class="fa fa-trash"></i></button>'
                                        : '').'
                                    </td>'
                                : '' ).'
                                
                            </tr>';

                if ($menu['child'] == 1) {
                    $result .= $this->display_roles($query, $idgroup, $access, $menu['ids'], $level+1);
                }
            }
        }
        return $result;
    }

    public function menuall(Request $request)
    {
        $this->checkSessionTime();
        $access = $this->checkAccess($_SESSION['user_data']['idgroup'], 25);

        $all_menu = [];

        $menus = $this->display_roles($all_menu, $request->name, $access, 0);
        
        return view('pages.bpadcms.menu')
                ->with('access', $access)
                ->with('menus', $menus);
    }

    public function forminsertmenu(Request $request)
    {
        $this->checkSessionTime();

        $maxids = Sec_menu::max('ids');
        $urut = intval(Sec_menu::where('sao', $request->sao)
                ->max('urut'));

        if ($request->urut) {
            $urut = $request->urut;
        } else {
            if (is_null($urut)) {
                $urut = 1;
            } else {
                $urut = $urut + 1;
            }
        }

        $request->sao == 0 ? $sao = '' : $sao = $request->sao;

        $insert = [
                'uname'     => Auth::user()->usname,
                'tgl'       => date('Y-m-d H:i:s'),
                'ip'        => '',
                'logbuat'   => '',
                'suspend'   => '',
                'urut'      => $urut,
                'desk'      => $request->desk,
                'validat'   => '',
                'isi'       => '',
                'ipserver'  => '',
                'child'     => 0,
                'sao'       => $sao,
                'tipe'      => '',
                'icon'      => '',
                'zfile'     => '',
                'zket'      => $request->zket,
                'iconnew'   => $request->iconnew,
                'urlnew'    => $request->urlnew,
                'tampilnew' => $request->tampilnew,
            ];

        if (Sec_menu::insert($insert) && $sao > 0) {
            $query = Sec_menu::
                        where('ids', $sao)
                        ->update([
                            'child' => 1,
                        ]);
        }

        $idgroups = Sec_access::
                    distinct('idgroup')
                    ->orderBy('idgroup', 'asc')
                    ->get('idgroup');

        $result = array();
        $thisid = Sec_menu::max('ids');
        foreach ($idgroups as $key => $group) {
            array_push($result, [
                'idgroup' => $group['idgroup'],
                'idtop' => $thisid,
            ]);
        }
        Sec_access::insert($result);

        return redirect('/cms/menu')
                    ->with('message', 'Menu '.$request->desk.' berhasil ditambah')
                    ->with('msg_num', 1);
    }

    public function formupdatemenu(Request $request)
    {
        $this->checkSessionTime();

        Sec_menu::
            where('ids', $request->ids)
            ->update([
                'desk'      => $request->desk,
                'zket'      => $request->zket,
                'urut'      => $request->urut,
                'iconnew'   => $request->iconnew,
                'urlnew'    => $request->urlnew,
                'tampilnew' => $request->tampilnew
            ]);

        return redirect('/cms/menu')
                    ->with('message', 'Menu '.$request->desk.' berhasil diubah')
                    ->with('msg_num', 1);
    }

    public function formdeletemenu(Request $request)
    {
        $this->checkSessionTime();

        // hapus semua child menu dari tabel access
        $childids = Sec_menu::
                    where('sao', $request->ids)
                    ->get('ids');

        foreach ($childids as $id) {
            Sec_access::
            where('idtop', $id['ids'])
            ->delete();
        }

        // hapus semua child menu dari tabel menu
        $deletechild = Sec_menu::
                    where('sao', $request->ids)
                    ->delete();

        // hapus menu dari tabel access
        $deletechildaccess = Sec_access::
                                where('idtop', $request->ids)
                                ->delete();

        // hapus menu dari tabel menu
        $delete = Sec_menu::
                    where('ids', $request->ids)
                    ->delete();

        $cekchild = Sec_menu::
                    where('sao', $request->sao)
                    ->count();

        if ($cekchild == 0) {
            $updatechild = Sec_menu::
                            where('ids', $request->sao)
                            ->update([
                                'child' => 0,
                            ]);
        }

        return redirect('/cms/menu')
                    ->with('message', 'Menu '.$request->desk.' berhasil dihapus')
                    ->with('msg_num', 1);
    }

    // ------------------ MENU ------------------ //

    // ------------------------------------------ //

    // ---------------- KATEGORI ---------------- //

    public function kategoriall(Request $request)
    {
        $this->checkSessionTime();
        $access = $this->checkAccess($_SESSION['user_data']['idgroup'], 28);

        $kategoris = Glo_kategori::
                        orderBy('ids')
                        ->get();
        
        return view('pages.bpadcms.kategori')
                ->with('access', $access)
                ->with('kategoris', $kategoris);
    }

    public function forminsertkategori(Request $request)
    {
        $this->checkSessionTime();

        $result = [
                'sts'       => $request->sts,
                'nmkat'     => $request->nmkat,
            ];

        Glo_kategori::insert($result);

        return redirect('/cms/kategori')
                    ->with('message', 'kategori '.$request->desk.' berhasil ditambah')
                    ->with('msg_num', 1);
    }

    public function formupdatekategori(Request $request)
    {
        $this->checkSessionTime();

        Glo_kategori::
            where('ids', $request->ids)
            ->update([
                'nmkat' => $request->nmkat,
                'sts'   => $request->sts,
            ]);

        return redirect('/cms/kategori')
                    ->with('message', 'Kategori '.$request->nmkat.' berhasil diubah')
                    ->with('msg_num', 1);
    }

    public function formdeletekategori(Request $request)
    {
        $this->checkSessionTime();

        // hapus menu dari tabel kategori
        $delete = Glo_kategori::
                    where('ids', $request->ids)
                    ->delete();

        return redirect('/cms/kategori')
                    ->with('message', 'Kategori '.$request->nmkat.' berhasil dihapus')
                    ->with('msg_num', 1);
    }

    // ------------------ KATEGORI ------------------ //

    // ---------------------------------------------- //

    // ---------------- SUB KATEGORI ---------------- //

    public function subkategoriall(Request $request)
    {
        $this->checkSessionTime();
        $access = $this->checkAccess($_SESSION['user_data']['idgroup'], 28);

        $subkats = Glo_subkategori::
                    join('bpaddtfake.dbo.glo_kategori', 'bpaddtfake.dbo.glo_kategori.ids', '=', 'bpaddtfake.dbo.glo_subkategori.idkat')
                    ->get();

        $subkatsid =    Glo_subkategori::
                        join('bpaddtfake.dbo.glo_kategori', 'bpaddtfake.dbo.glo_kategori.ids', '=', 'bpaddtfake.dbo.glo_subkategori.idkat')
                        ->distinct('idkat', 'bpaddtfake.dbo.glo_kategori.nmkat')
                        ->get(['idkat', 'nmkat']);
        
        return view('pages.bpadcms.subkategori')
                ->with('access', $access)
                ->with('subkatsid', $subkatsid)
                ->with('subkats', $subkats);
    }

    public function forminsertsubkategori(Request $request)
    {
        $this->checkSessionTime();

        $result = [
                'sts'       => $request->sts,
                'nmkat'     => $request->nmkat,
            ];

        Glo_kategori::insert($result);

        return redirect('/cms/subkategori')
                    ->with('message', 'kategori '.$request->desk.' berhasil ditambah')
                    ->with('msg_num', 1);
    }

    public function formupdatesubkategori(Request $request)
    {
        $this->checkSessionTime();

        Glo_kategori::
            where('ids', $request->ids)
            ->update([
                'nmkat' => $request->nmkat,
                'sts'   => $request->sts,
            ]);

        return redirect('/cms/subkategori')
                    ->with('message', 'Kategori '.$request->nmkat.' berhasil diubah')
                    ->with('msg_num', 1);
    }

    public function formdeletesubkategori(Request $request)
    {
        $this->checkSessionTime();

        // hapus menu dari tabel kategori
        $delete = Glo_kategori::
                    where('ids', $request->ids)
                    ->delete();

        return redirect('/cms/subkategori')
                    ->with('message', 'Kategori '.$request->nmkat.' berhasil dihapus')
                    ->with('msg_num', 1);
    }

    // ----------------- SUB KATEGORI ------------------ //

    // ---------------------------------------------- //

    // -------------------- CONTENT ---------------- //

    public function contentall(Request $request)
    {
        $this->checkSessionTime();
        $access = $this->checkAccess($_SESSION['user_data']['idgroup'], 31);

        if (!(is_null($request->katnow))) {
            $katnow = $request->katnow;
        } else {
            $katnow = 1;
        }

        if (is_null($request->suspnow) || $request->suspnow == 'N') {
            $suspnow = '';
        } elseif ($request->suspnow == 'Y') {
            $suspnow = 'Y';
        }

        // if (is_null($request->apprnow) || $request->apprnow == 1) {
        //     $apprnow = 'Y';
        // } elseif ($request->apprnow == 0) {
        //     $apprnow = 'N';
        // } 

        $kategoris = Glo_kategori::
                        where('sts', 1)
                        ->where('privacy', 'like', 'C%')
                        ->orderBy('nmkat')
                        ->get();

        $subkats = Glo_subkategori::
                    get();

        $contents = Content_tb::
                    limit(100)
                    ->where('idkat', $katnow)
                    ->where('suspend', $suspnow)
                    ->where('sts', 1)
                    // ->where('appr', $apprnow)
                    ->orderBy('tanggal', 'desc')
                    ->get();

        return view('pages.bpadcms.content')
                ->with('access', $access)
                ->with('kategoris', $kategoris)
                ->with('subkats', $subkats)
                ->with('contents', $contents)
                ->with('katnow', $katnow)
                ->with('suspnow', $suspnow);
    }

    public function contenttambah(Request $request)
    {
        $this->checkSessionTime();
        $access = $this->checkAccess($_SESSION['user_data']['idgroup'], 31);

        $subkats = Glo_subkategori::
                    where('idkat', $request->kat)
                    ->get();

        return view('pages.bpadcms.contenttambah')
                ->with('access', $access)
                ->with('subkats', $subkats)
                ->with('idkat', $request->kat);
    }

    public function contentubah(Request $request)
    {
        $this->checkSessionTime();
        $access = $this->checkAccess($_SESSION['user_data']['idgroup'], 31);

        $ids = $request->ids;
        $idkat = $request->idkat;

        $subkats = Glo_subkategori::
                    where('idkat', $idkat)
                    ->get();

        $content = Content_tb::
                    where('ids', $ids)
                    ->first();

        return view('pages.bpadcms.contentubah')
                ->with('access', $access)
                ->with('ids', $ids)
                ->with('idkat', $idkat)
                ->with('subkats', $subkats)
                ->with('content', $content);
    }

    public function forminsertcontent(Request $request)
    {
        $this->checkSessionTime();

        if (isset($request->tfile)) {
            $file = $request->tfile;

            if ($file->getSize() > 2222222) {
                return redirect('/cms/content')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
            } 
            if ($file->getClientOriginalExtension() != "png" && $file->getClientOriginalExtension() != "jpg" && $file->getClientOriginalExtension() != "jpeg") {
                return redirect('/cms/content')->with('message', 'File yang diunggah harus berbentuk JPG / JPEG / PNG');     
            } 

            $file_name = "cms" . preg_replace("/[^0-9]/", "", $request->tanggal);
            $file_name .= $_SESSION['user_data']['nrk_emp'];
            $file_name .= ".". $file->getClientOriginalExtension();

            $tujuan_upload = config('app.savefileimgberita');
            $file->move($tujuan_upload, $file_name);
        }

        if (isset($request->tfiledownload)) {
            $file = $request->tfiledownload;

            if ($file->getSize() > 5555000) {
                return redirect('/cms/content')->with('message', 'Ukuran file terlalu besar (Maksimal 5MB)');     
            } 

            $file_name = $file->getClientOriginalName();

            $tujuan_upload = config('app.savefiledocs');
            $file->move($tujuan_upload, $file_name);
        }
            
        if (!(isset($file_name))) {
            $file_name = null;
        }

        if (!(isset($request->subkat))) {
            $subkat = null;
        } else {
            $subkat = $request->subkat;
        }

        if (!(isset($request->url))) {
            $url = null;
        } else {
            $url = $request->url;
        }

        if (!(isset($request->isi1))) {
            $isi1 = null;
        } else {
            $isi1 = $request->isi1;
        }

        if (!(isset($request->isi2))) {
            $isi2 = null;
        } else {
            $isi2 = $request->isi2;
        }

        if ($request->suspend == 'Y') {
            $suspend = 'Y';
        } else {
            $suspend = '';
        }

        $insert = [
                'sts'       => 1,
                'idkat'     => $request->idkat,
                'subkat'     => $subkat,
                'tanggal'   => date('Y-m-d H:i:s',strtotime(str_replace('/', '-', $request->tanggal))),
                'tglinput'   => date('Y-m-d H:i:s',strtotime(str_replace('/', '-', $request->tanggal))),
                'judul'   => $request->judul,
                'isi1'   => htmlentities($request->isi1),
                'isi2'   => htmlentities($request->isi2),
                'editor'   => $request->editor,
                'thits'   => $request->thits,
                'tfile'   => $file_name,
                'likes'   => $request->likes,
                'url'       => $url,
                'kd_cms'   => $request->kd_cms,
                'appr'   => "N",
                'usrinput'   => $request->usrinput,
                'contentnew'   => $request->contentnew,
                'suspend' => $suspend,
            ];

        Content_tb::insert($insert);
        return redirect('/cms/content?katnow='.$request->idkat)
                    ->with('message', 'Konten '.$request->desk.' berhasil ditambah')
                    ->with('msg_num', 1);
    }

    public function formupdatecontent(Request $request)
    {
        $this->checkSessionTime();

        if (isset($request->tfile)) {
            $file = $request->tfile;

            if ($file->getSize() > 2222222) {
                return redirect('/cms/content')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
            } 
            if ($file->getClientOriginalExtension() != "png" && $file->getClientOriginalExtension() != "jpg" && $file->getClientOriginalExtension() != "jpeg") {
                return redirect('/cms/content')->with('message', 'File yang diunggah harus berbentuk JPG / JPEG / PNG');     
            } 

            $file_name = "cms" . preg_replace("/[^0-9]/", "", $request->tanggal);
            $file_name .= $_SESSION['user_data']['nrk_emp'];
            $file_name .= ".". $file->getClientOriginalExtension();

            $tujuan_upload = config('app.savefileimgberita');
            $file->move($tujuan_upload, $file_name);
        }

        if (isset($request->tfiledownload)) {
            $file = $request->tfiledownload;

            if ($file->getSize() > 5555000) {
                return redirect('/cms/content')->with('message', 'Ukuran file terlalu besar (Maksimal 5MB)');     
            } 

            $file_name = $file->getClientOriginalName();

            $tujuan_upload = config('app.savefiledocs');
            $file->move($tujuan_upload, $file_name);
        }
            
        if (!(isset($file_name))) {
            $file_name = null;
        }

        if (!(isset($request->subkat))) {
            $subkat = null;
        } else {
            $subkat = $request->subkat;
        }

        if (!(isset($request->url))) {
            $url = null;
        } else {
            $url = $request->url;
        }

        if (!(isset($request->isi1))) {
            $isi1 = null;
        } else {
            $isi1 = $request->isi1;
        }

        if (!(isset($request->isi2))) {
            $isi2 = null;
        } else {
            $isi2 = $request->isi2;
        }

        if ($request->suspend == 'Y') {
            $suspend = 'Y';
        } else {
            $suspend = '';
        }

        Content_tb::
            where('ids', $request->ids)
            ->update([
                'subkat'     => $subkat,
                'tanggal'   => date('Y-m-d H:i:s',strtotime(str_replace('/', '-', $request->tanggal))),
                'judul'   => $request->judul,
                'isi1'   => htmlentities($request->isi1),
                'isi2'   => htmlentities($request->isi2),
                'tfile'   => $file_name,
                'url'       => $url,
                'suspend' => $suspend,
            ]);

        return redirect('/cms/content?katnow='.$request->idkat)
                    ->with('message', 'Konten '.$request->judul.' berhasil diubah')
                    ->with('msg_num', 1);
    }

    public function formapprcontent(Request $request)
    {
        $this->checkSessionTime();

        Content_tb::
            where('ids', $request->ids)
            ->update([
                'appr' => $request->appr,
            ]);

        return redirect('/cms/content?katnow='.$request->idkat)
                    ->with('message', 'Konten '.$request->judul.' berhasil diubah')
                    ->with('msg_num', 1);
    }

    public function formdeletecontent(Request $request)
    {
        $this->checkSessionTime();

        // hapus menu dari tabel kategori
        Content_tb::
                    where('ids', $request->ids)
                    ->update([
                        'sts' => 0,
                    ]);

        return redirect('/cms/content?katnow='.$request->idkat)
                    ->with('message', 'Konten '.$request->judul.' berhasil dihapus')
                    ->with('msg_num', 1);
    }
}
