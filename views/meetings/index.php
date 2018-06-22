
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Мероприятия</title>
    <link rel="stylesheet" href="/template/css/bootstrap.css">
    <style media="screen">
      h1{
        text-align: center;
      }
      .card{
        margin-top: 25px;
      }
      .alert-danger {
        margin-left: 15px;
        margin-top: 15px;
      }
    </style>
</head>
<body>
    <?php include ROOT.'/views/layout/header.php';?>
    <div class="container">
    <h1>Поиск по мероприятиям</h1>

    <div class="row">
      <div class="col-xl-12  col-lg-12 col-md-12 col-sm-12">
        <div class="card create">
          <div class="card-body">
            <form action="" method="post" class="needs-validation" onsubmit="return validation();" novalidate>
              <div class="form-group row">
                <label for="city" class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-form-label">Город</label>
                <div class="col-xl-10  col-lg-9 col-md-9 col-sm-12">
                  <input name= "city" id="city" type="text" class="form-control"
                   placeholder="Город" value = "<?php if (isset($searchCity)) echo $searchCity; ?>" >
                </div>
              </div>
              <div class="form-group row">
                <label for="city" class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-form-label">Тема</label>
                <div class="col-xl-10  col-lg-9 col-md-9 col-sm-12">
                  <input name= "interest" id="inter" type="text" class="form-control"
                   placeholder="Тема" value = "<?php if (isset($searchInterest)) echo $searchInterest; ?>" >
                </div>
              </div>
              <div class="form-group row ">
                <label for="date_from" class="col-xl-2 col-lg-3 col-md-3 col-sm-3  col-form-label">От: </label>
                <div class="col-xl-10  col-lg-9 col-md-9 col-sm-12">
                  <input name="date_from" id="from" type="date" class="form-control" value="<?php if (isset($searchFrom)) echo $searchFrom;?>">
                </div>
              </div>
              <div class="form-group row ">
                <label for="date_to" class="col-xl-2 col-lg-3 col-md-3 col-sm-3  col-form-label">До: </label>
                <div class="col-xl-10  col-lg-9 col-md-9 col-sm-12">
                  <input name="date_to" id="to" type="date"  class="form-control" value="<?php if (isset($searchTo)) echo $searchTo;?>">
                </div>
              </div>
              <div class="form-group ">
                <div>
                  <input type="submit" class="btn btn-success" name="searchBtn" value="Найти">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php if (isset($_POST['searchBtn'])): ?>
        <?php if (empty($filteredMeetings)): ?>
          <div class="alert alert-danger" role="alert">
            Мероприятия не найдены!
          </div>
        <?php endif; ?>
          <?php foreach ($filteredMeetings as $filtered): ?>
          <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="card" >
              <img class="card-img-top" src="<?php echo Meetings::getMeetImage($filtered['id']);?>" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><?php echo $filtered['title'] ?></h5>
                <p class="card-text"> <b>Дата: </b> <?php echo $filtered['date'] ?></p>
                <p class="card-text"> <b>Тема: </b><span class="badge badge-info"> <?php echo $filtered['name_interest'] ?> </span></p>
                <p class="card-text"><b>Город: </b><?php echo $filtered['city'] ?></p>
                <p class="card-text"> <b>Адрес: </b><?php echo $filtered['place'] ?></p>
                <a href="/meetings/<?php echo $filtered['id']?>" class="btn btn-outline-primary ">Подробнее</a>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
      <?php else: ?>
      <?php foreach ($meetingsList as $meetingItem): ?>
      <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
        <div class="card" >
          <img class="card-img-top" src="<?php echo Meetings::getMeetImage($meetingItem['id']);?>" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title"><?php echo $meetingItem['title'] ?></h5>
            <p class="card-text"> <b>Дата: </b> <?php echo $meetingItem['date'] ?></p>
            <p class="card-text"> <b>Тема: </b><span class="badge badge-info"> <?php echo $meetingItem['name_interest'] ?> </span></p>
            <p class="card-text"><b>Город: </b><?php echo $meetingItem['city'] ?></p>
            <p class="card-text"> <b>Адрес: </b><?php echo $meetingItem['place'] ?></p>
            <a href="/meetings/<?php echo $meetingItem['id']?>" class="btn btn-outline-primary ">Подробнее</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
    </div>
  </div>
  <?php include ROOT.'/views/layout/footer.php';?>
  <script>
  function validation(){
    var inpCity = document.getElementById('city');
    var inpInt = document.getElementById('inter');
    var inpFrom = document.getElementById('from');
    var inpTo = document.getElementById('to');
    if(!inpCity.value && !inpInt.value && !inpFrom.value && !inpTo.value){
      alert('Необходимо заполнить хотя бы одно поле!');
      return false;
    } else {
      return true;
    }
  }
  </script>
</body>
</html>
