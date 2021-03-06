<?php
include_once ROOT. '/models/User.php';
include_once ROOT. '/models/Meetings.php';
include_once ROOT. '/models/Theme.php';

class ProfileController{
  public function actionIndex(){

    $userId = User::checkLogged();
    $user = User::getUserById($userId);
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

  public function actionEdit(){
    $userId = User::checkLogged();
    $user = User::getUserById($userId);
    $name = $user['name'];
    $surname = $user['surname'];
    $city = $user['city'];
    $password = $user['password'];

    $result = false;

    if (isset($_POST['doEdit'])){
      $name = $_POST['names'];
      $surname = $_POST['surname'];
      $citySearch = $_POST['city'];
      $city = $_POST['locality'];
      $pass = $_POST['pass'];

      $result = User::edit($userId, $name, $surname, $city, $pass);

      if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
          move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/users/{$userId}.jpg");
      }

    }

    require_once(ROOT. '/views/profile/edit.php');
    return true;

  }

  public function actionDeleteNotification($id){
    $userId = User::checkLogged();
    User::deleteNotification($userId, $id);

    $referrer = $_SERVER['HTTP_REFERER'];
    header("Location: $referrer");
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
