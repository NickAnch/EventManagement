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

    <a href="/inviteUser/<?php echo $userItem['id'] ?>" >Пригласить на мероприятие</a>
    <script type = text/javascript>

</script>
</body>
</html>
