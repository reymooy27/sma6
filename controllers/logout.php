<?php
  session_start();
  unset($_SESSION["user-id"]);
  if($_SESSION['is-admin'] > 0){
    unset($_SESSION['is-admin']);
    header('Location: ../dashboard.php');
    exit();
  }else{
    header('Location: ../index.php');
    exit();
  }
?>