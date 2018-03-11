<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мероприятия</title>
</head>
<body>
    <?php include ROOT.'/views/layout/header.php';?>
    <h1 class="display-3">Мероприятия</h1>
    <?php foreach ($meetingsList as $meetingItem): ?>
    <div class="card bg-light mb-3" style="max-width: 20rem;">
        <h2 class="card-header"><?php echo $meetingItem['title']; ?></h2>
        <p class="card-text"> <?php echo $meetingItem['description']; ?> </p>
        <a href="/meetings/<?php echo $meetingItem['id'];?>" class="btn btn-outline-primary">Подробнее</a>
    </div>
    <?php endforeach; ?>

</body>
</html>
