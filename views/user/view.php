<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Пользватель - <?php echo $userItem['surname']?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
    dialog{
      border-radius: 20px;
      background: yellow;
    }
    </style>
</head>
<body>
    <?php include ROOT.'/views/layout/header.php';?>
    <h1>Пользователь</h1>
    <p><?php echo $userItem['name'].' '.$userItem['surname']?></p>
    <dialog>
      <p>Это окно</p>
      <button id="close">Закрыть</button>
    </dialog>
    <button id="show">Пригласить на мероприятие</button>
    <script type = text/javascript>
    var dialog = document.querySelector('dialog');
    document.querySelector('#show').onclick = function() {
      dialog.showModal();
    };
    document.querySelector('#close').onclick = function() {
      dialog.close();
    };
</script>
</body>
</html>
