<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;

use App\Sec_menu;

session_start();

class CmsController extends Controller
{
    use SessionCheckTraits;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function display_roles($query, $idgroup, $access, $parent, $level = 0)
    {
        $query = Sec_menu::
                where('sec_menu.sao', $parent)
                ->orderBy('sec_menu.urut')
                ->get();

        $result = '';

        if (count($query) > 0) {
            foreach ($query as $menu) {
            	$padding = ($level * 20) + 8;
                $result .= '<tr>
                				<td class="col-md-1">'.$level.'</td>
                				<td class="col-md-1">'.$menu['ids'].'</td>
		        				<td style="padding-left:'.$padding.'px; '.(($level == 0) ? 'font-weight: bold;"' : '').'">'.$menu['desk'].'</td>
		        				
		        				'.(($access['zupd'] == 'y' || $access['zdel'] == 'y') ? 

		        				'<td>
		        					'.(($access['zupd'] == 'y') ? 
			        					'<button type="button" class="btn btn-info btn-update" data-toggle="modal" data-target="#modal-update" data-ids="'.$menu['ids'].'" data-idgroup="'.$menu['idgroup'].'" data-zviw="'.$menu['zviw'].'" data-zadd="'.$menu['zadd'].'" data-zupd="'.$menu['zupd'].'" data-zdel="'.$menu['zdel'].'" data-zapr="'.$menu['zapr'].'" data-zket="'.$menu['zket'].'"><i class="fa fa-edit"></i></button>'
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
}
