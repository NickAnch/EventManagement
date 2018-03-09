<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <?php include ROOT.'/views/layout/header.php';?>
    <h1>Личный профиль</h1>
    <p>Здравствуйте, <?php echo $user['name'].' '. $user['surname']. '!'?></p>
    <a href="/manageInterests/">Редактировать инетересы</a> <br>
    <a href="/eventNotifications/">Оповещения</a>
    <p>Ваши интересы: </p>
    <ul class="listOfInterests">
      <?php echo $themes; ?>
    </ul>
    <p>Организатор:</p>
    <ul>
    <?php foreach ($OrgMeetings as $value): ?>
      <li><a href="/meetings/<?php echo $value['id'];?>"><?php echo $value['title'];?> </a></li>
    <?php endforeach; ?>
    </ul>

    <p>Участник:</p>
    <ul>
    <?php foreach ($PerMeetings as $value): ?>
      <li><a href="/meetings/<?php echo $value['meeting_id'];?>"><?php echo $value['title'];?> </a></li>
    <?php endforeach; ?>
    </ul>
    <script>
      $(document).ready(function(){
        $(".deleteInt").remove();
      });
    </script>
</body>
</html>
