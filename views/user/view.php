<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Пользватель - <?php echo $userItem['surname']?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <?php include ROOT.'/views/layout/header.php';?>
    <h1>Пользователь</h1>
    <p><?php echo $userItem['name'].' '.$userItem['surname']?></p>
    <ul class="listOfInterests">
      <?php foreach ($themes as $value): ?>
        <li class= "itemOfInterest">
          <p><?php echo $value['id'] .' '. $value['name_interest'].' ' ?> </p>
        </li>
      <?php endforeach; ?>
    </ul>
    <p>Организатор:</p>
    <ul>
    <?php foreach ($OrgMeetings as $value): ?>
      <li><a href="/meetings/<?php echo $value['id'];?>"><?php echo $value['title'];?> </a></li>
    <?php endforeach; ?>
    </ul>
    <p>Участник:</p>
    <ul>
    <?php foreach ($Meetings as $value): ?>
      <li><a href="/meetings/<?php echo $value['meeting_id'];?>"><?php echo $value['title'];?> </a></li>
    <?php endforeach; ?>
    </ul>
    <a href="/inviteUser/<?php echo $userItem['id'] ?>"  >Пригласить на мероприятие</a>
    <script type = text/javascript>

</script>
</body>
</html>
