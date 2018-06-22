<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $meetingItem['title']?></title>
    <link rel="stylesheet" href="/template/css/bootstrap.css">
    <style>
     #map {
       width: 100%;
       height: 425px;
     }
     .card-img-top {
        color: #fff;
        height: 22rem;
        background: url(<?php echo Meetings::getMeetImage($meetingItem['id']);?>) center no-repeat;
        background-size: cover;
      }
      .addMemb,
      .delMemb {
        margin-top: 20px;
      }
      .descr{
        margin-top: 10px;
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
  <h1><?php echo $meetingItem['title']?></h1>
  <?php if($organizer[0]['creater_id'] == $userId): ?>
    <div class="alert alert-info" role="alert">Вы организатор данного мероприятия.<br>
      <a href="/editMeeting/<?php echo $meetingItem['id'];?>" class="alert-link">Изменить</a> информацию о нем.</div>
  <?php endif; ?>
  <?php if($meetingItem['closeMeetup'] == 1 && $isInvited[0]['count'] == 0
            && $member[0]['count'] != 1 && $organizer[0]['creater_id'] != $userId): ?>
    <p>Это закрытое мероприятие, его просмотр возможен только по приглашению!</p>
  <?php else: ?>
    <div>
      <section>
        <div class="card">
          <div class="row">
            <div class="col-md-6">
              <div class="card-img-top">
              </div>
            </div>
            <div class="col-md-6">
              <div class="card-body">
                <?php if($meetingItem['closeMeetup'] == 0): ?>
                  <p class="card-text"><b>Это открытое мероприятие</b></p>
                <?php else: ?>
                  <p class="card-text"><b>Это закрытое мероприятие</b></p>
                <?php endif; ?>
                <p class="card-text"><b>Время: </b> <?php echo $meetingItem['date'];?> </p>
                <p class="card-text"><b>Тема мероприятия: </b> <span class="badge badge-info"><?php echo $meetingItem['name_interest'] ?> </span></p>
                <p class="card-text"><b>Организатор:</b>
                  <a  href="/user/<?php echo $organizer[0]['creater_id'];?>">
                    <?php echo $organizer[0]['name'].' '.$organizer[0]['surname'];?>
                  </a>
                </p>
                <p class="card-text"><b>Полный адрес: </b><?php echo $meetingItem['place'] ?></p>
                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModalCenter" >
                  Посмотреть на карте
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Карта</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div id="map"></div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                      </div>
                    </div>
                  </div>
                </div>
                <?php if($userId): ?>
                <div>
                  <?php if($member[0]['count'] == 0): ?>
                  <div class="manageMembers">
                    <a href="/addMember/<?php echo $meetingItem['id'] ?>" class="addMemb btn btn-success ">
                      <?php
                        $date = date('Y-m-d H:i:s');
                        if ($meetingItem['date'] > $date){echo "Я пойду";} else {echo "Я ходил";}
                        ?>
                    </a>
                  </div>
                  <?php else: ?>
                  <div class="manageMembers">
                    <a href="/deleteMember/<?php echo $meetingItem['id'] ?>" class="delMemb btn btn-danger">
                      <?php
                        $date = date('Y-m-d H:i:s');
                        if ($meetingItem['date'] > $date){echo "Я не пойду";} else {echo "Я не ходил";} 
                        ?>
                    </a>
                  </div>
                  <?php endif; ?>
                </div>
                <?php else: ?>
                  <p>Для того, чтобы пойти на мероприятие , необходимо войти в систему: <a href="/user/login">Авторизация</a></p>
              <?php endif; ?>
                </div>
            </div>
          </div>
        </div>
      </section>
      <div class="card descr">
        <div class="row">
          <div class="col-12">
            <div class="card-header">
              Описание
            </div>
            <div class="card-body">
              <p><?php echo $meetingItem['description'] ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="card descr" >
        <div class="row">
          <div class="col-12">
            <div class="card-header">
              Участники
            </div>
            <ul class="list-group list-group-flush">
            <?php if ($usersList): ?>
              <?php foreach ($usersList as $value): ?>
                <li class="list-group-item"><a href="/user/<?php echo $value['user_id'];?>"><?php echo $value['name'].' '.$value['surname'];?> </a></li>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="un">В данном мероприятии пока никто не участвует.</p>
            <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>

  <?php include ROOT.'/views/layout/footer.php';?>
  <script>
    function initMap() {
      var uluru = {lat: <?php echo $meetingItem['lat']?>, lng: <?php echo $meetingItem['lng']?>};
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: uluru
      });
      var marker = new google.maps.Marker({
        position: uluru,
        map: map
      });
    }
  </script>
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAFnBJcgPWmhAtB6KIaEc63gZUz3i0jrZk&callback=initMap"></script>

</body>
</html>
