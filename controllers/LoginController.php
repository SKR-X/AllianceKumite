<?php

namespace App\Controllers;

use App\Core\Controller as Controller;

use App\Models\LoginModel as LoginModel;

use App\Core\Session as Session;

class LoginController extends Controller
{

    private $LoginModel;

    public function __construct()
    {
        $this->LoginModel = new LoginModel();
    }

    public function actionIndex()
    {
        if(isset($_GET['champ']) && $this->LoginModel->getChampBool($_GET['champ'])) {
            $this->viewPage('LoginPage','login',array('champ' => $_GET['champ']));
        } else {
            $this->viewError('onlyChamp');
        }
    }

    private function checkUser() {
        if(!empty($_POST) && isset($_POST['email']) && isset($_POST['pass']) && !empty($_POST['email']) && !empty($_POST['pass']) && $this->LoginModel->checkUser($_POST['email'],$_POST['pass'])) {
            return true;
        } else {
            return false;
        }
    }

    public function actionCheckPostLogin()
    {
        if($this->checkUser() && $_GET['champ'] == 'user') {
            Session::sessionStart('id',$this->LoginModel->takeOneFromTableWhereEqually('UserId','coaches','UserEmail',$_POST['email']));
            header('Location: /usercab');
        } else if ($this->checkUser()) {
            Session::sessionStart('id',$this->LoginModel->takeOneFromTableWhereEqually('UserId','coaches','UserEmail',$_POST['email']));
            Session::sessionStart('champ',$_GET['champ']);
            header('Location: /userpanel');
        } else {
            $this->viewError('loginErr');
        }
    }
}