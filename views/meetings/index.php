<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Мероприятия</title>
    <link rel="stylesheet" href="/template/css/bootstrap.css">
    <style media="screen">
      h1{
        text-align: center;
      }
      .card{
        margin-top: 25px;
      }
    </style>
</head>
<body>
    <?php include ROOT.'/views/layout/header.php';?>
    <div class="container">
    <h1>Все мероприятия</h1>

    <div class="row">
      <?php foreach ($meetingsList as $meetingItem): ?>
      <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
        <div class="card" >
          <img class="card-img-top" src="/template/img/im.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title"><?php echo $meetingItem['title'] ?></h5>
            <p class="card-text"> <b>Дата: </b> <?php echo $meetingItem['date'] ?></p>
            <p class="card-text"><b>Город: </b><?php echo $meetingItem['city'] ?></p>
            <p class="card-text"> <b>Адрес: </b><?php echo $meetingItem['place'] ?></p>
            <a href="/meetings/<?php echo $meetingItem['id']?>" class="btn btn-outline-primary ">Подробнее</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php include ROOT.'/views/layout/footer.php';?>
</body>
</html>
