<?php
session_start();
include("config.php");

if(isset($_POST["add_to_cart"])){
  // tampung kode_buku dan jumlah_beli
  $kode_buku = $_POST["kode_buku"];
  $jumlah_beli = $_POST["jumlah_beli"];

  // kita ambil data buku dari database
  $sql ="select * from buku where kode_buku='$kode_buku'";
  $query = mysqli_query($connect, $sql);
  $buku = mysqli_fetch_array($query);

  $item = [
    "kode_buku" => $buku["kode_buku"],
    "judul" => $buku["judul"],
    "image" => $buku["image"],
    "harga" => $buku["harga"],
    "jumlah_beli" => $jumlah_beli
  ];

  //masukkan item ke keranjang(cart)
  array_push($_SESSION["cart"], $item);

  header("location:tampilan_customer.php");

}

// menghapus item pada cart
if (isset($_GET["hapus"])) {
  // tampung data pada kode_buku yg dihapus
  $kode_buku = $_GET["kode_buku"];

  // cari index Cart
  $index = array_search(
    $kode_buku, array_column(
      $_SESSION["cart"], "kode_buku"
      )
    );

    // hapus item pada Cart
    array_splice($_SESSION["cart"], $index, 1);
    header("location:cart.php");
}

// checkout
if ($_GET["checkout"]) {
  // memasukkan data pada cart ke database
  //(tabel transaksi dan detail transaksi)
  $id_transaksi = "ID".rand(1,10000);//untuk merandom angka 1-10000
  $tgl = date("Y-m-d H:i:s"); //untuk mengatur waktu saat ini (current time)
  $id_customer = $_SESSION["id_customer"];

  // buat query
  $sql = "insert into transaksi values ('$id_transaksi','$tgl','$id_customer')";
  mysqli_query($connect, $sql);

// menggunakan foreach karena barang yang dicheckout tidak hanya satu
  foreach ($_SESSION["cart"] as $cart) {
    $kode_buku = $cart["kode_buku"];
    $jumlah = $cart["jumlah_beli"];
    $harga = $cart["harga"];

    //buat queri ke table detail
    $sql = "insert into detail_transaksi values('$id_transaksi','$kode_buku','$jumlah',$harga)";
    mysqli_query($connect, $sql);

    $sql2 = "update buku set stok = stok - $jumlah where kode_buku='$kode_buku'";
    //untuk mengupdate stok buku,
    //stok buku akan berkurang jika ada yang membeli
    mysqli_query($connect, $sql2);
  }
  //kosongkan cartnya
  $_SESSION["cart"]=array();
  header("location:transaksi.php");
}
 ?>
