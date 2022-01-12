<?php
session_start();
if (!isset($_SESSION["id_admin"])) {
header("location:login_admin.php");
}
include("config.php");
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Daftar Buku</title>
     <link rel="stylesheet" href="css_customer.css">
     <link rel="stylesheet" href="assets/css/bootstrap.css">
     <script src="assets/js/jquery.min.js"></script>
     <script src="assets/js/popper.min.js"></script>
     <script src="assets/js/bootstrap.js"></script>
     <script type="text/javascript">
     Add = () =>{
       document.getElementById('action').value = "insert";
       document.getElementById('kode_buku').value = "";
       document.getElementById('judul').value = "";
       document.getElementById('penulis').value = "";
       document.getElementById('stok').value = "";
       document.getElementById('tahun').value = "";
       document.getElementById('harga').value = "";
     }
     Edit = (item) =>{
       document.getElementById('action').value = "update";
       document.getElementById('kode_buku').value = item.kode_buku;
       document.getElementById('judul').value = item.judul;
       document.getElementById('penulis').value = item.penulis;
       document.getElementById('stok').value = item.stok;
       document.getElementById('tahun').value = item.tahun;
       document.getElementById('harga').value = item.harga;
     }
       Detail = (item) =>{
         document.getElementById('kode_buku').value = item.kode_buku;
         document.getElementById('judul').innerHTML = "Judul: " + item.judul;
         document.getElementById('penulis').innerHTML = "penulis: " + item.penulis;
         document.getElementById('harga').innerHTML = "Harga:Rp. " + item.harga;
         document.getElementById('stok').innerHTML = "Stok: " + item.stok;
         document.getElementById('jumlah_beli').value = "1";

         document.getElementById("image").src = "image/" + item.image;
       }

       window.onscroll = function() {scrollFunction()};

       function scrollFunction() {
         if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
           document.getElementById("navbar").style.padding = "30px 10px";
           document.getElementById("logo").style.fontSize = "25px";
         } else {
           document.getElementById("navbar").style.padding = "80px 10px";
           document.getElementById("logo").style.fontSize = "35px";
         }
       }
     </script>
   </head>
   <body>
     <!-- navigasi  -->
     <div id="navbar">
       <a href="#default" id="logo">Web Book Store</a>
       <div id="navbar-right">
         <a class="active" href="#home">Home</a>
         <a href="transaksi_admin.php">Transaksi</a>
         <a href="list_customer1.php">List Customer</a>
         <a href="list_admin1.php">List Admin</a>
         <a href="login_admin.php">Logout</a>
       </div>
     </div>
     <!-- end navigasi -->

     <div style="margin-top:250px">
       <!-- proses cari -->
       <?php
       if (isset($_POST["cari"])) {
         $cari = $_POST["cari"];
         // sql untuk pencarian
         $sql = "select * from buku where judul like'%$cari%'
         or penulis like '%$cari%'";

       }else {
         // sql untuk tampilan default
         $sql = "select * from buku";
       }
       // eksekusi perintah sql
       $query = mysqli_query($connect, $sql);
        ?>

        <!-- isi table start -->

        <div class="container">
          <!-- start card -->
          <div class="card">
            <div class="card-body">
              <h4>DATA BUKU</h4>
              <br>
              <form action="buku.php" method="post">
                <input type="text" name="cari" class="form-control" placeholder="Pencarian...">
              </form>
              <br>
              <br>
              <table class="table" border="1">
                <thead>
                  <tr>
                    <th>Kode Buku</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Stok</th>
                    <th>Tahun</th>
                    <th>Harga</th>
                    <th>Foto</th>
                    <th>option</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($query as $key => $buku): ?>
                    <tr>
                      <td><?php echo $buku["kode_buku"] ?></td>
                      <td><?php echo $buku["judul"] ?></td>
                      <td><?php echo $buku["penulis"] ?></td>
                      <td><?php echo $buku["stok"] ?></td>
                      <td><?php echo $buku["tahun"] ?></td>
                      <td><?php echo "Rp.".$buku["harga"] ?></td>
                      <td>
                        <img src="<?php echo 'image/'.$buku['image']; ?>" alt="Foto Buku" width="200" />
                      </td>
                      <td>
                        <button data-toggle="modal" data-target="#modal_buku" type="button" name="button" class="btn btn-block btn-sm btn-info"
                        onclick='Edit(<?php echo json_encode($buku); ?>)'>
                          Edit
                        </button>
                        <br>
                        <a href="proses_crud_buku.php?hapus=true&kode_buku=<?php echo $buku["kode_buku"];?>"
                          onclick="return confirm('Apakah anda yakin menghapus data ini?')">
                          <button type="button"  class="btn btn-block btn-sm btn-danger">
                            Hapus
                          </button>
                        </a>
                      </td>
                    </tr>

                  <?php endforeach; ?>
                </tbody>
              </table>
              <button data-toggle="modal" data-target="#modal_buku"
              type="button" class="btn btn-sm btn-primary" onclick="Add()">
                Tambah Data
              </button>
            </div>
          </div>
          <!--  end card -->

          <!-- form modal -->
          <div class="modal fade" id="modal_buku">
            <div class="modal-dialog">
              <div class="modal-content">
                <form  action="proses_crud_buku.php" method="post" enctype="multipart/form-data">
                  <div class="modal-header bg-dark text-white text-center">
                    <h4>Form Buku</h4>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="action" id="action">
                    Kode Buku
                    <input type="text" name="kode_buku" id="kode_buku" class="form-control" required/>
                    Judul
                    <input type="text" name="judul" id="judul" class="form-control" required/>
                    Penulis
                    <input type="text" name="penulis" id="penulis" class="form-control" required/>
                    Tahun
                    <input type="text"  name="tahun" id="tahun" class="form-control" required/>
                    Stok
                    <input type="text"  name="stok" id="stok" class="form-control" required/>
                    Harga
                    <input type="text"  name="harga" id="harga" class="form-control" required/>
                    <br>
                    Foto
                    <input type="file" name="image" id="image" class="form-control"/>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="save_buku" >
                      Simpan
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- end form modal -->
        </div>
        <!-- isi table end -->

     </div>
   </body>
 </html>
