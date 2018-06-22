<?php

include_once ROOT. '/models/Meetings.php';
include_once ROOT. '/models/User.php';
include_once ROOT. '/models/Theme.php';

class MeetingsController {

    public function actionIndex(){
        $meetingsList = array();
        $meetingsList = Meetings::getLatestMeetings(9);

        if(isset($_POST['searchBtn'])){
            $searchCity= $_POST['city'];
            $searchInterest = $_POST['interest'];
            $searchFrom= $_POST['date_from'];
            $searchTo = $_POST['date_to'];
            $filteredMeetings = Meetings::getFilteredMeetingsList($searchInterest, $searchCity, $searchFrom, $searchTo);
        }

        require_once(ROOT . '/views/meetings/index.php');

        return true;
    }

    public function actionView($id){
        if ($id) {
            $userId = User::getLoggedID();
            $isInvited = User::isInvitedOnMeeup($userId, $id);
            $meetingItem = array();
            $meetingItem = Meetings::getMeetingByID($id);
            $usersList = array();
            $member = Meetings::checkParticipation($userId, $id);
            $usersList = Meetings::getUsersOfMeeting($id);
            $organizer = Meetings::getOrganizerOfMeeting($id);

            require_once(ROOT . '/views/meetings/view.php');

        }

        return true;

    }

    public function actionCreate(){

      $userId = User::checkLogged();
      $interestsList = Theme::getInterestsList();

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
        $id = Meetings::createMeeting($title,$inter,$fixedDate,$city,$place,$description,$userId,$closeMeetup,$lat,$lng);

        if ($id) {
            if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                // Если загружалось, переместим его в нужную папке, дадим новое имя
                move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/meetings/{$id}.jpg");
            }
        };

        header("Location: /");
      }
      require_once(ROOT . '/views/meetings/create.php');

      return true;
    }

    public function actionEditMeeting($id){

      $userId = User::checkLogged();
      $meeting = Meetings::getMeetingByID($id);
      $interestsList = Theme::getInterestsList();
      $organizer = Meetings::getOrganizerOfMeeting($id);

      if($organizer[0]['creater_id'] != $userId){
        header("Location: /profile");
      }

      $meetId = $meeting['id'];
      $title = $meeting['title'];
      $inter = $meeting['theme'];
      $date = $meeting['date'];
      $fixedDate = date("Y-m-d\TH:i", strtotime($date));
      $city = $meeting['city'];
      $place = $meeting['place'];
      $description = $meeting['description'];
      $lat = $meeting['lat'];
      $lng = $meeting['lng'];
      $closeMeetup = $meeting['closeMeetup'];

      $result = false;

      if (isset($_POST['editMeeting'])){
        $title = $_POST['title'];
        $inter = $_POST['inter'];
        $date = $_POST['date'];
        $img = $_POST['image'];
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
        $result = Meetings::editMeeting($meetId,$title,$inter,$fixedDate,$city,$place,$description,$userId,$closeMeetup,$lat,$lng);
        $fixedDate = date("Y-m-d\TH:i", strtotime($date));
        if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
            // Если загружалось, переместим его в нужную папке, дадим новое имя
            move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/meetings/{$id}.jpg");
        }
      }
      require_once(ROOT . '/views/meetings/editMeeting.php');

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
        if (empty($listMeetings)){
          echo '<div class="alert alert-danger" role="alert">
                  По данной теме нет актуальных мероприятий в вашем городе!<br>
                  Вы можете изменить город или добавить интересы в <a href="/profile">Личном кабинете</a>.
                </div>';
        } else {
            foreach ($listMeetings as $meetingItem) {
              echo "<div class='col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4'>
                      <div class='card' >
                        <img class='card-img-top' src=".Meetings::getMeetImage($meetingItem['id']). " alt='Card image cap'>
                        <div class='card-body'>
                          <h5 class='card-title'> " .$meetingItem['title']. "</h5>
                          <p class='card-text'> <b>Дата: </b>". $meetingItem['date'] ."</p>
                          <p class='card-text'><b>Город: </b>". $meetingItem['city'] ."</p>
                          <p class='card-text'> <b>Адрес: </b>".$meetingItem["place"] ."</p>
                          <a href='/meetings/". $meetingItem['id']."' class='btn btn-outline-primary '>Подробнее</a>
                        </div>
                      </div>
                    </div>";
        }
      }

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
