<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Мероприятия</title>
    <link rel="stylesheet" href="/template/css/bootstrap.css">
</head>
<body>
  <?php include ROOT.'/views/layout/header.php';?>
  <div class="container">
    <h1>Личный профиль</h1>
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link" href="/profile/">Моя страница</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/edit">Изменить информацию о себе</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/manageInterests/">Редактировать интересы</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="/eventNotifications">Оповещения
          <span class="badge badge-dark"><?php echo User::getCountOfNotifications($userId);?></span>
        </a>
      </li>
    </ul>
  <h2>Приглашения на мероприятия</h2>
  <?php if (!empty($notificationsList)):?>
  <div class="row">
    <?php foreach ($notificationsList as $notifItem): ?>
    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
        <div class="card" >
          <img class="card-img-top" src="<?php echo Meetings::getMeetImage($notifItem['id']);?>" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title"><?php echo $notifItem['title']; ?></h5>
            <p class="card-text"> <b>Дата: </b> <?php echo $notifItem['date'] ?></p>
            <p class="card-text"><b>Город: </b><?php echo $notifItem['city'] ?></p>
            <p class="card-text"> <b>Адрес: </b><?php echo $notifItem['place'] ?></p>
            <p class="card-text"> <b>Пригласил: </b><a href="/user/<?php echo $notifItem['inviter_id'];?>"><?php echo $notifItem['name'].' '.$notifItem['surname'];?></a></p>
            <a href="/meetings/<?php echo $notifItem['meeting_id']?> " class="btn btn-primary">Подробнее</a>
            <a href="/deleteNotification/<?php echo $notifItem['meeting_id'];?>" class="btn btn-outline-danger">Удалить приглашение</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <?php else:?>
        <div class="alert alert-danger" role="alert">
          К сожалению, вас еще не пригласили ни на одно мероприятие.
        </div>
      <?php endif; ?>
    </div>
  </div>
  <?php include ROOT.'/views/layout/footer.php';?>
</body>
</html>
