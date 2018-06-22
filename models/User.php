<?php

class User{

    public static function register($name, $surname, $email, $city, $password){
        $db = Db::getConnection();
         // Текст запроса к БД
         $sql = 'INSERT INTO users (name, surname, email, city, password) '
                 . 'VALUES (:name, :surname, :email, :city, :password)';
         // Получение и возврат результатов. Используется подготовленный запрос
         $result = $db->prepare($sql);
         $result->bindParam(':name', $name, PDO::PARAM_STR);
         $result->bindParam(':surname', $surname, PDO::PARAM_STR);
         $result->bindParam(':email', $email, PDO::PARAM_STR);
         $result->bindParam(':city', $city, PDO::PARAM_STR);
         $result->bindParam(':password', $password, PDO::PARAM_STR);
         return $result->execute();
    }

    public static function edit($id, $name, $surname, $city, $pass){
        $db = Db::getConnection();

        $sql = "UPDATE users
                SET name = :name, surname = :surname, city = :city, password = :password
                WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);
        $result->bindParam(':city', $city, PDO::PARAM_STR);
        $result->bindParam(':password', $pass, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function checkEmailExists($email){
        $db = Db::getConnection();
        $query = 'select count(*) from users where email = :email';

        $result = $db->prepare($query);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn())
            return true;
        return false;
    }

    public static function checkUserData($email, $pass){
        $db = Db::getConnection();
        $query = 'SELECT * FROM users WHERE email = :email AND password = :password';

        $result = $db->prepare($query);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $pass, PDO::PARAM_INT);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return $user['id'];
        }
        return false;
    }

    public static function getNameOfUser($id){
        $db = Db::getConnection();
        $query = 'SELECT name FROM users WHERE id='.$id.';';

        $result = $db->prepare($query);
        $result->execute();

        $users = $result->fetch();
        if ($users) {
            return $users['name'];
        }
        return false;
    }

    public static function auth($userId, $nameOfUser){
      $_SESSION['user'] = $userId;
      $_SESSION['name'] = $nameOfUser;
    }

    public static function checkLogged(){
      if (isset($_SESSION['user'])){
        return $_SESSION['user'];
      }

      header ("Location: /user/login");
    }

    public static function getLoggedID(){
      if (isset($_SESSION['user'])){
        return $_SESSION['user'];
      }

    }

    public static function isGuest(){
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    public static function getUserById($id){
      if($id){
        $db = Db::getConnection();

        $sql = 'SELECT * FROM users WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
      }
    }

    public static function addInterest($userId, $id){
        $db = Db::getConnection();

        $sql = 'INSERT INTO chosen_interests (user_id, interest_id) '
                   . 'VALUES ('.$userId.', '.$id.');';

        $result = $db->prepare($sql);
        return $result->execute();
    }

    public static function addInvitedMember($userId, $meetId, $invitedId){
      $db = Db::getConnection();

      $sql = 'INSERT INTO invitations (inviter_id, invited_id, meeting_id) '
                 . ' VALUES ('.$userId.', '.$invitedId.','.$meetId.');';

      $result = $db->prepare($sql);
      return $result->execute();
    }


    public static function deleteInterest($id, $userId){
        $db = Db::getConnection();
        $interestsList = array();

        $sql = 'DELETE FROM chosen_interests WHERE user_id ='.$userId.' and interest_id='.$id .';';

        $result = $db->prepare($sql);

        return $result->execute();
    }

    public static function deleteNotification($userId, $id){
        $db = Db::getConnection();

        $sql = 'DELETE FROM invitations WHERE invited_id ='.$userId.' AND meeting_id='.$id .';';
        $result = $db->prepare($sql);

        return $result->execute();
    }

      public static function getChosenInterests($userId){
        $userId = intval($userId);
        $db = Db::getConnection();
        $interestsList = array();

        $query = 'SELECT interests.name_interest, interests.id FROM interests INNER JOIN chosen_interests '
                .' ON interests.id = chosen_interests.interest_id WHERE chosen_interests.user_id = '.$userId.' ;';
        $result = $db->query($query);

        $i=0;
        while($row = $result->fetch()){
          $interestsList[$i]['id'] = $row['id'];
          $interestsList[$i]['name_interest'] = $row['name_interest'];
          $i++;
        }

        return $interestsList;
      }

      public static function getAvailableInterests($userId){
        $userId = intval($userId);
        $db = Db::getConnection();
        $interestsList = array();

        $query = 'SELECT * FROM interests WHERE interests.id NOT IN '
              .' (SELECT interest_id FROM chosen_interests WHERE user_id = '.$userId.');';
        $result = $db->query($query);
        $i=0;
        while($row = $result->fetch()){
        $interestsList[$i]['id'] = $row['id'];
        $interestsList[$i]['name_interest'] = $row['name_interest'];
        $i++;
        }

        return $interestsList;
      }

      public static function getNotifications($userId){
        $db = Db::getConnection();
        $notificationsList = array();

        $query = 'SELECT invitations.meeting_id, invitations.inviter_id,meetings.title, '
        .'meetings.id, meetings.description,meetings.city, meetings.place,meetings.date,users.name,users.surname  FROM meetings INNER JOIN invitations '
        .'ON meetings.id = invitations.meeting_id '
        .'INNER JOIN users ON users.id = invitations.inviter_id WHERE invitations.invited_id='.$userId.' ;';
        $result = $db->query($query);

        $i=0;
        while($row = $result->fetch()){
          $notificationsList[$i]['id'] = $row['id'];
          $notificationsList[$i]['inviter_id'] = $row['inviter_id'];
          $notificationsList[$i]['name'] = $row['name'];
          $notificationsList[$i]['surname'] = $row['surname'];
          $notificationsList[$i]['city'] = $row['city'];
          $notificationsList[$i]['place'] = $row['place'];
          $notificationsList[$i]['date'] = $row['date'];
          $notificationsList[$i]['meeting_id'] = $row['meeting_id'];
          $notificationsList[$i]['title'] = $row['title'];
          $notificationsList[$i]['description'] = $row['description'];
          $i++;
        }

        return $notificationsList;
      }

      public static function isInvitedOnMeeup($userId,$id){
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) as count FROM invitations WHERE invited_id ='.$userId.' AND meeting_id ='.$id.';';
        $result = $db->prepare($sql);
        $result->execute();
        return $result->fetchAll();
      }

      public static function getCountOfNotifications($id){
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) as count FROM invitations WHERE invited_id='.$id.';';

        $result = $db->prepare($sql);
        $result->execute();
        return $result->fetchColumn();
      }

      public static function getUserImage($id){
          // Название изображения-пустышки
          $noImage = 'no-image.jpg';

          $path = '/upload/images/users/';
          $pathToProductImage = $path . $id . '.jpg';
          if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
              return $pathToProductImage;
          }
          return $path . $noImage;
      }

}

?>
