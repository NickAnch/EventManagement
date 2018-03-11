<?php
include_once ROOT. '/models/User.php';
?>

<header>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
          <a href="#" class="navbar-brand">Мероприятия</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="/" class="nav-link">Главная</a></li>
                <li class="nav-item"><a href="/meetings/" class="nav-link">Мероприятия</a></li>
                <li class="nav-item"><a href="/createMeeting/" class="nav-link">Создать встречу</a></li>
                <?php if (User::isGuest()): ?>
                <li class="nav-item"><a href="/user/register/" class="nav-link">Регистрация</a></li>
                <li class="nav-item"><a href="/user/login/" class="nav-link">Вход</a></li>
                <?php else: ?>
                <li class="nav-item"><a href="/recommendation/" class="nav-link">Рекомендации</a></li>
                <li class="nav-item"><a href="/profile/" class="nav-link">Профиль</a></li>
                <li class="nav-item"><a href="/user/logout/" class="nav-link">Выход</a></li>
              <?php endif; ?>
            </ul>
          </div>
        </nav>

</header>
