<?php
include("config.php");
if (isset($_POST["save_buku"])) {

$action = $_POST["action"];
$kode_buku = $_POST["kode_buku"];
$judul = $_POST["judul"];
$penulis = $_POST["penulis"];
$tahun = $_POST["tahun"];
$harga = $_POST["harga"];
$stok = $_POST["stok"];

//menampung file images
if(!empty($_FILES["image"]["name"])){
  //mendapatkan deskripsi info gambar
  $path = pathinfo($_FILES["image"] ["name"]);
  // mengambil ekstensi gambar
  $extension = $path["extension"];

  //rangkai file named
  $filename = $kode_buku."-".rand(1,1000).".".$extension;
  // generate nama file
  // exp 111-989.jpg
  // rand() untuk random nilai 1-1000
}

// proses insert dan update
if ($action == "insert") {
  $sql = "insert into buku values('$kode_buku', '$judul', '$penulis',
  '$tahun', '$harga', '$stok', '$filename')";

  // proses upload file
  move_uploaded_file($_FILES["image"]["tmp_name"],"image/$filename");
  // eksekusi perintah sql
  mysqli_query($connect, $sql);

}elseif ($action == "update") {
  if(!empty($_FILES["image"]["name"])){
    //mendapatkan deskripsi info gambar
    $path = pathinfo($_FILES["image"] ["name"]);
    // mengambil ekstensi gambar
    $extension = $path["extension"];

    //rangkai file named
    $filename = $kode_buku."-".rand(1,1000).".".$extension;
    // generate nama file
    // exp 111-989.jpg
    // rand() untuk random nilai 1-1000

    // ambil data yang akan diedit
    $sql = "select * from buku where kode_buku = '$kode_buku'";
    $query = mysqli_query($connect,$sql);
    $hasil = mysqli_fetch_array($query);

    if (file_exists("image/".$hasil["image"])) {
    unlink("image/".$hasil["image"]);
    //menghapus gambar yang terdahulu
    }
    //upload digambarkan
    move_uploaded_file($_FILES["image"] ["tmp_name"], "image/$filename");
    // sintak update
    $sql = "update buku set judul = '$judul', penulis = '$penulis', tahun = '$tahun',
    harga = '$harga', 'stok = '$stok', image = '$filename' where kode_buku = '$kode_buku' ";
  }
}else {
    // sintak update
    $sql = "update buku set judul = '$judul', penulis = '$penulis', tahun = '$tahun',
    harga = '$harga', 'stok = '$stok', image = '$filename' where kode_buku = '$kode_buku'";
}
// proses insert dan update
// eksekusi perintah sql
mysqli_query($connect, $sql);
// echo "$sql";
// redirect ke halaman siswa.php
header("location:buku.php");
}

if (isset($_GET["hapus"])) {
  include("config.php");
  $kode_buku = $_GET["kode_buku"];
  $sql = "select * from buku where kode_buku = '$kode_buku' ";
  $query = mysqli_query($connect, $sql);
  $hasil = mysqli_fetch_array($query);
  if (file_exists("image/".$hasil["image"])) {
    unlink("image/".$hasil["image"]);
  }
  $sql = "delete from buku where kode_buku = '$kode_buku' ";

  mysqli_query($connect, $sql);

  //direct ke halaman SISWA
  header("location:buku.php");
}

 ?>
