<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Управление интересами</title>
    <link rel="stylesheet" href="/template/css/bootstrap.css">
    <style media="screen">
      p.un{
        margin-top: 10px;
        margin-left: 15px;
      }
    </style>
</head>
<body>
  <?php include ROOT.'/views/layout/header.php';?>
  <div class="container">
    <h1>Личный профиль</h1>
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link" href="/profile">Моя страница</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/edit">Изменить информацию о себе</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="/manageIneterests">Редактировать интересы</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/eventNotifications">Оповещения
          <span class="badge badge-dark"><?php echo User::getCountOfNotifications($userId);?></span>
        </a>
      </li>
    </ul>
    <h2>Управление интересами</h1>
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
        <div class="card descr" >
          <div class="card-header">
            Вы можете добавить интересы:
          </div>
          <ul class="list-group list-group-flush availableInterests">
            <?php foreach ($themesAvail as $val): ?>
            <li class="list-group-item itemOfAvailable">
              <?php echo $val['name_interest']; ?>
              <a href="/addInterest/<?php echo $val['id'];?>" class="addInt">Добавить</a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
        <div class="card descr" >
          <div class="card-header">
            Ваши интересы:
          </div>
          <ul class="list-group list-group-flush listOfInterests">
            <?php if($themes): ?>
              <?php foreach ($themes as $value): ?>
              <li class="list-group-item itemOfInterest">
                <?php echo $value['name_interest']; ?>
                <a href="/deleteInterest/<?php echo $value['id'];?>" class="deleteInt">Удалить</a>
              </li>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="un">Вы не выбрали ни одного интереса</p>
          <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
    </div>
    
    <?php include ROOT.'/views/layout/footer.php';?>
</body>
</html>
