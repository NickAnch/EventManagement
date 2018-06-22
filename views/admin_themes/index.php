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
  <h4>Список тем</h4>
  <a href="/admin/theme/create">Добавить тему</a>

  <table class='table table-striped '>
    <thead class='thead-light '>
      <tr >
        <th  >ID</th>
        <th  >Название темы</th>
        <th ></th>
        <th ></th>
      </tr>

    </thead>

    <tbody>
      <?php foreach ($themesList as $theme): ?>
          <tr>
              <th ><?php echo $theme['id']; ?></th>
              <td ><?php echo $theme['name_interest']; ?></td>
              <td ><a href="/admin/theme/update/<?php echo $theme['id']; ?>" >Изменить</a></td>
              <td ><a href="/admin/theme/delete/<?php echo $theme['id']; ?>" >Удалить</a></td>
          </tr>
      <?php endforeach; ?>

    </tbody>
  </table>

  <?php include ROOT.'/views/layout/footer.php';?>
</body>
</html>
