<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание мероприятия</title>
    <!--<script src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>-->
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAFnBJcgPWmhAtB6KIaEc63gZUz3i0jrZk&libraries=places"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="/template/js/jquery.geocomplete.js"></script>
    <style>
      #map{
        width: 500px;
        height: 500px;
      }
    </style>
</head>
<body>
    <?php include ROOT.'/views/layout/header.php';?>
    <h1>Создание мероприятия</h1>
    <form action="#" method="post" class="mapDetail">
        <?php if (User::isGuest()): ?>
            <p>Для того, чтобы создать мероприятие, вам необходимо войти в систему</p>
            <a href="/user/register/">Регистрация</a><br>
            <a href="/user/login/">Вход</a>
        <?php else: ?>
        Скрытое мероприятие: <input type="checkbox" name="closeMeetup"><br>
        <input type="text" name="title" placeholder="Название"><br>
        <?php
          echo '<select id = "myselect" name="inter">';
            foreach ($interestsList as $value) {
              echo '<option value='. $value['id'] .'>'. $value['name_interest'].'</option>';
            }
          echo '</select> <br>';
        ?>
        <input type="datetime-local" name="date" placeholder="Дата"><br>
          Город:<input type="text" name="locality" placeholder="Город" value=""  style="display: none;"><br>
        Полный Адрес:<input type="text" name="formatted_address" placeholder="Адрес" value=""><br>
        Latitude:   <input name="lat" type="text" value=""  style="display: none;"><br>
        Longitude:  <input name="lng" type="text" value=""  style="display: none;"><br>
        <p><b>Описание:</b></p>
        <textarea name="description" rows="8" cols="80"></textarea><br>
        <button type="submit" class="btn" name="createMeeting">Создать</button>
      <?php endif; ?>
   </form>
   <input type="text" id="inputmap">
   <div id="map"></div>
   <form class="mapDetai">
  Full Address:  <!--  <input name="formatted_address" type="text" value="">-->
    <!--<input name="locality" type="text" value="">-->
  Street :  <input name="location" type="text" value="">

</form>

   <script>
     $("#inputmap").geocomplete({
       map: "#map",
       details: ".mapDetail"
     });
   </script>
</body>
</html>
