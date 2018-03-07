<?php
include_once ROOT. '/models/User.php';
?>

<header>
    <div class="container">
        <nav>
            <ul class="nav">
                <li><a href="/">Главная</a></li>
                <li><a href="/meetings/">Мероприятия</a></li>
                <li><a href="/createMeeting/">Создать встречу</a></li>
                <?php if (User::isGuest()): ?>
                <li><a href="/user/register/">Регистрация</a></li>
                <li><a href="/user/login/">Вход</a></li>
                <?php else: ?>
                <li><a href="/profile/">Профиль</a></li>
                <li><a href="/user/logout/">Выход</a></li>
              <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
