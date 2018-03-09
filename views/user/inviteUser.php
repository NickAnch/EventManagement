<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Приглашение</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <?php include ROOT.'/views/layout/header.php';?>
    <h1>Пригласить на мероприятие</h1>
    Список мероприятий:
    <?php foreach ($meetingsList as $meetingItem): ?>
          <div>
              <h2><?php echo $meetingItem['title']; ?></h2>
              <p> <?php echo $meetingItem['description']; ?> </p>
              <a href="/addInvitedMember/<?php echo $meetingItem['id'].'/'.$invitedId ?>">Пригласить</a>
          </div>
    <?php endforeach; ?>
</body>
</html>
