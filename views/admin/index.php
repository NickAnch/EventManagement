<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Мероприятия - Главная</title>
    <link rel="stylesheet" href="/template/css/bootstrap.css">

</head>
<body>
  <?php include ROOT.'/views/layout/headerAdmin.php';?>
   <section>
    <div class="container">
      <h1>Панель администратора</h1>
      <h4>Добрый день, администратор!</h4><br>
      <p>Ваши возможности:</p>
        <div class="row">
            <ul>
                <li><a href="/admin/theme">Управление темами (интересами)</a></li>
                <li><a href="/admin/meetup">Просмотр, удаление мероприятий</a></li>
            </ul>

        </div>
    </div>
</section>
    <?php include ROOT.'/views/layout/footer.php';?>
</body>
</html>
