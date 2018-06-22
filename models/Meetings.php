<?php
    class Meetings {


        public static function getMeetingById($id){
            $id = intval($id);
            if($id){
                $db = Db::getConnection();

                $meetingItem = array();

                $query = 'SELECT meetings.id, meetings.title, meetings.closeMeetup, meetings.description, meetings.date,
                          meetings.city, meetings.place, meetings.lat, meetings.lng, meetings.theme, interests.name_interest from meetings '
                          .' INNER JOIN interests ON meetings.theme = interests.id where meetings.id = '. $id.';';


                $result = $db->query($query);
                $result->setFetchMode(PDO::FETCH_ASSOC);
                $meetingItem = $result->fetch();

                return $meetingItem;
            }
        }


        public static function getMeetingsListAdmin(){

            $db = Db::getConnection();
            $meetingsList = array();

            $query = 'SELECT meetings.id, meetings.title, meetings.description, meetings.date,
                      meetings.city, meetings.place, meetings.closeMeetup, interests.name_interest,
                      users.name, users.surname from ((meetings INNER JOIN interests'
                    .' ON meetings.theme = interests.id )'
                    .' INNER JOIN users ON meetings.creater_id = users.id ) order by id DESC';

            $result = $db->query($query);

            $i=0;
            while($row = $result->fetch()){
                $meetingsList[$i]['id'] = $row['id'];
                $meetingsList[$i]['title'] = $row['title'];
                $meetingsList[$i]['name_interest'] = $row['name_interest'];
                $meetingsList[$i]['name'] = $row['name'];
                $meetingsList[$i]['surname'] = $row['surname'];
                $meetingsList[$i]['description'] = $row['description'];
                $meetingsList[$i]['city'] = $row['city'];
                $meetingsList[$i]['place'] = $row['place'];
                $meetingsList[$i]['date'] = $row['date'];
                $meetingsList[$i]['closeMeetup'] = $row['closeMeetup'];
                $i++;

            }
            return $meetingsList;
        }

        public static function getFilteredMeetingsList($searchInterest,$searchCity, $searchFrom, $searchTo){

            $db = Db::getConnection();
            $FiltMeetingsList = array();
            //$searchkey=preg_replace("#[^0-9a-z]#i", "", $searchkey);
            if($searchTo == ''){
              $query = "SELECT meetings.id, meetings.title, meetings.description, meetings.date,
                        meetings.city, meetings.place, interests.name_interest FROM meetings INNER JOIN interests ON meetings.theme = interests.id"
                      ." WHERE interests.name_interest LIKE '%$searchInterest%' AND meetings.closeMeetup = 0 AND meetings.city LIKE '%$searchCity%' "
                      ."AND meetings.date >= '$searchFrom' order by date DESC ";
            } elseif ($searchFrom == '') {
              $query = "SELECT meetings.id, meetings.title, meetings.description, meetings.date,
                        meetings.city, meetings.place, interests.name_interest FROM meetings INNER JOIN interests ON meetings.theme = interests.id"
                        ." WHERE interests.name_interest LIKE '%$searchInterest%' AND meetings.closeMeetup = 0 AND meetings.city LIKE '%$searchCity%' "
                        ." AND meetings.date <= '$searchTo'    order by date DESC";
            } else {
              $query = "SELECT meetings.id, meetings.title, meetings.description, meetings.date,
                        meetings.city, meetings.place, interests.name_interest FROM meetings INNER JOIN interests ON meetings.theme = interests.id"
                        ." WHERE interests.name_interest LIKE '%$searchInterest%' AND meetings.closeMeetup = 0 AND meetings.city LIKE '%$searchCity%'"
                        ." AND meetings.date >= '$searchFrom' AND meetings.date <= '$searchTo' order by date DESC";
            }
            $result = $db->query($query);

            $i=0;
            while($row = $result->fetch()){
                $FiltMeetingsList[$i]['id'] = $row['id'];
                $FiltMeetingsList[$i]['title'] = $row['title'];
                $FiltMeetingsList[$i]['name_interest'] = $row['name_interest'];
                $FiltMeetingsList[$i]['description'] = $row['description'];
                $FiltMeetingsList[$i]['city'] = $row['city'];
                $FiltMeetingsList[$i]['place'] = $row['place'];
                $FiltMeetingsList[$i]['date'] = $row['date'];
                $i++;

            }
            return $FiltMeetingsList;
        }

        public static function getOrganizedMeetings($userId){
          $userId = intval($userId);
          $db = Db::getConnection();
          $OrgMeetings = array();

              $query = 'select * from meetings where creater_id = '. $userId;

              $result = $db->query($query);

              $i=0;
              while($row = $result->fetch()){
                  $OrgMeetings[$i]['id'] = $row['id'];
                  $OrgMeetings[$i]['title'] = $row['title'];
                  $OrgMeetings[$i]['description'] = $row['description'];
                  $i++;

              }
              return $OrgMeetings;

        }

        public static function getAvailableOrganizedMeetings($userId,$invitedId){
          $userId = intval($userId);
          $db = Db::getConnection();
          $OrgMeetings = array();

          $query = 'SELECT * FROM meetings WHERE creater_id='.$userId.' AND meetings.id '
                .' NOT IN (SELECT participants.meeting_id FROM participants WHERE user_id= '.$invitedId.') '
                .' AND  meetings.id NOT IN (SELECT invitations.meeting_id FROM invitations '
                .' WHERE invited_id= '.$invitedId.' and inviter_id='.$userId.');';

          $result = $db->query($query);

          $i=0;
          while($row = $result->fetch()){
              $OrgMeetings[$i]['id'] = $row['id'];
              $OrgMeetings[$i]['title'] = $row['title'];
              $OrgMeetings[$i]['date'] = $row['date'];
              $OrgMeetings[$i]['city'] = $row['city'];
              $OrgMeetings[$i]['place'] = $row['place'];
              $i++;

          }
          return $OrgMeetings;
        }

        public static function getAvailableMeetings($userId,$invitedId){
          $userId = intval($userId);
          $invitedId = intval($invitedId);
          $db = Db::getConnection();
          $ParMeetings = array();

          $query = 'SELECT meetings.id, meetings.title, meetings.date, meetings.city,
                    meetings.place, meetings.closeMeetup, meetings.creater_id,
                    participants.meeting_id, participants.user_id FROM meetings INNER JOIN participants '
                .' ON meetings.id = participants.meeting_id WHERE participants.user_id='.$userId.' AND meetings.closeMeetup=0 AND participants.meeting_id '
                .' NOT IN (SELECT meetings.id FROM meetings WHERE creater_id= '.$userId.') '
                .' AND meetings.id '
                      .' NOT IN (SELECT meetings.id FROM meetings WHERE creater_id= '.$invitedId.') '
                .' AND meetings.id '
                      .' NOT IN (SELECT participants.meeting_id FROM participants WHERE user_id= '.$invitedId.') '
                .' AND  meetings.id NOT IN (SELECT invitations.meeting_id FROM invitations '
                .' WHERE invited_id= '.$invitedId.' and inviter_id='.$userId.');';

          $result = $db->query($query);

          $i=0;
          while($row = $result->fetch()){
              $ParMeetings[$i]['id'] = $row['id'];
              $ParMeetings[$i]['title'] = $row['title'];
              $ParMeetings[$i]['date'] = $row['date'];
              $ParMeetings[$i]['city'] = $row['city'];
              $ParMeetings[$i]['place'] = $row['place'];
              $ParMeetings[$i]['closeMeetup'] = $row['closeMeetup'];
              $i++;

          }
          return $ParMeetings;
        }

        public static function getUsersOfMeeting($id){
            $id = intval($id);
            if($id){
                $db = Db::getConnection();
                $usersList = array();

                $query = 'SELECT users.name, users.surname, participants.user_id FROM users INNER JOIN participants'
                         .' ON users.id = participants.user_id WHERE meeting_id = '.$id.';';

                $result = $db->query($query);

                $i=0;
                while($row = $result->fetch()){
                    $usersList[$i]['user_id'] = $row['user_id'];
                    $usersList[$i]['name'] = $row['name'];
                    $usersList[$i]['surname'] = $row['surname'];
                    $i++;

                }
                return $usersList;
            }
        }

        public static function getOrganizerOfMeeting($id){
          $id = intval($id);
          if($id){
            $db = Db::getConnection();
            $organizer = array();

            $query = 'SELECT users.name, users.surname, meetings.creater_id FROM users INNER JOIN meetings'
                     .' ON users.id = meetings.creater_id WHERE meetings.id = '.$id.';';

            $result = $db->query($query);

            $i=0;
            while($row = $result->fetch()){
                $organizer[$i]['creater_id'] = $row['creater_id'];
                $organizer[$i]['name'] = $row['name'];
                $organizer[$i]['surname'] = $row['surname'];
                $i++;

            }
            return $organizer;
          }
        }

        public static function getPersonsMeetings($userId){
          $userId = intval($userId);
          $db = Db::getConnection();
          $Meetings = array();
          $query = 'SELECT meetings.title, participants.meeting_id FROM meetings INNER JOIN participants '
                  .' ON meetings.id = participants.meeting_id WHERE participants.user_id = '.$userId.' ;';

          $result = $db->query($query);

          $i=0;
          while($row = $result->fetch()){
              $Meetings[$i]['meeting_id'] = $row['meeting_id'];
              $Meetings[$i]['title'] = $row['title'];
              $i++;

          }
          return $Meetings;

        }

        public static function getLatestMeetings($count = self::SHOW_BY_DEFAULT){
            $count = intval($count);
            $db = Db::getConnection();

            $meetingsLatestList = array();

            $query = 'SELECT meetings.id, meetings.title, meetings.theme, meetings.description,
            meetings.date, meetings.city, meetings.place, interests.name_interest from meetings INNER JOIN interests '
            .'ON meetings.theme = interests.id where closeMeetup = 0 order by id DESC limit '.$count;

            $result = $db->query($query);

            $i=0;
            while($row = $result->fetch()){
                $meetingsLatestList[$i]['id'] = $row['id'];
                $meetingsLatestList[$i]['title'] = $row['title'];
                $meetingsLatestList[$i]['theme'] = $row['theme'];
                $meetingsLatestList[$i]['name_interest'] = $row['name_interest'];
                $meetingsLatestList[$i]['date'] = $row['date'];
                $meetingsLatestList[$i]['city'] = $row['city'];
                $meetingsLatestList[$i]['place'] = $row['place'];
                $meetingsLatestList[$i]['description'] = $row['description'];
                $i++;

            }
            return $meetingsLatestList;
        }

        public static function getMeetImage($id){
            // Название изображения по умолчанию
            $noImage = 'no-image.jpg';

            $path = '/upload/images/meetings/';
            $pathToProductImage = $path . $id . '.jpg';
            if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
                return $pathToProductImage;
            }
            return $path . $noImage;
        }

        public static function createMeeting($title,$inter,$fixedDate,$city,$place,$description,$userId,$closeMeetup,$lat,$lng){
          $db = Db::getConnection();

          $sql = 'INSERT INTO meetings(title, theme, date, city, description, creater_id, place, closeMeetup, lat, lng) '
                  .' VALUES(:title, '.$inter.',"'.$fixedDate.'", :city, :description,'.$userId.',:place,'.$closeMeetup.', :lat, :lng);';

                  $result = $db->prepare($sql);
                  $result->bindParam(':title', $title, PDO::PARAM_STR);
                  $result->bindParam(':city', $city, PDO::PARAM_STR);
                  $result->bindParam(':description', $description, PDO::PARAM_STR);
                  $result->bindParam(':place', $place, PDO::PARAM_STR);
                  $result->bindParam(':lat', $lat, PDO::PARAM_STR);
                  $result->bindParam(':lng', $lng, PDO::PARAM_STR);
            if ($result->execute()) {
              return $db->lastInsertId();
            }

            return 0;
          }

        public static function editMeeting($meetId,$title,$inter,$fixedDate,$city,$place,$description,$userId,$closeMeetup,$lat,$lng){
          $db = Db::getConnection();

          $sql = "UPDATE meetings
                  SET title = :title, theme = '$inter', date = '$fixedDate', city = :city,
                  description = :description, place = :place, closeMeetup = '$closeMeetup', lat = :lat, lng = :lng
                  WHERE creater_id = '$userId' AND id ='$meetId' ";

                  $result = $db->prepare($sql);
                  $result->bindParam(':title', $title, PDO::PARAM_STR);
                  $result->bindParam(':city', $city, PDO::PARAM_STR);
                  $result->bindParam(':description', $description, PDO::PARAM_STR);
                  $result->bindParam(':place', $place, PDO::PARAM_STR);
                  $result->bindParam(':lat', $lat, PDO::PARAM_STR);
                  $result->bindParam(':lng', $lng, PDO::PARAM_STR);
          return $result->execute();

        }

        public static function deleteMeetupById($id){
            $db = Db::getConnection();
            $sql = "DELETE FROM invitations WHERE meeting_id = :id;
                    DELETE FROM participants WHERE meeting_id = :id;
                    DELETE FROM meetings WHERE id = :id";

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            return $result->execute();
        }

        public static function addMember($userId, $id){
          $db = Db::getConnection();

          $sql = 'INSERT INTO participants (user_id, meeting_id) '
                     . 'VALUES ('.$userId.', '.$id.');';
          $result = $db->prepare($sql);
          return $result->execute();

        }

        public static function deleteMember($userId, $id){
          $db = Db::getConnection();

          $sql = 'DELETE FROM participants WHERE user_id ='.$userId.' and meeting_id='.$id .';';

          $result = $db->prepare($sql);
          return $result->execute();
        }

        public static function checkParticipation($userId,$id){
          $db = Db::getConnection();

          $sql = 'SELECT COUNT(*) as count FROM participants WHERE user_id ='.$userId.' and meeting_id='.$id .';';
          $result = $db->prepare($sql);
          $result->execute();
          return $result->fetchAll();
        }

        public static function getRecMeetings($city,$int_id){
          $db = Db::getConnection();
          $meetingsRecList = array();

          $sql = 'SELECT id, title, date, city, place FROM meetings WHERE theme='.$int_id.' AND city="'.$city.'" AND closeMeetup=0 AND date >= CURDATE() ORDER BY date DESC;';

          $result = $db->query($sql);

          $i=0;
          while($row = $result->fetch()){
              $meetingsRecList[$i]['id'] = $row['id'];
              $meetingsRecList[$i]['title'] = $row['title'];
              $meetingsRecList[$i]['date'] = $row['date'];
              $meetingsRecList[$i]['city'] = $row['city'];
              $meetingsRecList[$i]['place'] = $row['place'];
              $i++;

          }
          return $meetingsRecList;
        }

        public static function getCountOfRecMeetings($valueId,$city){
          $db = Db::getConnection();

          $sql = 'SELECT COUNT(*) as count FROM meetings WHERE theme='.$valueId.' and city="'.$city.'" and closeMeetup=0 AND date >= CURDATE() ;';

          $result = $db->prepare($sql);
          $result->execute();
          return $result->fetchAll();
        }
    }

?>
