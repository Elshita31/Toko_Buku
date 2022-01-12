<?php
include("config.php");
if (isset($_POST["save_customer"])) {

  $action = $_POST["action"];
  $nama = $_POST["nama"];
  $alamat = $_POST["alamat"];
  $kontak = $_POST["kontak"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  if ($action == "insert") {
    $sql = "insert into siswa values('$nama', '$alamat', '$kontak', '$username', '$password')";

    mysqli_query($connect, $sql);

    header("location:tampilan_customer.php");
  }
}
?>
