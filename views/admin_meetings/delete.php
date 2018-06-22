<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Админпанель</title>
    <link rel="stylesheet" href="/template/css/bootstrap.css">
    <style>
      .err{
        color: red;
      }
      .create{
        margin-top: 15px;
      }
    </style>
</head>
<body>
  <?php include ROOT.'/views/layout/headerAdmin.php';?>
  <div class="container" >
    <div class="row justify-content">
      <div class="col-xl-6  col-lg-6 col-md-8 col-sm-12">
        <a href="/admin/meetup">Вернуться к списку мероприятий</a>
        <div class="card create">
          <h1 class="card-header">Удаление мероприятия ID - <?php echo $id;?></h5>
          <div class="card-body">
            <form action="#" method="post" class="needs-validation" novalidate>
              <?php if(isset($error) && is_array($error)) : ?>
              <ul>
                <?php foreach ($error as $err): ?>
                <li><?php echo '<p class="err">'.$err. '</p>'; ?> </li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
              <div>Вы действительно хотите удалить мероприятие?</div>
              <div class="form-group">
                <div>
                  <br>
                  <button name="deleteMeetup" type="submit" class="btn btn-danger">Удалить</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include ROOT.'/views/layout/footer.php';?>
</body>
</html>
