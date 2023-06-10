<?php
  require './db.php';

  $conn = OpenCon();
  session_start();

  $user;

  if(isset($_SESSION['user-id'])){
    $id = $_SESSION['user-id'];
    $query = "SELECT * FROM user WHERE id='$id'";
    $result = $conn->query($query);
    $user = mysqli_fetch_assoc($result);
  }
  

  $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="./assets/datatables.css">
  <link rel="stylesheet" href="./src/style.css">
  <script src='./src/index.js'></script>
  <script src='./assets/jquery-3.7.0.min.js'></script>
  <script src='./bootstrap/js/bootstrap.js'></script>
  <script src='./assets/datatables.js'></script>
  <title>Document</title>
</head>
<body>
  <div class="full-width">
    <div class="sidebar">
      <div class="sidebar-wraper">
        <img src="src/images/iconmonstr-x-mark-lined-240.png" alt="close" id='close'/>
        <a href="dashboard.php">Dashboard</a>
        <a href="kelas.php">Kelas</a>
        <?php if(isset($_SESSION['user-id'])):?>
          <a href="controllers/logout.php">Log Out</a>
        <?php endif?>
      </div>
    </div>
    <div class="full-width wraper">
      <div class="header">
        <div>
          <img src='src/images/iconmonstr-menu-left-lined-240.png' alt='menu' id='menu'/>
        </div>
        <?php if(isset($_SESSION['user-id'])):?>
        <a href='user.php' class='avatar-container'>
          <div class='avatar'>
            <img src="src/images/iconmonstr-user-19-240.png" alt="user"/>
          </div>
          <span><?= $user['nama']?></span>
        </a>
      <?php else:?>
        <a class='btn btn-light' href="login.php">Login</a>
      <?php endif ?>
      </div>
      <div class='main bg-body'>
        