<?php

namespace App\Controllers;

use App\Core\Controller as Controller;

use App\Models\ChampModel as Model;

class ChampController extends Controller
{

    private $Model;
    private $urlName;

    public function __construct($urlName)
    {
        $this->Model = new Model($urlName);
        $this->urlName = $urlName;
    }


    public function ChampInfo()
    {

        switch ($this->Model->checkDate()) {
            case 'err':
                $this->viewError('champds');
                exit();
                break;
            case 'reg':
                header('Location: /login?champ='.$this->urlName);
                break;
        }

        if(isset($_GET['draw']) && ($_GET['draw']=='Жеребьёвка' || $_GET['draw']=='Жеребкування' || $_GET['draw']=='Draw')) {
            unset($_GET['draw']);
        }

        foreach ($_GET as $key => $value) {
            if (!is_numeric($value) && $key!='draw') {
                unset($_GET[$key]);
            }
        }

        $champInfo = $this->Model->takeAllFromTableWhereEqually('champpages', 'UrlName', $this->urlName);
        $countries = $this->Model->countriesInner();
        $cats = $this->Model->categoriesInner();
        $clubs = $this->Model->clubsInner();
        $tatamiMenu = $this->Model->categoriesTatami();
        $tatamiMenuOnline = $this->Model->takeIdFromTable('TatamiId',$this->urlName.'_tatami');

        if(isset($_GET['online'])) {
            $this->viewPage('ChampPage', 'champ', array(
                'countries' => $countries,
                'champInfo' => $champInfo,
                'categories' => $cats,
                'clubs' => $clubs,
                'tatamiOnline' => $this->Model->onlineTatami(),
                'tatami' => $_GET['online'],
                'tatamiMenu' => $tatamiMenu,
                'tatamiMenuOnline' => $tatamiMenuOnline,
            ));
        } else if (isset($_GET['draw'])) {
            $this->viewPage('ChampPage', 'champ', array(
                'countries' => $countries,
                'champInfo' => $champInfo,
                'categories' => $cats,
                'clubs' => $clubs,
                'filename' => $this->urlName . '_' . strtolower(urldecode($_GET['draw'])),
                'tatamiMenu' => $tatamiMenu,
                'tatamiMenuOnline' => $tatamiMenuOnline,
            ));
        } else if (isset($_GET['clubs'])) {
            $this->viewPage('ChampPage', 'champ', array(
                'countries' => $countries,
                'champInfo' => $champInfo,
                'categories' => $cats,
                'participants' => $this->Model->takeAllFromTableWhereLimitOrder($this->urlName . '_participants', 'ClubId', $_GET['clubs'], (!isset($_COOKIE['Limit']) ? 50 : $_COOKIE['Limit']),'FIO','ASC'),
                // TODO УБРАТЬ! SQL-запросы в контроллерах недопустимы.
                'count' => $this->Model->numRows($this->Model->query('SELECT * FROM ?n WHERE ClubId = ?i',$this->urlName . '_participants', $_GET['clubs'])),
                'clubs' => $clubs,
                'countCookie' => (!isset($_COOKIE['Limit'])) ? 50 : $_COOKIE['Limit'],
                'tatamiMenu' => $tatamiMenu,
                'tatamiMenuOnline' => $tatamiMenuOnline,
            ));
        } else if (isset($_GET['results'])) {

            switch ($_GET['results']) {
                case 1:
                    $param = $this->urlName.'_result_tournament.svg';
                    break;
                case 2:
                    $param = $this->urlName.'_result_tournament_coach.svg';
                    break;
                case 3:
                    $param = $this->urlName.'_result_tournament_club.svg';
                    break;
                default:
                    $param = $this->urlName.'_result_tournament_country.svg';
                    break;
            }

            $this->viewPage('ChampPage', 'champ', array(
                'countries' => $countries,
                'champInfo' => $champInfo,
                'categories' => $cats,
                'clubs' => $clubs,
                'filename' => $param,
                'tatamiMenu' => $tatamiMenu,
                'tatamiMenuOnline' => $tatamiMenuOnline,
            ));

        } else if(isset($_GET['tatami'])) {
            $this->viewPage('ChampPage', 'champ', array(
                'countries' => $countries,
                'champInfo' => $champInfo,
                'categories' => $cats,
                'clubs' => $clubs,
                'tatamiMenu' => $tatamiMenu,
                'tatamiMenuOnline' => $tatamiMenuOnline,
                'tatami' => $tatamiMenu[$_GET['tatami'] - 1]
            ));
        } else if (isset($_GET['countries']) && !isset($_GET['categories'])) {
            $this->viewPage('ChampPage', 'champ', array(
                'countries' => $countries,
                'champInfo' => $champInfo,
                'categories' => $cats,
                'clubs' => $clubs,
                'participants' => $this->Model->takeAllFromTableWhereLimitOrder($this->urlName . '_participants', 'CountryId', $_GET['countries'], (!isset($_COOKIE['Limit']) ? 50 : $_COOKIE['Limit']),'FIO','ASC'),
                'tatamiMenu' => $tatamiMenu,
                'countCookie' => (!isset($_COOKIE['Limit'])) ? 50 : $_COOKIE['Limit'],
                'count' => $this->Model->numRows($this->Model->query('SELECT * FROM ?n WHERE CountryId = ?i',$this->urlName . '_participants', $_GET['countries'])),
                'tatamiMenuOnline' => $tatamiMenuOnline,
            ));
        } else if(!isset($_GET['countries']) && isset($_GET['categories'])) {
            $this->viewPage('ChampPage', 'champ', array(
                'countries' => $countries,
                'champInfo' => $champInfo,
                'categories' => $cats,
                'clubs' => $clubs,
                'participants' => $this->Model->takeAllFromTableWhereLimit($this->urlName.'_participants','CategoryId',$_GET['categories'],(!isset($_COOKIE['Limit']) ? 50 : $_COOKIE['Limit'])),
                'tatamiMenu' => $tatamiMenu,
                'count' => $this->Model->numRows($this->Model->query('SELECT * FROM ?n WHERE CategoryId = ?i',$this->urlName . '_participants', $_GET['categories'])),
                'tatamiMenuOnline' => $tatamiMenuOnline,
            ));
        } else if(empty($_GET)) {
            $this->viewPage('ChampPage', 'champ', array(
                'countries' => $countries,
                'champInfo' => $champInfo,
                'categories' => $cats,
                'clubs' => $clubs,
                'participants' => $this->Model->takeAllFromTableLimitOrder($this->urlName . '_participants', (!isset($_COOKIE['Limit']) ? 50 : $_COOKIE['Limit']),'FIO','ASC'),
                'tatamiMenu' => $tatamiMenu,
                'countCookie' => (!isset($_COOKIE['Limit'])) ? 50 : $_COOKIE['Limit'],
                'count' => $this->Model->countTable($this->urlName . '_participants'),
                'tatamiMenuOnline' => $tatamiMenuOnline,
            ));
        }
    }
}