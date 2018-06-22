<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Приглашение</title>
    <style media="screen">
    h1{
      text-align: center;
    }
    .alert{
      margin-top: 25px;
    }
    .alert-danger{
      margin-top: 15px;
      margin-left: 15px;
    }
    </style>
    <link rel="stylesheet" href="/template/css/bootstrap.css">
</head>
<body>
    <?php include ROOT.'/views/layout/header.php';?>
    <div class="container">
      <h1>Пригласить на мероприятие</h1>
      <?php if (!empty($meetingsList) || !empty($meetingsListPar)):?>
      <div class="alert alert-secondary" role="alert">
        <h5>Список ваших мероприятий, на которые вы можете пригласить пользователя -
          <a href="/user/<?php echo $invitedId; ?>"><?php echo $invitedName; ?> </a>.
        </h5>
      </div>
      <div>
        <div class="alert alert-success" role="alert">
          <p>Мероприятия, которые организуете вы:</p>
        </div>
        <div class="row">
        <?php if (empty($meetingsList)): ?>
          <div class="alert alert-danger" role="alert">
            <p>У вас нет организуемых мероприятий, на которые вы могли бы пригласить пользователя.</p>
            <hr>
            <a href="/createMeeting/" class="alert-link">Организовать мероприятие</a>
          </div>
        <?php endif; ?>
        <?php foreach ($meetingsList as $meetingItem): ?>
          <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="card" >
              <img class="card-img-top" src="<?php echo Meetings::getMeetImage($meetingItem['id']);?>" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><?php echo $meetingItem['title']; ?></h5>
                <p class="card-text"> <b>Дата: </b> <?php echo $meetingItem['date'] ?></p>
                <p class="card-text"><b>Город: </b><?php echo $meetingItem['city'] ?></p>
                <p class="card-text"> <b>Адрес: </b><?php echo $meetingItem['place'] ?></p>
                <a href="/addInvitedMember/<?php echo $meetingItem['id'].'/'.$invitedId ?>"  class="btn btn-success">Пригласить пользователя</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
        </div>
        <div class="alert alert-success" role="alert">
          <p>Открытые мероприятия, в которых вы участвуете:</p>
        </div>
        <div class="row">
          <?php if (empty($meetingsListPar)): ?>
            <div class="alert alert-danger" role="alert">
              <p>Вы не участвуете в мероприятиях, на которые могли бы пригласить данного пользователя.</p>
              <hr>
              <a href="/meetings/" class="alert-link">Найти мероприятие</a>
            </div>
          <?php endif; ?>
        <?php foreach ($meetingsListPar as $meetingItemPar): ?>
          <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="card" >
              <img class="card-img-top" src="<?php echo Meetings::getMeetImage($meetingItemPar['id']);?>" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><?php echo $meetingItemPar['title']; ?></h5>
                <p class="card-text"> <b>Дата: </b> <?php echo $meetingItemPar['date'] ?></p>
                <p class="card-text"><b>Город: </b><?php echo $meetingItemPar['city'] ?></p>
                <p class="card-text"> <b>Адрес: </b><?php echo $meetingItemPar['place'] ?></p>
                <a href="/addInvitedMember/<?php echo $meetingItemPar['id'].'/'.$invitedId ?>"  class="btn btn-success">Пригласить пользователя</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
        </div>
      <?php else:?>
        <div class="alert alert-danger" role="alert">
          <p>У вас нет мероприятий, на которые вы могли бы пригласить данного пользователя.</p>
          <hr>
          <a href="/createMeeting/" class="alert-link">Организовать мероприятие</a>
        </div>
      <?php endif; ?>
      </div>

    </div>

    <?php include ROOT.'/views/layout/footer.php';?>
</body>
</html>
