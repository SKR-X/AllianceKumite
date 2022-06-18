<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\PassModel;

class ResetpasswordController extends Controller
{

    private $PassModel;

    public function __construct()
    {
        $this->PassModel = new PassModel();
    }

    public function actionIndex()
    {

        Session::sessionDestroy();

        if (!isset($_GET['id'])) {
            $this->viewPage('ResetPasswordPage', 'resetPass');
        } else if($this->PassModel->reminder($_GET['id'])) {
            $this->viewPage('ResetWithIdPage', 'resetWithId', array('id' => $_GET['id']));
        }
    }

    public function actionCheckPost()
    {
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $this->PassModel->recoveryMessage($_POST['email']);
        }
        header('Location: /resetpassword');
    }

    public function actionCheckPostReminder()
    {
        if(isset($_GET['id'])) {
            $this->PassModel->setNewPass($_GET['id'], $_POST['newPass']);
        }
        header('Location:/');
    }
}
