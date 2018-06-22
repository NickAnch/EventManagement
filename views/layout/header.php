<?php
include_once ROOT. '/models/User.php';
?>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <a href="/" class="navbar-brand">Мероприятия</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarColor02">
      <div>
        <ul class="navbar-nav">
            <li class="nav-item"><a href="/" class="nav-link">Главная</a></li>
            <li class="nav-item"><a href="/meetings/" class="nav-link">Поиск</a></li>
            <li class="nav-item"><a href="/createMeeting/" class="nav-link">Создать мероприятие</a></li>
            <?php if ( !(User::isGuest()) ): ?>
            <li class="nav-item"><a href="/recommendation/" class="nav-link">Рекомендации</a></li>
            <?php endif; ?>
        </ul>
        </div>
        <div>
          <ul class="navbar-nav">
              <?php if (User::isGuest()): ?>
              <li class="nav-item"><a href="/user/register/" class="nav-link">Регистрация</a></li>
              <li class="nav-item"><a href="/user/login/" class="nav-link">Вход</a></li>
              <?php else: ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['name']; ?>
                    <?php if (User::getCountOfNotifications($_SESSION['user']) > 0 ):?>
                       <span class="badge badge-info"><?php echo User::getCountOfNotifications($_SESSION['user']);?></span>
                    <?php endif;?>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/profile/">Мой профиль</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/user/logout/">Выйти</a>
                  </div>
                </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>
