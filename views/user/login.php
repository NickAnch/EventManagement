<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>
    <?php include ROOT.'/views/layout/header.php';?>
    <h1>Авторизация</h1>
    <form action="#" method="post">
        <input type="email" name= "email" placeholder="Email" ><br>
        <input type="password" name="pass" placeholder="Пароль"><br>
        <a href="/user/register">Регитрация</a>
        <button type="submit" class="btn" name="doLogin">Вход</button>
   </form>
</body>
</html>
