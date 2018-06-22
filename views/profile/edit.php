<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Редактирование</title>
    <link rel="stylesheet" href="/template/css/bootstrap.css">
    <style>
      #cities{
        background-color: #DCDCDC;
      }
      .err{
        color: red;
      }
      .create{
        margin-top: 15px;
      }
    </style>
</head>
<body>
  <?php include ROOT.'/views/layout/header.php';?>
  <div class="container">
    <h1>Личный профиль</h1>
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link" href="/profile">Моя страница</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="/edit">Изменить информацию о себе</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/manageInterests">Редактировать интересы</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/eventNotifications">Оповещения
          <span class="badge badge-dark"><?php echo User::getCountOfNotifications($userId);?></span>
        </a>
      </li>
    </ul>
   <div class="row">
     <div class="col-xl-8  col-lg-10 col-md-12 col-sm-12">
       <div class="card create">
         <h1 class="card-header">Редактирование личных данных</h1>
          <div class="card-body">
            <?php if ($result): ?>
              <div class="alert alert-success" role="alert">Данные отредактированы!</div>
            <?php endif;?>
            <form enctype="multipart/form-data" action="" method="post" class="needs-validation"  novalidate>
              <div class="form-group row">
                <label for="name" class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-form-label">Имя</label>
                <div class="col-xl-10  col-lg-10 col-md-10 col-sm-12">
                  <input name="names" type="text" class="form-control" id="name" placeholder="Имя" value="<?php echo $name; ?>" autocomplete="off" required>
                  <div class="invalid-feedback">
                    Введите имя.
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="surname" class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-form-label">Фамилия</label>
                <div class="col-xl-10  col-lg-10 col-md-10 col-sm-12">
                  <input name="surname" type="text" class="form-control" id="surname" placeholder="Фамилия" value="<?php echo $surname; ?>" autocomplete="off" required>
                  <div class="invalid-feedback">
                    Введите фамилию
                  </div>
                </div>
              </div>

              <div class="form-group row ">
                <label for="city" class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-form-label">Город</label>
                <div class="col-xl-10  col-lg-10 col-md-10 col-sm-12">
                  <input name= "city" type="text" class="form-control" id="city" value="<?php echo $city; ?>" placeholder="Город" required>
                  <div class="invalid-feedback">
                    Введите город.
                  </div>
                  <small class="text-muted">
                    Город необходимо <b>выбрать</b> из списка.
                  </small>
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-form-label">Ваш город</label>
                <div class="col-xl-4 col-lg-4 col-md-5 col-sm-5">
                  <input name= "locality" type="text" class="form-control" id="cities" value="<?php echo $city; ?>" autocomplete="off" required>
                  <div class="invalid-feedback">
                    Для отправления данных, необходимо <b>ВЫБРАТЬ город</b> из списка в <b>поле "Город"</b>.
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-form-label">Фото</label>
                <div class="col-xl-10  col-lg-10 col-md-10 col-sm-12">
                  <img src="<?php echo User::getUserImage($userId)?>" width="200" alt="">
                  <input type="file" name="image" class="form-control" placeholder="" >
                </div>
              </div>
              <div class="form-group row">
                <label for="pass" class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-form-label">Пароль</label>
                <div class="col-xl-10  col-lg-10 col-md-10 col-sm-12">
                  <input name="pass" type="password" class="form-control" id="pass" value="<?php echo $password; ?>" placeholder="Пароль" pattern="[A-Za-zА-Яа-яЁё0-9]{6,}" required>
                  <div class="invalid-feedback">
                    Введите пароль, не менее 6 символов.
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-10">
                  <button name="doEdit" type="submit" class="btn btn-success">Сохранить</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include ROOT.'/views/layout/footer.php';?>
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAFnBJcgPWmhAtB6KIaEc63gZUz3i0jrZk&libraries=places"></script>
  <script src="/template/js/jquery.geocomplete.js"></script>
  <script>
    $("#city").geocomplete({
      details: ".needs-validation"
    });

    $("#cities").on('keydown paste', function(e){
      e.preventDefault();
  });
  </script>

  <script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {

            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>

</body>
</html>
