<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мероприятия</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
    <?php include ROOT.'/views/layout/header.php';?>
    <h1>Рекомендации</h1>
    <p>Ваши интересы: </p>
    <ul class="listOfInterests">
      <?php $i = 0 ?>
      <?php foreach ($themes as $value): ?>
        <li class= "itemOfInterest">
          <a href="#" data-id="<?php echo $value['id'];?>" class="selectInt"> <?php echo $value['id'] .' '. $value['name_interest'].' '.$count[$i++][0]['count']; ?> </a>
        </li>
      <?php endforeach; ?>
    </ul>
    <div>
      <p>Возможные мероприятия:</p>
      <ul class="listOfMeetings">
        <p>Выберите тематику!</p>
      </ul>
    </div>
    <script>
      $(document).ready(function(){
        $(document.body).on("click",".selectInt", function(){
          var id = $(this).attr("data-id");
          $.post("/getRecommendedMeetings/"+id, {}, function (data){

            if(!data){
              $(".listOfMeetings").html('По данной теме нет никаких мероприятий');
            } else {
            $(".listOfMeetings").html(data);
          }
          });
          return false;
        });
      });
    </script>
</body>
</html>
