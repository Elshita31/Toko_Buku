<?php
session_start();
if (!isset($_SESSION["id_customer"])) {
header("location:login_customer.php");
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
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <script type="text/javascript">
       Detail = (item) =>{
         document.getElementById('kode_buku').value = item.kode_buku;
         document.getElementById('judul').innerHTML = "Judul: " + item.judul;
         document.getElementById('penulis').innerHTML = "penulis: " + item.penulis;
         document.getElementById('harga').innerHTML = "Harga:Rp. " + item.harga;
         document.getElementById('stok').innerHTML = "Stok: " + item.stok;
         document.getElementById('jumlah_beli').value = "1";
         document.getElementById("jumlah_beli").max = item.stok; //ini untuk membatasi pembelian sesuai Stok


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
         <a href="cart.php" class="nav-link">
           Cart(<?php echo count($_SESSION["cart"]); ?>)
         </a>
         <a href="#" class="nav-link dropdown-toggle" id="contact" data-toggle="dropdown">Contact</a>
         <div class="dropdown-menu">
           <a href="https://web.facebook.com/elshita.elshita.54" class="dropdown-item">Facebook</a>
           <a href="https://www.instagram.com/els.elshita/" class="dropdown-item">Instagram</a>
         </div>
         <a href="login_customer.php?Logout=true">Logout</a>
       </div>
       <br>
       <br>
       <br>
     </div>
     <!-- end navigasi -->

     <!-- content -->
     <div class="container" style="margin-top:250px">
       <div class="row">
         <!-- slide start -->
         <div class="col-sm-12">
           <div class="carousel slide" data-ride="carousel" id="slide">
               <!-- indikator slide -->
               <ul class="carousel-indicators">
                   <li data-target="#slide" data-slide-to="0" class="active"></li>
                   <!-- class active berarti elemen tersebut yang pertama kali ditampilkan saat load halaman -->
                   <li data-target="#slide" data-slide-to="1" class="active"></li>
                   <li data-target="#slide" data-slide-to="2" class="active"></li>
               </ul>
               <!-- gambar slide -->
               <div class="carousel-inner">
                   <div class="carousel-item active" width="80%" height="500" alt="">
                       <img src="foto/1.jpg" width="100%" height="500" alt="">
                   </div>
                   <div class="carousel-item" width="80%" height="400" alt="">
                           <img src="foto/2.jpg" width="100%" height="500" alt="">
                   </div>
                   <div class="carousel-item" width="80%" height="300" alt="">
                           <img src="foto/3.jpg" width="100%" height="500" alt="">
                   </div>
               </div>

               <!-- navigasi slide -->
               <a href="#slide" data-slide="prev" class="carousel-control-prev">
                   <span class="carousel-control-prev-icon"></span>
               </a>
               <a href="#slide" data-slide="next" class="carousel-control-next">
                   <span class="carousel-control-next-icon"></span>
               </a>
           </div>
         </div>
         <!-- slide end -->
       </div>
     </div>
     <!-- content -->



     <div class="container" style="margin-top:40px">
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

        <div class="search-container">
          <form action="tampilan_customer.php" method="post">
            <input type="text" name="cari" class="form-control" placeholder="Pencarian. . . . .">
          </form>
        </div>

        <h2>DAFTAR BUKU</h2>
        <div class="row">
          <?php foreach ($query as $buku): ?>
            <div class="card col-2" align="center"  style="margin-top:20px">
              <div class="body">
                <img src="image/<?php echo $buku["image"];?>" width="150" height="200">
                <!-- jika diclick muncul pop up -->
                <h5 class="text-dark center" onclick='Detail(<?php echo json_encode($buku); ?>)'
                data-toggle="modal" data-target="#modal_detail">
                <a href="#"><?php echo $buku["judul"]; ?></a>
                </h5>
                <!-- jika diclick muncul pop up -->
                <h6 class="text-secondary center"><?php echo $buku["penulis"]; ?></h6>
                <h6 class="text-secondary center"><?php echo "Rp.".$buku["harga"]; ?></h6>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="modal" id="modal_detail">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-dark">
                <h4 class="text-white">Detail Buku</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-6">
                    <!-- untuk gambar -->
                    <img id="image" alt="test" style="width: 100%; height: auto" >
                  </div>
                  <div class="col-6">
                    <!-- untuk deskripsi -->

                    <h5 id="judul"></h5>
                    <h6 id="penulis"></h6>
                    <h6 id="harga"></h6>
                    <h6 id="stok"></h6>
                    <h6 id="image"></h6>

                    <form  action="proses_cart.php" method="post">
                      <input type="hidden" name="kode_buku" id="kode_buku">
                      Jumlah Beli
                      <input type="number" name="jumlah_beli" id="jumlah_beli"
                      class="form-control" min="1">
                      <br>
                      <button type="submit" name="add_to_cart" class="btn btn-block btn-dark">
                        Masukkan keranjang
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
     </div>
     <!-- footer -->
     <div style="margin-top:10px">
       <div class="footer bg-dark text-light text-center" height="50px" style="height:50px">
         <footer>
          <p style="text-align: center">&copy; 2020 Elshita</p>
         </footer>
       </div>
     </div>
     <!-- FOOTER END -->
   </body>
 </html>
