<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Models\RegisterModel;
use App\Core\Session;

class UsercabController extends Controller {
    
    private $Model;
    private $id;

    public function __construct()
    {
        $this->RegisterModel = new RegisterModel();
        $this->id = Session::sessionReturn('id');
    }
    
    public function actionIndex()
    {
        if($this->RegisterModel->checkSession('id')) {
            $this->viewPage('UserCabPage','userCab',array('countries' => $this->RegisterModel->takeAllFromTable('countries'),'clubs' => $this->RegisterModel->takeAllFromTable('clubs'),'userInfo' => $this->RegisterModel->takeAllFromTableWhereEqually('coaches','UserId',$this->id), 'info' => $this->RegisterModel->takeAllFromTableWhereEqually('coaches','UserId',$this->id)[0]));
        } else {
            $this->viewPage('LoginPage','login',array('champ' => 'user'));
        }
    }

    public function actionCheckPost()
    {
        if(isset($_POST['oldPass']) && isset($_POST['newPass']) && isset($_POST['email']) && password_verify($_POST['oldPass'], $this->RegisterModel->takeOneFromTableWhereEqually('UserPassword', 'coaches', 'UserEmail', $_POST['email']))) {
            $this->RegisterModel->updateArray('coaches',array('UserPassword' => password_hash($_POST['newPass'], PASSWORD_DEFAULT)),array('name' => 'UserEmail', 'str' => $_POST['email']));
        } else if(isset($_POST['oldPass']) && isset($_POST['newPass']) && isset($_POST['email']) && !password_verify($_POST['oldPass'], $this->RegisterModel->takeOneFromTableWhereEqually('UserPassword', 'coaches', 'UserEmail', $_POST['email']))) {
            $this->viewError('loginErr');
        }
    }

    public function actionResult()
    {
        if(empty($_POST)) {
            $this->viewPage('404Page','404');
            exit();
        } else {
                switch ($this->RegisterModel->userArray($_COOKIE,'coaches', $_POST, 'update', Session::sessionReturn('id'))) {
                    case 'emailErr':
                        $this->viewError('emailErr');
                        break;
                    case 'OK':
                        header("Location: /usercab");
                }
            }
        }
    }