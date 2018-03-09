<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мероприятия</title>
</head>
<body>
    <?php include ROOT.'/views/layout/header.php';?>
    <h1>Оповещения о мероприятиях</h1>
    <?php foreach ($notificationsList as $notifItem): ?>
    <div>
        <h2><?php echo $notifItem['title']; ?></h2>
        <p> <?php echo $notifItem['description']; ?> </p>
        <p>Пригласил:<a href="/user/<?php echo $notifItem['creater_id'];?>"><?php echo $notifItem['name'].' '.$notifItem['surname'];?></a></p>
        <a href="/meetings/<?php echo $notifItem['meeting_id'];?>">Подробнее</a>
    </div>
    <?php endforeach; ?>
</body>
</html>
