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
     <script type="text/javascript">
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
         <a href="buku.php">Home</a>
         <a class="active" href="transaksi.php">Transaksi</a>
         <a href="list_customer1.php">List Customer</a>
         <a href="list_admin1.php">List Admin</a>
         <a href="login_admin.php">Logout</a>
       </div>
     </div>

     <!-- end navigasi -->

     <!-- body -->
      <div class="container" style="margin-top:300">
        <div class="card mt-3">
          <div class="card-header bg-dark">
            <h4 class="text-white">Riwayat Transaksi</h4>
          </div>
          <div class="card-body">
            <?php
            $sql = "select * from transaksi t inner join customer c
            on t.id_customer = c.id_customer
            where t.id_customer = '".$_SESSION["id_customer"]."' order by t.tgl desc";
            $query = mysqli_query($connect, $sql);

             ?>

             <ul class="list-group">
               <?php foreach ($query as $transaksi): ?>
                 <li class="list-group-item mb-4">
                 <h6>ID Transaksi: <?php echo $transaksi["id_transaksi"]; ?></h6>
                 <h6>Nama Pembeli: <?php echo $transaksi["nama"]; ?></h6>
                 <h6>Tgl. Transaksi: <?php echo $transaksi["tgl"]; ?></h6>
                 <h6>List Barang: </h6>

                 <?php
                 $sql2 = "select * from detail_transaksi d inner join buku b
                 on d.kode_buku = b.kode_buku
                 where d.id_transaksi = '".$transaksi["id_transaksi"]."'";
                 $query2 = mysqli_query($connect,$sql2);
                  ?>

                  <table class="table" border="2">
                    <thead>
                      <tr>
                        <th>Judul</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $total = 0; foreach ($query2 as $detail): ?>
                        <tr>
                          <td><?php echo $detail["judul"]; ?></td>
                          <td><?php echo $detail["jumlah"]; ?></td>
                          <td><?php echo number_format($detail["harga_beli"]); ?></td>
                          <td>
                            Rp <?php echo number_format($detail["harga_beli"]*$detail["jumlah"]); ?>

                          </td>
                        </tr>
                      <?php
                      $total += ($detail["harga_beli"]*$detail["jumlah"]);
                      endforeach;
                      ?>
                    </tbody>
                  </table>
                  <h6 class="text-danger">Rp <?php echo number_format($total); ?></h6>
                </li>
               <?php endforeach; ?>
             </ul>

          </div>
        </div>
      </div>
     <!-- body -->

     <!-- footer -->
    <div style="margin-top:10px">
      <div class="footer bg-dark text-light text-center" style="height: 40px">
        <footer>
         <p style="text-align: center">&copy; 2020 Elshita</p>
        </footer>
      </div>
    </div>
     <!-- FOOTER END -->
   </body>
 </html>
