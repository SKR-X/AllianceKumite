<?php

namespace App\Core;

use App\Core\View;

class Controller
{
    private $View;

    protected function viewPage($pageName, $config, $queryArr = array())
    {
        $this->View = new View();
        $this->View->ViewPage($pageName, $config, $queryArr, $this->checkCookie('lang'));
    }

    protected function viewError($data)
    {
        $this->View = new View();
        $this->View->ViewPage('ErrPage', array(), array(), $this->checkCookie('lang'), $data);
    }

    protected function viewInfo($data)
    {
        $this->View = new View();
        $this->View->ViewPage('InfoPage', array(), array(), NULL, $data);
    }

    private function checkCookie($name)
    {
        if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        } else {
            return false;
        }
    }

// protected static function ViewPageDB($config  = array()){
//     View::ViewPageDB($config);
// }
}