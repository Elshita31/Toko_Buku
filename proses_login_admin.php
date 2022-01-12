<?php

session_start();
//session start() digunakan sebagai tanda kalau kita akan menggunakan session pada halaman curl_ini
//session start() harus diletakkan pada baris pertama
include("config.php");
// kenapa?

//tampung data username dan Password
$username = $_POST["username"];
$password = $_POST["password"];
if (isset($_POST["login_admin"])) {
  $sql = "select * from admin where username = '$username' and password = '$password' ";
  //eksekusi query
  $query = mysqli_query($connect, $sql);
  $jumlah = mysqli_num_rows($query);
  // mysqli_num_rows($query) digunakan u/ menghtung jumlah data hasil dari $query

  if ($jumlah > 0) {
    // jika jumlahnya lebih dari nol, artinya dataa  sesuai dengan username dan passwor yg diinputkan
    // ini blok kode jika login berhasil
    // kita ubah hasil query ke
    $admin = mysqli_fetch_array($query);
    // membuat session
    $_SESSION["id_admin"] = $admin["id_admin"];
    $_SESSION["nama"] = $admin["nama"];

    header("location:buku.php");
  }else {
    // jika jumlahnya nol, artinya tidak ada dataa yang sesuai dengan username dan passwor yg diinputkan
    //ini blok kode jika login gagal
    header("location:login_admin.php");
  }
}

if (isset($_GET["logout"])) {
  // proses logout
  // menghapus data session yg tlah dibuat
  session_destroy();
  header("location:login_admin.php");
}

 ?>
