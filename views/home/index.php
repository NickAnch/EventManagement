<?php include_once ROOT. '/models/Meetings.php';?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Мероприятия - Главная</title>
    <link rel="stylesheet" href="/template/css/bootstrap.css">
    <style>
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
     <h1>Управление мероприятиями</h1>
     <div class="alert alert-primary" role="alert">
        <h5>Основные возможности зарегистрированных пользователей</h5>
        <ul>
          <li>Доступ ко всем открытым мероприятиям (и закрытым по приглашению);</li>
          <li>Личный кабинет (редактирование информации о себе);</li>
        </ul>
        <b>Организотор:</b>
        <ul>
          <li>Создание(изменение) мероприятий любого рода (открытые или закрытые);</li>
          <li>Приглашение других пользователей на мероприятия;</li>
        </ul>
        <b>Участник:</b>
        <ul>
          <li>Запись на мероприятие.</li>
        </ul>
      </div>
     <h2>Последние созданные мероприятия:</h2>
     <div class="row">
       <?php foreach ($meetingsLatestList as $meetingItem): ?>
       <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
         <div class="card" >
           <img class="card-img-top" src="<?php echo Meetings::getMeetImage($meetingItem['id']);?>" alt="Card image cap">
           <div class="card-body">
             <h5 class="card-title"><?php echo $meetingItem['title'] ?></h5>
             <p class="card-text"> <b>Дата: </b> <?php echo $meetingItem['date'] ?></p>
             <p class="card-text"><b>Тема: </b> <span class="badge badge-info"><?php echo $meetingItem['name_interest'] ?> </span></p>
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
