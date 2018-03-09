<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">

        <title><?php echo $meetingItem['title']?></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <style>
       #map {
         width: 200px;
         height: 200px;
       }
    </style>
    </head>
    <body>
        <?php include ROOT.'/views/layout/header.php';?>
        <h1><?php echo $meetingItem['title']?></h1>
        <?php if($meetingItem['closeMeetup'] == 1 && $isInvited[0]['count'] == 0 && $organizer[0]['creater_id'] != $userId): ?>
          <p>Это закрытое мероприятие, его просмотр возможен только по приглашению</p>
        <?php else: ?>
          <div>
            <div>
                <?php if($meetingItem['closeMeetup'] == 0): ?>
                  <p><b>Это открытое мероприятие</b></p>
                <?php else: ?>
                  <p><b>Это закрытое мероприятие</b></p>
                <?php endif; ?>
                <p><b>Время:</b> <?php echo $meetingItem['date'] ?> </p>
                <p><b>Описание: </b> <?php echo $meetingItem['description'] ?> </p>
                <?php if($member[0]['count'] == 0): ?>
                <div class="manageMembers"><a href="/addMember/<?php echo $meetingItem['id'] ?>" class="addMemb">Я пойду</a></div>
                <?php else: ?>
                <div class="manageMembers"><a href="/deleteMember/<?php echo $meetingItem['id'] ?>" class="delMemb">Я не пойду</a></div>
                <?php endif; ?>
                <p><b>Полный адрес:</b><?php echo $meetingItem['place'] ?></p>
                <b>Расположение на карте:</b>
            </div>
            <div id="map"></div>
            <p><b>Участники:</b></p>
            <ul>
            <?php foreach ($usersList as $value): ?>
              <li><a href="/user/<?php echo $value['user_id'];?>"><?php echo $value['name'].' '.$value['surname'];?> </a></li>
            <?php endforeach; ?>
            </ul>
            <p><b>Организатор:</b></p>
            <ul>
            <?php foreach ($organizer as $value): ?>
              <li><a href="/user/<?php echo $value['creater_id'];?>"><?php echo $value['name'].' '.$value['surname'];?> </a></li>
            <?php endforeach; ?>
            </ul>
          </div>
          <?php endif; ?>
        <a href="/meetings">Все мероприятия</a>
    <script>
      function initMap() {
        var uluru = {lat: <?php echo $meetingItem['lat']?>, lng: <?php echo $meetingItem['lng']?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAFnBJcgPWmhAtB6KIaEc63gZUz3i0jrZk&callback=initMap"></script>
    <script>
    $(document).ready(function(){
      $(document.body).on("click",".addMeymb", function(){
        var id = $(this).attr("data-id");
        $.post("/addMember/"+id, {}, function (data){
          $(".manageMembers").html(data);
        });
        return false;
      });

      $(document.body).on("click",".delMeymb", function(){
        var id = $(this).attr("data-id");
        $.post("/deleteMember/"+id, {}, function (data){
          $(".manageMembers").html(data);
        });
        return false;
      });
    });
    </script>
    </body>
</html>
