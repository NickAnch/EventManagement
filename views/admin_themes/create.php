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
        <a href="/admin/theme">Вернуться к списку тем</a>
        <div class="card create">
          <h1 class="card-header">Добавление темы</h5>
          <div class="card-body">
            <?php if ($result): ?>
              <div class="alert alert-success" role="alert">Тема добавлена!</div>
            <?php endif;?>
            <form action="" method="post" class="needs-validation" novalidate>
              <?php if(isset($error) && is_array($error)) : ?>
              <ul>
                <?php foreach ($error as $err): ?>
                <li><?php echo '<p class="err">'.$err. '</p>'; ?> </li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
              <div class="form-group row">
                <label for="email" class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-form-label">Тема</label>
                <div class="col-xl-10  col-lg-9 col-md-9 col-sm-12">
                  <input name= "theme" type="text" class="form-control" placeholder="Тема" required>
                  <div class="invalid-feedback">
                    Введите тему.
                  </div>
                </div>
              </div>
              <div class="form-group ">
                <div>
                  <button type="submit" name="addTheme" class="btn btn-success" >Сохранить</button>
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
<script>
  (function() {
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      //var inpField = $('#cities').val();
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
</html>
