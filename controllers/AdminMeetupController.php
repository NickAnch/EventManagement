<?php
include_once ROOT. '/components/AdminBase.php';
include_once ROOT. '/models/Meetings.php';

class AdminMeetupController extends AdminBase {

  public function actionIndex($page=1){

        self::checkAdmin();

        $meetingsList = Meetings::getMeetingsListAdmin($page);

        require_once(ROOT . '/views/admin_meetings/index.php');
        return true;
  }

  public function actionDelete($id){
        
        self::checkAdmin();
        if (isset($_POST['deleteMeetup'])) {
          $error = false;
          if (Meetings::deleteMeetupById($id)){
            header("Location: /admin/meetup");
          } else {
            $error[]= 'Данное мероприятие используется в других таблицах, оно не может быть удалено!';
          }
        }

        require_once(ROOT . '/views/admin_meetings/delete.php');
        return true;
    }



}

?>
