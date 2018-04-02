<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Создание мероприятия</title>
  <link rel="stylesheet" href="/template/css/bootstrap.css">
  <style>
    #map{
      width: 100%;
      height: 425px;
    }
    .create{
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <?php include ROOT.'/views/layout/header.php';?>
  <div class="container ">
    <div class="row justify-content-center">
      <div class="col-xl-8  col-lg-10 col-md-12 col-sm-12">
        <div class="card create">
          <h1 class="card-header">Создание мероприятия</h1>
          <div class="card-body">
            <form action="#" method="post" class="mapDetail needs-validation" novalidate>
              <?php if (User::isGuest()): ?>
                <p>Для того, чтобы создать мероприятие, вам необходимо войти в систему</p>
                <a href="/user/register/">Регистрация</a><br>
                <a href="/user/login/">Вход</a>
              <?php else: ?>
                <div class="form-group row">
                  <label class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-form-label">Название</label>
                  <div class="col-xl-10  col-lg-10 col-md-10 col-sm-12">
                    <input name= "title" type="text" class="form-control" placeholder="Название" required>
                    <div class="invalid-feedback">
                      Введите название.
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-form-label">Тема</label>
                  <div class="col-xl-10  col-lg-10 col-md-10 col-sm-12">
                    <?php
                      echo '<select id = "myselect" name="inter" class="form-control" required>';
                      echo '<option value="">Выберите тему</option>';
                        foreach ($interestsList as $value) {
                          echo '<option value='. $value['id'] .'>'. $value['name_interest'].'</option>';
                        }
                      echo '</select>';
                    ?>
                    <div class="invalid-feedback">
                      Выберите тему.
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-form-label">Дата</label>
                  <div class="col-xl-10  col-lg-10 col-md-10 col-sm-12" >
                    <input name="date" type='datetime-local' class="form-control" id='datetimepicker' required>
                    <div class="invalid-feedback">
                      Задайте дату проведения.
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-form-label">Место</label>
                  <div class="col-xl-10  col-lg-10 col-md-10 col-sm-12">
                    <input type="text" class="form-control" placeholder="Полное место проведения" id="inputmap" required>
                    <div class="invalid-feedback">
                      Введите полное место проведения, затем выберите его из списка.
                    </div>
                    <small class="text-muted">
                      Адрес необходимо <b>выбрать</b> из списка.
                    </small>
                  </div>
                </div>
                <div class="form-group">
                  <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModalCenter" id="showMap" style="display: none;" >
                    Посмотреть на карте
                  </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Карта</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div id="map"></div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                <label class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-form-label">Описание</label>
                <div class="col-xl-10  col-lg-10 col-md-10 col-sm-12">
                <textarea name="description" class="form-control" rows="5" required></textarea>
                  <div class="invalid-feedback">
                    Опишите ваше мероприятие.
                  </div>
                </div>
              </div>
              <div class="form-check ">
                <input name= "closeMeetup" type="checkbox" class="form-check-input">
                <label class="form-check-label" >Скрытое мероприятие</label>
              </div>
              <input type="text" name="locality" placeholder="Город" value="" style="display: none;" >
              <input type="text" name="formatted_address" placeholder="Адрес" id="address" value="" style="display: none;">
              <input name="lat" type="text" value=""  style="display: none;">
              <input name="lng" type="text" value=""  style="display: none;"><br>
              <div class="form-group">
                <button type="submit" class="btn btn-success" name="createMeeting">Создать</button>
              </div>
              <?php endif; ?>
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

   $("#inputmap").geocomplete({
     map: "#map",
     details: ".mapDetail"
   });

     $( "#inputmap" ).blur(function() {
      if($( "#inputmap" ).val() != ''){
        $("#showMap").show();
      } else {
          $("#showMap").hide();
      }
    });

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
</body>
</html>
