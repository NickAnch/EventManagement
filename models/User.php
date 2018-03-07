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

    public static function auth($userId){
      $_SESSION['user'] = $userId;
    }

    public static function checkLogged(){
      if (isset($_SESSION['user'])){
        return $_SESSION['user'];
      }

      header ("Location: /user/login");
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
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
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

    public static function deleteInterest($id, $userId){
        $db = Db::getConnection();
        $interestsList = array();

        $sql = 'DELETE FROM chosen_interests WHERE user_id ='.$userId.' and id='.$id .';';
        $result = $db->prepare($sql);

        return $result->execute();
    }

      public static function getChosenInterests($userId){
        $userId = intval($userId);
        $db = Db::getConnection();

        $query = 'SELECT interests.name_interest, chosen_interests.id FROM interests INNER JOIN chosen_interests '
                .' ON interests.id = chosen_interests.interest_id WHERE chosen_interests.user_id = '.$userId.' ;';
        $result = $db->query($query);
        $string = '';
        while($row = $result->fetch(PDO::FETCH_OBJ)){
          $string .= '<li class= "itemOfInterest">'.$row->id.' ';
          $string .= $row->name_interest.'<a href="#" data-id="'.$row->id.'" class="deleteInt">Удалить</a></li>';
        }
        return $string;
      }

      public static function getAvailableInterests($userId){
        $userId = intval($userId);
        $db = Db::getConnection();

        $query = 'SELECT * FROM interests WHERE interests.id NOT IN '
              .' (SELECT interest_id FROM chosen_interests WHERE user_id = '.$userId.');';
        $result = $db->query($query);
        $string = '';
        while($row = $result->fetch(PDO::FETCH_OBJ)){
          $string .= '<li class= "itemOfAvailable">'.$row->id.' ';
          $string .= $row->name_interest.'<a href="#" data-id="'.$row->id.'" class="addInt">Добавить</a></li>';

          }
        return $string;
      }

      public static function getAllInterests(){
        $db = Db::getConnection();
        $interestsList = array();

        $query = 'SELECT * FROM interests';
        $result = $db->query($query);

        $i=0;
        while($row = $result->fetch()){
          $interestsList[$i]['id'] = $row['id'];
          $interestsList[$i]['name_interest'] = $row['name_interest'];
          $i++;
        }

        return $interestsList;

      }

}

?>
