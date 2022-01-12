<?php
//koneksi ke database
$host = "localhost"; //server
$username = "root";
$password = "";
$db = "toko_buku";
$connect = mysqli_connect($host,$username,$password,$db);

//cek koneksi database
if (mysqli_connect_errno()) {
  echo mysqli_connect_error();
}else {
  echo "koneksi Berhasil";
}
 ?>
