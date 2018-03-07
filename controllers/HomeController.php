<?php

include_once ROOT. '/models/Meetings.php';

class HomeController {

    public function actionIndex(){
        $meetingsLatestList = array();
        $meetingsLatestList = Meetings::getLatestMeetings(3);
        require_once(ROOT . '/views/home/index.php');

        return true;
    }
}
?>