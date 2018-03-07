<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
    <?php include ROOT.'/views/layout/header.php';?>
    <h1>Регитрация на сайте</h1>
    <?php if ($result): ?>
        <p>Вы зарегистрированы!</p>
    <?php else: ?>
    <?php if(isset($error) && is_array($error)) : ?>
      <ul>
        <?php foreach ($error as $err): ?>
          <li><?php echo $err; ?> </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <form action="#" method="post">
        <input type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>"><br>
        <input type="text" name="surname" placeholder="Фамилия" value="<?php echo $surname; ?>"><br>
        <input type="email" name= "email" placeholder="Email" value="<?php echo $email; ?>"><br>
        <input type="text" name= "city" placeholder="Город" value="<?php echo $city; ?>"><br>

        <input type="password" name="pass" placeholder="Пароль"><br>
        <a href="/user/login">Авторизация</a>
        <button type="submit" class="btn" name="doRegistr">Регистрировать</button>
   </form>
   <?php endif; ?>
</body>
</html>
