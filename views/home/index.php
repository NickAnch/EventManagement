<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   <?php include ROOT.'/views/layout/header.php';?>
    <h1>ГЛАВНАЯ СТРАНИЦА</h1>
    <h2>Последние созданные мероприятия:</h2>
    <?php foreach ($meetingsLatestList as $meetingItem): ?>
    <div>
        <h2><?php echo $meetingItem['title'] ?></h2>
        <p> <?php echo $meetingItem['description'] ?> </p>
        <a href="/meetings/<?php echo $meetingItem['id']?>">Подробнее</a>
    </div>
    <?php endforeach; ?>
    <script src="http://yastatic.net/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
      window.onload = function () {
          jQuery("#user-city").val(ymaps.geolocation.city);
      }
    </script>
    <script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>


    Вы находитесь: <input type='text' name='city' id='user-city' value='' />
          
</body>
</html>
