<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php if(isset($_SESSION['login-error'])):?>
    <span style="color: red;"><?= $_SESSION['login-error']; unset($_SESSION['login-error'])?></span>
  <?php endif?>
  <form action="./controllers/login.php" method="POST">
    <label for="username">Username</label>
    <input type="text" autofocus value="<?= $_SESSION['login-data']['username'] ?? null; unset($_SESSION['login-data']['username'])?>" name="username">
    <label for="password">Password</label>
    <input type="password" value="<?= $_SESSION['login-data']['password'] ?? null; unset($_SESSION['login-data']['password'])?>" name="password">
    <button type="submit" name="submit">Log In</button>
  </form>
</body>
</html>