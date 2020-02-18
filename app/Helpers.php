<?php 

use App\Sec_menu;

function buildTree($arr, $parent = 0, $level = 1)
{
	$arrLevel = ['', '<ul class="nav nav-second-level">', '<ul class="nav nav-third-level">', '<ul class="nav nav-fourth-level">'];
	$result = '';
	$link = '';
	$temp = '';

    foreach($arr as $noid => $menu)
    {	
    	if ($menu['sao'] == '') {
    		$sao = 0;
    	} else {
    		$sao = $menu['sao'];
    	}

		if (is_null($menu['urlnew'])) {
    		$link = 'javascript:void(0)';
    	} else {
    		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
			    $link = "https"; 
			else
			    $link = "http"; 
			  
			$link .= "://"; 	  
			$link .= $_SERVER['HTTP_HOST']; 
			$link .= $menu['urlnew'];
    	}

		if ($menu['child'] == 0) {
			$result .= '<li> <a href="'.$link.'" class="waves-effect"><i class="fa fa-check fa-fw"></i> <span class="hide-menu">'.$menu['desk'].'</span></a></li>';
		} elseif ($menu['child'] == 1) {
			$result .= '<li> <a href="'.$link.'" class="waves-effect"><i class="fa fa-check fa-fw"></i> <span class="hide-menu">'.$menu['desk'].'<span class="fa arrow"></span></span></a>';

			$result .= $arrLevel[$level];

			$result .= buildTree($arr, $menu['ids'], $level++);

			$result .= '</ul>';

			$result .= '</li>';
		}
    }

    return $result;
}

function display_menus($query, $parent = 0)
{
	$query = Sec_menu::
			join('sec_access', 'sec_access.idtop', '=', 'sec_menu.ids')
			->where('sec_menu.tipe', 'l')
			->whereRaw('LEN(sec_menu.urut) = 1')
			->where('sec_access.idgroup', $_SESSION['user_data']['idgroup'])
			->where('sec_access.zviw', 'y')
			->where('sec_menu.sao', $parent)
			->orderByRaw('CONVERT(INT, sec_menu.sao)')
			->orderBy('sec_menu.urut')
			->get();

	$result = '';
	$link = '';
	$arrLevel = ['<ul class="nav ulmenu" id="side-menu">', '<ul class="nav nav-second-level">', '<ul class="nav nav-third-level">', '<ul class="nav nav-fourth-level">'];

	if (count($query) > 0) {
		$result .= '<ul>';
	
		foreach ($query as $menu) {
			if (is_null($menu['urlnew'])) {
	    		$link = 'javascript:void(0)';
	    	} else {
	    		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
				    $link = "https"; 
				else
				    $link = "http"; 
				  
				$link .= "://"; 	  
				$link .= $_SERVER['HTTP_HOST']; 
				$link .= $menu['urlnew'];
	    	}

			$result .= '<li> <a href="'.$link.'" class="waves-effect"><i class="fa fa-check fa-fw"></i> <span class="hide-menu">'.$menu['desk'].'</span></a>';

			display_menus($query, $menu['ids']);

			$result .= '</li>';
		}

		$result .= '</ul>';
	}
	
	return $result;
}

?>