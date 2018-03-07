<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление интересами</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <?php include ROOT.'/views/layout/header.php';?>
    <h1>Управление интересами</h1>
    <p>Вы можете добавить интересы:</p>
    <ul class="availableInterests">
      <?php echo $themesAvail; ?>
    </ul>
    <p>Ваши интересы: </p>
    <ul class="listOfInterests">
      <?php echo $themes; ?>
    </ul>
    <script>
      $(document).ready(function(){
        $(document.body).on("click",".deleteInt", function(){
          var id = $(this).attr("data-id");
          $.post("/deleteInterest/"+id, {}, function (data){

            $(".listOfInterests").html(data);
            $(".listOfInterests li.itemOfAvailable").remove();
            $(".availableInterests").html(data);
            $(".availableInterests li.itemOfInterest").remove();
          });
          return false;
        });

        $(document.body).on("click",".addInt", function(){
          var id = $(this).attr("data-id");
          $.post("/addInterest/"+id, {}, function (data){

            $(".availableInterests").html(data);
            $(".availableInterests li.itemOfInterest").remove();
            $(".listOfInterests").html(data);
            $(".listOfInterests li.itemOfAvailable").remove();
          });
          return false;
        });
      });
    </script>
</body>
</html>
