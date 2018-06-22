<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Рекомендации</title>
  <link rel="stylesheet" href="/template/css/bootstrap.css">
  <style media="screen">
    .alert-info,
    .alert-danger{
      margin-left:15px;
    }
    .active {
      border: 1px solid black;
      border-radius: 8px;
    }
  </style>
</head>
<body>
  <?php include ROOT.'/views/layout/header.php';?>
  <div class="container">
    <h1>Рекомендации</h1>
    <div class="alert alert-secondary" role="alert">
      <ul class="listOfInterests nav">
        <?php $i = 0 ?>
        <?php if ($themes):?>
        <?php foreach ($themes as $value): ?>
          <li class= "itemOfInterest nav-item">

            <a href="#" data-id="<?php echo $value['id'];?>" class="selectInt nav-link">
              <?php echo $value['name_interest'].'  '; ?><span class="badge badge-dark"><?php echo $count[$i++][0]['count']; ?></span>

            </a>

          </li>
        <?php endforeach; ?>
      </ul>
    </div>
      <div class="row listOfMeetings">
        <div class="alert alert-info" role="alert">
          Выберите тему!
        </div>
      </div>
    <?php else:?>
      <p>Для формирования рекомендация необходимо выбрать их в личном кабинете, в разделе <a href="/manageInterests">Редактировать интересы</a> </p>
    <?php endif; ?>
  </div>

  <?php include ROOT.'/views/layout/footer.php';?>


  <script>
    $(document).ready(function(){
      $(document.body).on("click",".selectInt", function(){
        var id = $(this).attr("data-id");
        setTimeout(function () {
          $.post("/getRecommendedMeetings/"+id, {}, function (data){
            if(!data){
              $(".listOfMeetings").html('По данной теме нет никаких мероприятий');
            } else {
            $(".listOfMeetings").html(data);
            }
          })
        },500);

        return false;
      });

    });
    $("ul.listOfInterests li a.nav-link").click(function(e) {
      e.preventDefault();
      $("ul.listOfInterests li a.nav-link").removeClass('active');
      $(this).addClass('active');
    })
  </script>

</body>
</html>
