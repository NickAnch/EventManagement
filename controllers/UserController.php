<?php
  include_once ROOT. '/models/User.php';
  include_once ROOT. '/models/Meetings.php';

  class UserController{

    public function actionView($id){
      if ($id) {
          $userItem = User::getUserByID($id);
          $userId = User::checkLogged();

          if($id == $userId){
            header("Location: /profile/");
          }
          $OrgMeetings = Meetings::getOrganizedMeetings($id);
          $Meetings = Meetings::getPersonsMeetings($id);
          $themes = User::getChosenInterests($id);
          
          require_once(ROOT . '/views/user/view.php');

      }
      return true;
    }

    public function actionInviteUser($invitedId){
      $userId = User::checkLogged();
      $meetingsList = array();
      $meetingsListPar = array();
      $invitedId = intval($invitedId);
      $meetingsList = Meetings::getAvailableOrganizedMeetings($userId,$invitedId);
      $meetingsListPar = Meetings::getAvailableMeetings($userId,$invitedId);
      $invitedName = User::getNameOfUser($invitedId);

      require_once(ROOT . '/views/user/inviteUser.php');
      return true;
    }

    public function actionAddInvitedMember($meetId,$invitedId){
      $userId = User::checkLogged();
      User::addInvitedMember($userId, $meetId, $invitedId);

      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }


    public function actionRegister(){
      $name = false;
      $surname = false;
      $email = false;
      $city = false;
      $result = false;

      if (isset($_POST['doRegistr'])){
        $name = $_POST['names'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $citySearch = $_POST['city'];
        $city = $_POST['locality'];
        $pass = $_POST['pass'];

        $error = false;
        if (User::checkEmailExists($email)){
          $error[] = 'Такой email уже занят';
        }

        if ($error == false) {
            $result = User::register($name, $surname, $email, $city, $pass);
            header("Location: /user/login");
        }
      }

      require_once(ROOT. '/views/user/register.php');
      return true;
    }

    public function actionLogin(){
      $email = '';

      if (isset($_POST['doLogin'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $error = false;

        $userId = User::checkUserData($email,$pass);
        $nameOfUser = User::getNameOfUser($userId);
        if($userId == false){
          $error[] = 'Неправильно ввели email или пароль';
        } else {
          User::auth($userId, $nameOfUser);

          header("Location: /profile");
        }
      }
      require_once(ROOT. '/views/user/login.php');
      return true;
    }

    public function actionLogout(){

        unset($_SESSION["user"]);

        header("Location: /");
    }

  }
 ?>
