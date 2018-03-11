<?php
include_once ROOT. '/models/User.php';
include_once ROOT. '/models/Meetings.php';

class ProfileController{
  public function actionIndex(){

    $userId = User::checkLogged();
    $user = User::getUserById($userId);
    echo $userId;
    $themes = User::getChosenInterests($userId);
    $OrgMeetings = Meetings::getOrganizedMeetings($userId);
    $PerMeetings = Meetings::getPersonsMeetings($userId);
    require_once(ROOT. '/views/profile/index.php');
    return true;
  }

  public function actionManageInterests(){

    $userId = User::checkLogged();
    $themes = User::getChosenInterests($userId);
    $themesAvail = User::getAvailableInterests($userId);

    require_once(ROOT. '/views/profile/manageInterests.php');
    return true;
  }

  public function actionEventNotifications(){

    $userId = User::checkLogged();
    $notificationsList = User::getNotifications($userId);

    require_once(ROOT. '/views/profile/eventNotifications.php');
    return true;
  }

  public function actionDeleteInterest($id){

    $userId = User::checkLogged();
    User::deleteInterest($id, $userId);

    $referrer = $_SERVER['HTTP_REFERER'];
    header("Location: $referrer");
  }
  public function actionAddInterest($id){

    $userId = User::checkLogged();
    User::addInterest($userId, $id);

    $referrer = $_SERVER['HTTP_REFERER'];
    header("Location: $referrer");
  }
}

 ?>
