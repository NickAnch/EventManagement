<?php
    class Theme {

      public static function getInterestsList(){
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

      public static function getThemeById($id){
        if($id){
          $db = Db::getConnection();

          $sql = 'SELECT * FROM interests WHERE id = :id';
          $result = $db->prepare($sql);
          $result->bindParam(':id', $id, PDO::PARAM_INT);
          $result->setFetchMode(PDO::FETCH_ASSOC);
          $result->execute();
          return $result->fetch();
        }
      }


      public static function createTheme($theme){

        $db = Db::getConnection();

        $sql = 'INSERT INTO interests (name_interest) VALUES (:name)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $theme, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function updateThemeById($id, $theme){

        $db = Db::getConnection();
        $sql = "UPDATE interests SET name_interest = :name WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $theme, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function deleteThemeById($id){
        $db = Db::getConnection();
        $sql = 'DELETE FROM interests WHERE id = :id;';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }


    public static function checkThemeExists($theme){
        $db = Db::getConnection();
        $query = 'SELECT count(*) from interests where name_interest = :name';

        $result = $db->prepare($query);
        $result->bindParam(':name', $theme, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn())
            return true;
        return false;
    }


    }
?>
