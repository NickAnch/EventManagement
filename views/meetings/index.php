<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мероприятия</title>
</head>
<body>
    <?php include ROOT.'/views/layout/header.php';?>
    <h1>Мероприятия</h1>
    <?php foreach ($meetingsList as $meetingItem): ?>
    <div>
        <h2><?php echo $meetingItem['title']; ?></h2>
        <p> <?php echo $meetingItem['description']; ?> </p>
        <a href="/meetings/<?php echo $meetingItem['id'];?>">Подробнее</a>
    </div>
    <?php endforeach; ?>
</body>
</html>
