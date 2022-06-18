<?php

namespace App\Models;

use App\Core\Model;

class LoginModel extends Model {
    public function getChampBool($champName) {
        if($this->takeAllFromTableWhereEqually('champpages','UrlName',$champName) && strtotime(date("Y-m-d")) >= strtotime($this->takeOneFromTableWhereEqually('DateStartReg','champpages','UrlName',$champName)) && strtotime(date("Y-m-d")) <= strtotime($this->takeOneFromTableWhereEqually('DateEndReg','champpages','UrlName',$champName))) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUser($email,$passUser) {
        if(password_verify($passUser, $this->takeOneFromTableWhereEqually('UserPassword','coaches','UserEmail',strtolower($email)))) {
            return true;
        } else {
            return false;
        }
    }
}