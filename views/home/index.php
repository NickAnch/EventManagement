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
     <h2>Последние созданные мероприятия:</h2>
     <div class="row">
       <?php foreach ($meetingsLatestList as $meetingItem): ?>
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
    <script>
      function getLocation(){
        if(navigator.geolocation){
          navigator.geolocation.getCurrentPosition(showPosition,error);
        } else{
           $('#city').html('Браузер не поддерживает геолокацию');
           $('#state').html('Браузер не поддерживает геолокацию');
        }
      }

      function showPosition(position){
        var locAPI = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + position.coords.latitude + "%2C" + position.coords.longitude + "&sensor=true";

        $.get({
          url: locAPI,
          success: function(data){
            $('#state').html(data.results[0].address_components[4].long_name);
            $('#city').html(data.results[0].address_components[2].long_name);
            //console.log(data);
          }
        });
      }

      function error(err) {
        console.log(err)
      }

      getLocation();
    </script>
</body>
</html>
