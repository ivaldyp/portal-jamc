<?php

namespace App\Traits;

use App\Sec_menu;

trait TraitsCheckActiveMenu
{
	public function getparentmenu($idnow)
	{
		$nowparent = Sec_menu::where('ids', $idnow)->first();
		if($nowparent['sao'] == 0 or is_null($nowparent['sao'])) {
			return $nowparent['ids'];
		} else {
			return $nowparent['ids'] . "," . $this->getparentmenu($nowparent['sao']);
		}
	}

	public function checkactivemenu($appname, $url)
	{
		$appname = "/".$appname;
		$nama = explode($appname, str_replace("%20", " ", $url));

		$ids = '';

		$nowmenu = Sec_menu::where('urlnew', $nama[1])->first();
		if(is_null($nowmenu)) {
			return 0;
		} else {
			$ids .= $nowmenu['ids'];
			if($nowmenu['sao'] == 0 or is_null($nowmenu['sao'])) {
				return $ids;
			} else {
				return $ids . "," . $this->getparentmenu($nowmenu['sao']);
			}
		}
	}

    public function trimmenu($longurl) 
    {
        $currentpath = str_replace("%20", " ", $_SERVER['REQUEST_URI']);
		$currentpath = explode("?", $currentpath)[0];
        $currentpath = explode("/".config('app.name'), $currentpath)[1];
		return Sec_menu::where('urlnew', $currentpath)->first('ids');
    }
}
