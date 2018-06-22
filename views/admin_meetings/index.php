<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Админпанель</title>
    <link rel="stylesheet" href="/template/css/bootstrap.css">

</head>
<body>
  <?php include ROOT.'/views/layout/headerAdmin.php';?>
  <h4>Список мероприятий</h4>
  <table class='table table-striped '>
    <thead class='thead-light '>
      <tr >
        <th>ID</th>
        <th>Название</th>
        <th>Тема</th>
        <th>Дата</th>
        <th>Место</th>
        <th>Организатор</th>
        <th>Закрытое мероприятие</th>
        <th> </th>
      </tr>

    </thead>

    <tbody>
      <?php foreach ($meetingsList as $meet): ?>
          <tr>
              <th ><?php echo $meet['id']; ?></th>
              <td ><?php echo $meet['title']; ?></td>
              <td ><?php echo $meet['name_interest']; ?></td>
              <td ><?php echo $meet['date']; ?></td>
              <td ><?php echo $meet['place']; ?></td>
              <td ><?php echo $meet['name'].' '. $meet['surname']; ?></td>
              <td ><?php echo $meet['closeMeetup']; ?></td>
              <td ><a href="/admin/meetup/delete/<?php echo $meet['id']; ?>" >Удалить</a></td>
          </tr>
      <?php endforeach; ?>

    </tbody>
  </table>

  <?php include ROOT.'/views/layout/footer.php';?>
</body>
</html>
