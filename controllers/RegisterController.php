<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Models\RegisterModel;

use App\Controllers\LoginController;

class RegisterController extends Controller
{

    private $RegistrationModel;

    public function __construct()
    {
        $this->RegistrationModel = new RegisterModel();
    }


    public function actionIndex()
    {
        $this->viewPage('RegPage','reg',array('countries' => $this->RegistrationModel->takeAllFromTable('countries'),'clubs' => $this->RegistrationModel->takeAllFromTable('clubs')));
    }

    public function actionResult()
    {
        if(empty($_POST)) {
            $this->viewPage('404Page','404');
            exit();
        } else {
                switch ($this->RegistrationModel->userArray($_COOKIE,'coaches', $_POST, 'reg')) {
                    case 'email':
                        $this->viewError('emailReg');
                        break;
                    case 'emailErr':
                        $this->viewError('emailErr');
                        break;
                    case 'OK':
                        $this->viewPage('SuccessPage','success');
                        break;
                }
            }
        }
}
