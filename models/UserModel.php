<?php

namespace App\Models;

use App\Core\Model;

use App\Core\Session;

class UserModel extends Model
{

    private $pathToImageDirectory = ROOT . '/app/uploadedFiles/IMGfiles/'; //Папка, куда будут загружаться полноразмерные изображения
    private   $pathToThumbsDirectory = ROOT . '/app/uploadedFiles/IMGfilesFull/'; //Папка, куда будут загружаться миниатюры
    private $finalWidthOfImage = 150; //Размер изображения которые Вы хотели бы получить (И ШИРИНА И ВЫСОТА)

    private function createThumbnail($filename)
    {

        if (preg_match('/[.](jpg)$/', $filename)) {
            $im = imagecreatefromjpeg($this->pathToImageDirectory . $filename);
        } else if (preg_match('/[.](png)$/', $filename)) {
            $im = imagecreatefrompng($this->pathToImageDirectory . $filename);
        } //Определяем формат изображения

        $ox = imagesx($im);
        $oy = imagesy($im);

        $nx = $this->finalWidthOfImage;
        $ny = floor($oy * ($this->finalWidthOfImage / $ox));

        $nm = imagecreatetruecolor($nx, $ny);

        imagecopyresized($nm, $im, 0, 0, 0, 0, $nx, $ny, $ox, $oy);
        imagejpeg($nm, $this->pathToThumbsDirectory . $filename);
        unlink($this->pathToImageDirectory . $filename);
    }

    public function toJSONArray($data) {
        foreach ($data as $key => $value) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        }
        return $data;
    }

    public function toJSON($data) {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function contextSearch($table,$value, $id) {
        switch ($table) {
            case 'sportsmens':
                return $this->getAll('SELECT * FROM sportsmens WHERE FIO LIKE ?s AND CoachId = ?i LIMIT 5',"%$value%",$id);
                break;
        }
    }

    public function addNewOne($post, $files = NULL)
    {
        $id = $this->getIdSession();
        $coach = $this->takeAllFromTableWhereEqually('coaches', 'UserId', $id)[0];
        if (isset($post['Kumite'])) {
            $post['Kumite'] = 1;
        } else {
            $post['Kumite'] = 0;
        }
        if (isset($post['Kata'])) {
            $post['Kata'] = 1;
        } else {
            $post['Kata'] = 0;
        }
        if (!empty($files['Photo']['name'])) {
            $filename = $files['Photo']['name'];
            if (preg_match('/[.](jpg)$/', $filename)) {
                $filename = uniqid() . '.jpg';
                $source = $files['Photo']['tmp_name'];
                $target = $this->pathToImageDirectory . $filename;

                move_uploaded_file($source, $target);
            } else if (preg_match('/[.](png)$/', $filename)) {
                $filename = uniqid() . '.png';
                $source = $files['Photo']['tmp_name'];
                $target = $this->pathToImageDirectory . $filename;
                move_uploaded_file($source, $target);
            }
            $this->createThumbnail($filename);
        } else {
            $filename = "NoPhoto.png";
        }
        $this->insertArray('sportsmens', array('CountryId' => $coach['UserCountry'], 'ClubId' =>  $coach['UserClub'], 'DateBr' =>  date('Y-m-d', strtotime($post['DateBr'])), 'FIO' => $post['FIO'], 'CoachId' => $id, 'Gender' => $post['Gender'], 'RegionId' => $coach['UserRegion'], 'Grade' => $post['Grade'], 'Weight' => $post['Weight'], 'Kata' => $post['Kata'], 'Kumite' => $post['Kumite'], 'Photo' => $filename));
    }

    public function checkSessions()
    {
        if (!Session::sessionCheck('id') || !Session::sessionCheck('champ')) {
            return false;
        } else {
            return true;
        }
    }

    public function getIdSession()
    {
        return $this->returnSession('id');
    }

    public function getChampSession()
    {
        return $this->returnSession('champ');
    }

    public function sportsmen()
    {
        return $this->takeAllFromTableWhereEqually('sportsmens', 'CoachId', $this->getIdSession());
    }

    public function participants()
    {
        return $this->takeAllFromTableWhereEqually($this->getChampSession() . '_participants', 'CoachId', $this->getIdSession());
    }

    public function redSprt($post,$id,$files = NULL) {
        // обновление фото

        $filename = $this->getOne('SELECT Photo FROM sportsmens WHERE ParticipantId = ?i AND CoachId = ?i',$post['ParticipantId'],$this->getIdSession());

        if ($files != NULL && !empty($files['Photo']['name'])) {
            $filename = $files['Photo']['name'];
            if (preg_match('/[.](jpg)$/', $filename)) {
                $filename = uniqid() . '.jpg';
                $source = $files['Photo']['tmp_name'];
                $target = $this->pathToImageDirectory . $filename;

                move_uploaded_file($source, $target);
            } else if (preg_match('/[.](png)$/', $filename)) {
                $filename = uniqid() . '.png';
                $source = $files['Photo']['tmp_name'];
                $target = $this->pathToImageDirectory . $filename;
                move_uploaded_file($source, $target);
            }
            $this->createThumbnail($filename);
        } else if ($files != NULL && empty($files['Photo']['name'])) {
            $photoname = $this->getOne('SELECT Photo FROM sportsmens WHERE ParticipantId = ?i AND CoachId = ?i',$post['ParticipantId'],$this->getIdSession());

            if($photoname!='NoPhoto.png') {
            unlink($this->pathToThumbsDirectory . $this->getOne('SELECT Photo FROM sportsmens WHERE ParticipantId = ?i AND CoachId = ?i',$post['ParticipantId'],$this->getIdSession()));
            }
        }

        $post['Photo'] = $filename;

        $post['DateBr'] = date('Y-m-d', strtotime($post['DateBr']));

        unset($post['MAX_FILE_SIZE']);

        unset($post['redSprt']);

        $this->query('UPDATE sportsmens SET ?u WHERE CoachId = ?i AND ParticipantId = ?i', $post, $this->getIdSession(), $post['ParticipantId']);
    }

    public function moveSportsmen($post)
    {
        foreach ($post as $key => $value) {
            if (is_numeric($key) && $this->getAll('SELECT * FROM sportsmens WHERE ParticipantId = ?i AND CoachId = ?i', $key, $this->getIdSession()) && !$this->getAll('SELECT * FROM ' . $this->getChampSession() . '_participants' . ' WHERE FIO = ?s AND DateBr = ?s', $this->takeOneFromTableWhereEqually('FIO', 'sportsmens', 'ParticipantId', $key), $this->takeOneFromTableWhereEqually('DateBr', 'sportsmens', 'ParticipantId', $key))) {
                $this->insertArray($this->returnSession('champ') . '_participants', array('CountryName' => $this->takeOneFromTableWhereEqually('CountryNameEn', 'countries', 'CountryId', $this->takeOneFromTableWhereEqually('CountryId', 'sportsmens', 'ParticipantId', $key)), 'CountryId' => $this->takeOneFromTableWhereEqually('CountryId', 'sportsmens', 'ParticipantId', $key), 'Club' => $this->takeOneFromTableWhereEqually('ClubName', 'clubs', 'ClubId', ($this->takeOneFromTableWhereEqually('ClubId', 'sportsmens', 'ParticipantId', $key))), 'ClubId' => $this->takeOneFromTableWhereEqually('ClubId', 'sportsmens', 'ParticipantId', $key), 'Region' => $this->takeOneFromTableWhereEqually('RegionName', 'regions', 'RegionId', $this->takeOneFromTableWhereEqually('RegionId', 'sportsmens', 'ParticipantId', $key)), 'RegionId' => $this->takeOneFromTableWhereEqually('RegionId', 'sportsmens', 'ParticipantId', $key), 'Coach' => $this->takeOneFromTableWhereEqually('UserName', 'coaches', 'UserId', $this->getIdSession()), 'CoachId' => $this->getIdSession(), 'FIO' => $this->takeOneFromTableWhereEqually('FIO', 'sportsmens', 'ParticipantId', $key), 'Photo' => $this->takeOneFromTableWhereEqually('Photo', 'sportsmens', 'ParticipantId', $key), 'Gender' => $this->takeOneFromTableWhereEqually('Gender', 'sportsmens', 'ParticipantId', $key), 'Grade' => $this->takeOneFromTableWhereEqually('Grade', 'sportsmens', 'ParticipantId', $key), 'DateBr' => $this->takeOneFromTableWhereEqually('DateBr', 'sportsmens', 'ParticipantId', $key), 'Weight' => $this->takeOneFromTableWhereEqually('Weight', 'sportsmens', 'ParticipantId', $key), 'Kata' => $this->takeOneFromTableWhereEqually('Kata', 'sportsmens', 'ParticipantId', $key), 'Kumite' => $this->takeOneFromTableWhereEqually('Kumite', 'sportsmens', 'ParticipantId', $key)));
            }
        }
    }

    public function deleteSportsmen($post)
    {
        foreach ($post as $key => $value) {
            if (is_numeric($key) && $this->getAll('SELECT * FROM sportsmens WHERE ParticipantId = ?i AND CoachId = ?i', $key, $this->returnSession('id'))) {
                $photoname = $this->takeOneFromTableWhereEqually('Photo','sportsmens','ParticipantId',$key);
                if($photoname!='NoPhoto.png') {
                unlink($this->pathToThumbsDirectory.$this->takeOneFromTableWhereEqually('Photo','sportsmens','ParticipantId',$key));
                }
                $this->query('DELETE FROM ' . $this->returnSession('champ') . '_participants' . ' WHERE DateBr = ?s AND FIO = ?s', $this->takeOneFromTableWhereEqually('DateBr', 'sportsmens', 'ParticipantId', $key), $this->takeOneFromTableWhereEqually('FIO', 'sportsmens', 'ParticipantId', $key));
                $this->query('DELETE FROM sportsmens WHERE ParticipantId = ?i', $key);
            }
        }
    }

    public function deleteParticipants($post)
    {
        foreach ($post as $key => $value) {
            if (is_numeric($key) && $this->getAll('SELECT * FROM ' . $this->returnSession('champ') . '_participants' . ' WHERE ParticipantId = ?i AND CoachId = ?i', $key, $this->returnSession('id'))) {
                $this->query('DELETE FROM ' . $this->returnSession('champ') . '_participants' . ' WHERE ParticipantId = ?i', $key);
            }
        }
    }
}
