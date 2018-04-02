<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Вход</title>
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
<body >
    <?php include ROOT.'/views/layout/header.php';?>
    <div class="container" >
      <div class="row justify-content-center">
        <div class="col-xl-6  col-lg-6 col-md-8 col-sm-12">
          <div class="card create">
            <h1 class="card-header">Авторизация</h5>
            <div class="card-body">
              <form action="#" method="post" class="needs-validation" novalidate>
                <?php if(isset($error) && is_array($error)) : ?>
                <ul>
                  <?php foreach ($error as $err): ?>
                  <li><?php echo '<p class="err">'.$err. '</p>'; ?> </li>
                  <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <div class="form-group row">
                  <label for="email" class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-form-label">Email</label>
                  <div class="col-xl-10  col-lg-9 col-md-9 col-sm-12">
                    <input name= "email" type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $email; ?>" required>
                    <div class="invalid-feedback">
                      Введите email
                    </div>
                  </div>
                </div>
                <div class="form-group row ">
                  <label for="pass" class="col-xl-2 col-lg-3 col-md-3 col-sm-3  col-form-label">Пароль</label>
                  <div class="col-xl-10  col-lg-9 col-md-9 col-sm-12">
                    <input name="pass" type="password" class="form-control" id="pass" placeholder="Пароль" pattern="[A-Za-zА-Яа-яЁё0-9]{6,}" required>
                    <div class="invalid-feedback">
                      Введите пароль, не менее 6 символов.
                    </div>
                  </div>
                </div>
                <div class="form-group ">
                  <div>
                    <button name="doLogin" type="submit" class="btn btn-success">Войти</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include ROOT.'/views/layout/footer.php';?>
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
