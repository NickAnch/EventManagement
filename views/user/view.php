<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Пользватель - <?php echo $userItem['surname']?></title>
  <link rel="stylesheet" href="/template/css/bootstrap.css">
  <style media="screen">
  .card-img-top {
     color: #f6f6f6;
     width: auto;
     height: 30rem;
     background: url(<?php echo User::getUserImage($userItem['id']);?>) center no-repeat;
     background-size: cover;
   }
   span.badge{
     font-size: 15px;
   }
   p.city{
     margin-top: 15px;
   }
   .card{
     margin-top: 15px;
   }
   p.un{
     margin-top: 10px;
     margin-left: 15px;
   }
  </style>
</head>
<body>
  <?php include ROOT.'/views/layout/header.php';?>
  <div class="container">
    <div class="card">
      <div class="row">
        <div class="col-md-6">
          <div class="card-img-top">
          </div>
        </div>
        <div class="col-md-6">
          <div class="card-body">
            <h1><?php echo $userItem['name'].' '.$userItem['surname']?></h1>
            <p class="card-text"><b>Интересы:</b> </p>
            <div>
            <?php foreach ($themes as $value): ?>
              <span class="badge badge-info">
                <?php echo $value['name_interest'].' '; ?>
              </span>
            <?php endforeach; ?>
            </div>
            <p class="card-text city"><b>Город: </b><?php echo $userItem['city'] ?></p>
            <a class="btn btn-outline-primary" href="/inviteUser/<?php echo $userItem['id'] ?>"  >Пригласить на мероприятие</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
        <div class="card descr" >
          <div class="card-header">
            Участник
          </div>
          <ul class="list-group list-group-flush">
          <?php if($Meetings): ?>
            <?php foreach ($Meetings as $value): ?>
            <li class="list-group-item"><a href="/meetings/<?php echo $value['meeting_id'];?>"><?php echo $value['title'];?> </a></li>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="un">Данный пользователь не участвует ни в одном мероприятии.</p>
          <?php endif; ?>
          </ul>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
        <div class="card descr" >
          <div class="card-header">
            Организатор
          </div>
          <ul class="list-group list-group-flush">
          <?php if($OrgMeetings): ?>
            <?php foreach ($OrgMeetings as $value): ?>
              <li class="list-group-item"><a href="/meetings/<?php echo $value['id'];?>"><?php echo $value['title'];?> </a></li>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="un">Данный пользователь не организовал ни одного мероприятия.</p>
          <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <?php include ROOT.'/views/layout/footer.php';?>
</body>
</html>
