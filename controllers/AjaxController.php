<?php

namespace App\Controllers;

use App\Core\Controller as Controller;

use App\Models\RegisterModel as Model1;

use App\Models\UserModel as Model2;

class AjaxController extends Controller
{

    private $Model1;

    public function __construct()
    {
        $this->Model1 = new Model1();
        $this->Model2 = new Model2();
    }

    public function actionIndex()
    {
        $this->viewPage('404Page', '404');
        header('Content-Type: application/json;charset=utf-8');
    }

    // Панель юзера

    public function actionGetSportsmen() {
        $data = $this->Model2->contextSearch('sportsmens',$_POST['input'],$_POST['id']);
        $this->viewInfo($this->Model2->toJSON($data));
    }

    // Регистрация

    public function actionGetRegParams()
    {
        switch ($_GET['step']) {
            case 1:
                if (!isset($_POST['CountryId'])) {
                    $this->viewInfo('[]');
                    return true;
                }
                $data = $this->Model1->makeData();
                if (empty($data['Club']) && empty($data['Region']) && empty($data['City'])) {
                    $this->viewInfo('[]');
                    return true;
                }
                $this->viewInfo($this->Model1->toJSON($data));
                break;
            case 2:
                if (!isset($_POST['RegionId'])) {
                    $this->viewInfo('[]');
                    return true;
                }
                $data = $this->Model1->takeAllFromTableWhereEqually('cities', 'RegionId', $_POST['RegionId']);
                $this->viewInfo($this->Model1->toJSON($data));
                return true;
                break;
            case 3:
                if (!isset($_POST['Text']) && !isset($_POST['Id'])) {
                    $this->viewInfo('[]');
                    return true;
                }
                $data = $this->Model1->contextSearch($_POST['Id'],$_POST['Text']);
                $this->viewInfo($this->Model1->toJSON($data));
                return true;
                break;
        }
    }
}