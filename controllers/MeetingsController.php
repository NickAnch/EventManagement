<?php

include_once ROOT. '/models/Meetings.php';
include_once ROOT. '/models/User.php';

class MeetingsController {

    public function actionIndex($page=1){
        echo 'page: '. $page;
        $meetingsList = array();
        $meetingsList = Meetings::getMeetingsList($page);

        require_once(ROOT . '/views/meetings/index.php');

        return true;
    }

    public function actionView($id){
        if ($id) {
            $userId = User::getLoggedID();
            //$userId = User::checkLogged();
            $isInvited = User::isInvitedOnMeeup($userId, $id);
            print_r ($isInvited);
            $meetingItem = Meetings::getMeetingByID($id);
            $usersList = array();
            $member = Meetings::checkParticipation($userId, $id);
            print_r ($member);
            $usersList = Meetings::getUsersOfMeeting($id);
            $organizer = Meetings::getOrganizerOfMeeting($id);

            require_once(ROOT . '/views/meetings/view.php');

        }

        return true;

    }

    public function actionCreate(){

      $userId = User::checkLogged();
      $interestsList = User::getAllInterests();

      if (isset($_POST['createMeeting'])){
        $title = $_POST['title'];
        $inter = $_POST['inter'];
        $date = $_POST['date'];
        $fixedDate = date("Y-m-d H:i:s", strtotime($date));
        $city = $_POST['locality'];
        $place = $_POST['formatted_address'];
        $description = $_POST['description'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        if(!empty($_POST['closeMeetup'])){
          if($_POST['closeMeetup'] == 'on'){
            $_POST['closeMeetup'] = 1;
          }
        }else {
          $_POST['closeMeetup'] = 0;
        }
        $closeMeetup = $_POST['closeMeetup'];
        Meetings::createMeeting($title,$inter,$fixedDate,$city,$place,$description,$userId,$closeMeetup,$lat,$lng);
      }
      require_once(ROOT . '/views/meetings/create.php');

      return true;
    }

    public function actionRecommendation(){
      $userId = User::checkLogged();
      $user = User::getUserById($userId);
      $city = $user['city'];
      $themes = User::getChosenInterests($userId);
      $i = 0;
      foreach ($themes as $val){
        $valueId = $val['id'];
        $count[$i] = Meetings::getCountOfRecMeetings($valueId,$city);
        $i++;
      }
      require_once(ROOT . '/views/meetings/recommendation.php');
      return true;
    }

    public function actionGetRecommendedMeetings($int_id){

        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        $city = $user['city'];
        $listMeetings = Meetings::getRecMeetings($city,$int_id);

        echo $listMeetings;
        return true;
    }

    public function actionAddMember($id){
      $userId = User::checkLogged();
      Meetings::addMember($userId, $id);

      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }

    public function actionDeleteMember($id){
      $userId = User::checkLogged();
      Meetings::deleteMember($userId, $id);

      $referrer = $_SERVER['HTTP_REFERER'];
      header("Location: $referrer");
    }

}
