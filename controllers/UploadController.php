<?php

namespace App\Controllers;

use App\Core\Controller as Controller;

use App\Models\UploadModel as UploadModel;

class UploadController extends Controller
{

    private $UploadModel;

    public function __construct()
    {
        $this->UploadModel = new UploadModel();
    }

    public function checkPost($urlName)
    {
        if (!empty($_POST['Title'])) {
            if ($urlName != 'Send') {
                switch ($_POST['Title']) {
                    case 'Params_Page':
                        $this->UploadModel->uploadPostDataParams($urlName, $_POST['NameChip'], $_POST['DateStartReg'], $_POST['DateEndReg'], $_POST['DateBeginChip'], $_POST['DateEndChip'], $_POST['TypeChip'], $_POST['TatamiCount']);
                        break;

                    case 'Category_File':
                        $this->UploadModel->uploadPostDataCategoryFile($urlName, $_FILES);
                        break;

                    case 'Participant_File':
                        $this->UploadModel->uploadPostDataparticipantsFile($urlName, $_FILES);
                        break;

                    case 'Photo_Participant_File':
                        $this->UploadModel->uploadPostDataFilePng($_FILES, $_POST['CntFile']);
                        break;

                    case 'Result_PNG_Tournament':
                        $this->UploadModel->uploadPostDataFilePng($urlName,$_FILES);
                        break;

                    case 'Result_PNG_Tatami':
                        $this->UploadModel->uploadPostDataFilePngChamp($urlName,$_FILES, $_POST['CntFile']);
                        break;

                    case 'Update_Online_Tatami':
                        $this->UploadModel->updateOnlineTatami($urlName,$_POST['CurrFight'],$_POST['Tatami']);
                        break;

                    case 'File_PNG_Category':
                        $this->UploadModel->uploadPostDataFilePng($urlName,$_FILES);
                        break;

                    case 'Tatami_Online':
                        $this->UploadModel->uploadPostDataTatamiOnlineFile($urlName, $_FILES);
                        break;

                    case 'Update_PNG_File':
                        $this->UploadModel->updatePNGData($urlName, $_FILES);
                        break;

                    case 'DataParticipant':
                        $this->viewPage('UploadPage', array(
                            'view' => 'Upload'
                        ), $this->UploadModel->takeAllFromTable($urlName . '_participants'));
                        break;

                    case 'Country_File':
                        $this->UploadModel->uploadPostDataCountryFile($_FILES);
                        break;

                    case 'Region_File':
                        $this->UploadModel->uploadPostDataRegionFile($_FILES);
                        break;

                    case 'Clubs_File':
                        $this->UploadModel->uploadPostDataClubsFile($_FILES);
                        break;

                    case 'Coach_File':
                        $this->UploadModel->uploadPostDataCoachFile($_FILES);
                        break;
                    default:
                        echo 'wrong title';
                        break;
                }
            } else {
                switch ($_POST['Title']) {
                    case 'Country_File':
                        $this->UploadModel->uploadPostDataCountryFile($_FILES);
                        break;

                    case 'Region_File':
                        $this->UploadModel->uploadPostDataRegionFile($_FILES);
                        break;

                    case 'Clubs_File':
                        $this->UploadModel->uploadPostDataClubsFile($_FILES);
                        break;

                    case 'Coach_File':
                        $this->UploadModel->uploadPostDataCoachFile($_FILES);
                        break;
                }
            }
        } else {
                $this->viewPage('404Page',array('view' => '404View',
                    'title' => '404 Page',
                    'css' => 'Err',
                    'menu' => 'none',
                    'header' => '404err'));
        }
    }
}
