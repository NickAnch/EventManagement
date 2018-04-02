<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Рекомендации</title>
  <link rel="stylesheet" href="/template/css/bootstrap.css">
</head>
<body>
  <?php include ROOT.'/views/layout/header.php';?>
  <div class="container">
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
  </div>
  
  <?php include ROOT.'/views/layout/footer.php';?>

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
