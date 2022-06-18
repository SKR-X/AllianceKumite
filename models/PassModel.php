<?php

namespace App\Models;

use App\Core\Model;

use App\Core\Github\Mailer\PHPMailer;
use App\Core\Github\Mailer\SMTP;
use App\Core\Session;

class PassModel extends Model
{
    private $mail;

    public function __construct()
    {

        $this->mail = new PHPMailer();
        parent::__construct();
        $this->mail->SMTPDebug = SMTP::DEBUG_OFF;                      // ДЕБАГ
        $this->mail->isSMTP();                                            // Send using SMTP
        $this->mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $this->mail->Username   = '';                     // SMTP username
        $this->mail->Password   = '';                               // SMTP password
        $this->mail->Port = 587;
        $this->mail->CharSet = "utf-8";
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                                   // TCP port to connect to

        //Recipients
        $this->mail->setFrom('alliance.kumite2017@gmail.com', 'ALLIANCE KUMITE');
    }

    public function reminder($id)
    {
        if(!empty($this->takeAllFromTableWhereEqually('recovery','Link',$id))) {
            return true;
        } else {
            return false;
        }
    }

    public function makeRecoveryLink($email) {
        $arr = array('a','b','c','d','e','f',
                'g','h','i','j','k','l',
                'm','n','o','p','r','s',
                't','u','v','x','y','z',
                'A','B','C','D','E','F',
                'G','H','I','J','K','L',
                'M','N','O','P','R','S',
                'T','U','V','X','Y','Z',
                '1','2','3','4','5','6',
                '7','8','9','0');
            // Генерируем пароль
            $pass = "";
            for($i = 1; $i <= 40; $i++)
            {
                // Вычисляем случайный индекс массива
                $index = rand(0, count($arr) - 1);
                $pass .= $arr[$index];
            }
        $this->insertArray('recovery',array('Link' => $pass, 'Email' => strtolower($email), 'LifeTime' => date("Y-m-d H:i:s", strtotime("+1 hour", strtotime(date('Y-m-d H:i:s'))))));
        return $pass;
    }

    public function setNewPass($id,$newPass) {
        $this->updateArray('coaches',array('UserPassword' => password_hash($newPass, PASSWORD_DEFAULT)),array('name' => 'UserEmail', 'str' => $this->takeOneFromTableWhereEqually('Email','recovery','Link',$id)));
        $this->deleteAllFromTableWhereEqually('recovery','Link',$id);
    }

    public function recoveryMessage($email)
    {

        // очистка старых рекавери-запросов
        
        $this->query('DELETE FROM ?n WHERE ?n < ?s','recovery','LifeTime',date("Y-m-d H:i:s"));
        

        if($this->takeAllFromTableWhereEqually('recovery','Email',strtolower($email))) {
            return false;
        }

        $this->mail->addAddress($email);     // Add a recipient

        // Content
        $this->mail->isHTML(false);                                  // Set email format to HTML
        $this->mail->Subject = 'ALLIANCE KUMITE';
        $this->mail->Body = 'This is a recovery message. If you didnt ask for the recovery just ignore this message. Recovery link: http://alliance-kumite.com/resetpassword?id='.$this->makeRecoveryLink($email);

        if ($this->mail->send()) {
            return 1;
        } else {
            return false;
        }
    }
}
