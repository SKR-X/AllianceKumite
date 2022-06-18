<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Models\UserModel;

class UserpanelController extends Controller
{

    private $UserModel;

    private $idUser;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->idUser = $this->UserModel->getIdSession();
    }

    public function actionIndex()
    {
        if ($this->UserModel->checkSessions()) {
            $this->viewPage('UserPanelPage', 'userPanel', array('sportsmens' => $this->UserModel->sportsmen(), 'participants' => $this->UserModel->participants(), 'id' => $this->idUser));
        } else {
            $this->viewError('log');
        }

    }

    public function actionCheckPostPanel()
    {
        if (empty($_POST) || !$this->UserModel->checkSessions()) {
            return true;
        } else if (isset($_POST['addNewOne']) && !empty($_FILES['Photo']['name'])) {
            $this->UserModel->addNewOne($_POST, $_FILES);
        } else if(isset($_POST['addNewOne'])) {
            $this->UserModel->addNewOne($_POST);
        } else if (isset($_POST['moveSportsmen'])) {
            $this->UserModel->moveSportsmen($_POST);
        } else if (isset($_POST['delSprt'])) {
            $this->UserModel->deleteSportsmen($_POST);
        } else if (isset($_POST['delPrt'])) {
            $this->UserModel->deleteParticipants($_POST);
        } else if (isset($_POST['redSprt']) && isset($_FILES)) {
            $this->UserModel->redSprt($_POST,$this->idUser,$_FILES);
        } else if (isset($_POST['redSprt'])) {
            $this->UserModel->redSprt($_POST,$this->idUser);
        }
        header('Location: /userpanel');
    }

}
