<?php
    class Meetings {

        const SHOW_BY_DEFAULT = 5;

        public static function getMeetingById($id){
            $id = intval($id);
            if($id){
                $db = Db::getConnection();

                $query = 'select * from meetings where id = '. $id;

                $result = $db->query($query);

                $result->setFetchMode(PDO::FETCH_ASSOC);

                $meetingItem = $result->fetch();
                return $meetingItem;
            }
        }

        public static function getMeetingsList($page = 1){
            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
            $db = Db::getConnection();
            $meetingsList = array();

            $query = 'select id, title, description from meetings where closeMeetup = 0 order by id DESC '
                    . ' limit '.self::SHOW_BY_DEFAULT
                    .' offset '. $offset;

            $result = $db->query($query);

            $i=0;
            while($row = $result->fetch()){
                $meetingsList[$i]['id'] = $row['id'];
                $meetingsList[$i]['title'] = $row['title'];
                $meetingsList[$i]['description'] = $row['description'];
                $i++;

            }
            return $meetingsList;
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

          $query = 'SELECT * FROM meetings WHERE meetings.id '
                .' NOT IN (SELECT meeting_id FROM invitations WHERE creator_id = '.$userId.'AND invited_id='.$invitedId.') AND '
                .' NOT IN (SELECT meeting_id FROM participants WHERE user_id= '.$invitedId.');';
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

            $query = 'select id, title, description from meetings where closeMeetup = 0 order by id DESC limit '.$count ;

            $result = $db->query($query);

            $i=0;
            while($row = $result->fetch()){
                $meetingsLatestList[$i]['id'] = $row['id'];
                $meetingsLatestList[$i]['title'] = $row['title'];
                $meetingsLatestList[$i]['description'] = $row['description'];
                $i++;

            }
            return $meetingsLatestList;
        }

        public static function createMeeting($title,$inter,$fixedDate,$city,$place,$description,$userId,$closeMeetup,$lat,$lng){
          $db = Db::getConnection();

          $sql = 'INSERT INTO meetings(title, theme, date, city, description, creater_id, place, closeMeetup, lat, lng) '
                  .' VALUES(:title, '.$inter.',"'.$fixedDate.'", :city, :description,'.$userId.',:place,'.$closeMeetup.', :lat, :lng);';
                  echo $sql;
                  $result = $db->prepare($sql);
                  $result->bindParam(':title', $title, PDO::PARAM_STR);
                  $result->bindParam(':city', $city, PDO::PARAM_STR);
                  $result->bindParam(':description', $description, PDO::PARAM_STR);
                  $result->bindParam(':place', $place, PDO::PARAM_STR);
                  $result->bindParam(':lat', $lat, PDO::PARAM_STR);
                  $result->bindParam(':lng', $lng, PDO::PARAM_STR);
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
    }

?>
