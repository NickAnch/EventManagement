<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Регистрация</title>
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
      .form-check{
        margin-bottom: 15px;
      }
    </style>
</head>
<body>
  <?php include ROOT.'/views/layout/header.php';?>
  <div class="container">
   <div class="row justify-content-center">
     <div class="col-xl-8  col-lg-10 col-md-12 col-sm-12">
       <div class="card create">
         <h1 class="card-header">Регистрация</h1>
          <div class="card-body">
            <?php if ($result): ?>
            <p>Вы зарегистрированы!</p>
            <?php else: ?>
            <?php if(isset($error) && is_array($error)) : ?>
              <ul>
                <?php foreach ($error as $err): ?>
                <li><?php echo '<p class="err">'.$err. '</p>'; ?> </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <form action="" method="post" class="needs-validation" novalidate>
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
              <div class="form-group row">
                <label for="email" class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-form-label">Email</label>
                <div class="col-xl-10  col-lg-10 col-md-10 col-sm-12">
                  <input name= "email" type="email" class="form-control" id="email" placeholder="Email" autocomplete="off" required>
                  <div class="invalid-feedback">
                    Введите email
                  </div>
                </div>
              </div>
              <div class="form-group row ">
                <label for="city" class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-form-label">Город</label>
                <div class="col-xl-10  col-lg-10 col-md-10 col-sm-12">
                  <input name= "city" type="text" class="form-control" id="city" placeholder="Город" required>
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
                  <input name= "locality" type="text" class="form-control" id="cities" autocomplete="off" required>
                  <div class="invalid-feedback">
                    Для отправления данных, необходимо <b>ВЫБРАТЬ город</b> из списка в <b>поле "Город"</b>.
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="pass" class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-form-label">Пароль</label>
                <div class="col-xl-10  col-lg-10 col-md-10 col-sm-12">
                  <input name="pass" type="password" class="form-control" id="pass" placeholder="Пароль" pattern="[A-Za-zА-Яа-яЁё0-9]{6,}" required>
                  <div class="invalid-feedback">
                    Введите пароль, не менее 6 символов.
                  </div>
                </div>
              </div>
              <div class="form-check ">
                <input name= "agreement" type="checkbox" class="form-check-input" required>
                <label class="form-check-label" >Я согласен на обработку персональных данных</label>
                <div class="invalid-feedback">
                  Необходимо подтвердить соглашение.
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-10">
                  <button name="doRegistr" type="submit" class="btn btn-success">Регистрировать</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
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
