<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $nama_guru = $_POST['nama_guru'];
    $nama_guru = strtoupper($nama_guru);
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $jabatan = $_POST['jabatan'];
    $no_telp = $_POST['no_telp'];
    $sql = "INSERT INTO guru (nama_guru,tempat_lahir,tanggal_lahir,jenis_kelamin,agama,alamat,jabatan,no_telp) VALUES('$nama_guru','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$agama','$alamat','$jabatan','$no_telp')";
    $result = $conn->query($sql);
    if($result){
      header("Location: ../guru.php");
      exit();
    }
  }
  

  $conn->close();
?>