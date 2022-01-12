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
         <a href="tampilan_customer.php">Home</a>
         <a href="cart.php" class="nav-link active">
           Cart(<?php echo count($_SESSION["cart"]); ?>)
         </a>
         <a href="#" class="nav-link dropdown-toggle" id="contact" data-toggle="dropdown">Contact</a>
         <div class="dropdown-menu">
           <a href="https://web.facebook.com/elshita.elshita.54" class="dropdown-item">Facebook</a>
           <a href="https://www.instagram.com/els.elshita/" class="dropdown-item">Instagram</a>
           <a href="#" class="dropdown-item">Twitter</a>
         </div>
         <a href="login_customer.php?Logout=true">Logout</a>
       </div>
       <br>
       <br>
       <br>
     </div>
     <!-- end navigasi -->

     <div class="container" style="margin-top:300px">
       <div class="card">
         <div class="card-header bg-light">
           <h3>Keranjang Belanja Anda</h3>
         </div>
         <div class="card-body">
           <table class="table">
             <thead>
               <tr>
                 <th>No</th>
                 <th>Judul</th>
                 <th>Harga</th>
                 <th>Jumlah</th>
                 <th>Total</th>
                 <th>Option</th>
               </tr>
             </thead>
             <br>
             <tbody>
               <?php $no = 1; ?>
               <?php foreach ($_SESSION["cart"] as $cart): ?>
                 <tr>
                   <td><?php echo $no ?></td>
                   <td><?php echo $cart["judul"]; ?></td>
                   <td>Rp <?php echo $cart["harga"]; ?></td>
                   <td><?php echo $cart["jumlah_beli"]; ?></td>
                   <td> Rp <?php echo $cart["jumlah_beli"]*$cart["harga"]; ?></td>
                   <td>
                     <a href="proses_cart.php?hapus=true&kode_buku=<?php echo $cart["kode_buku"] ?>">
                       <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                     </a>
                   </td>
                 </tr>
               <?php $no++; endforeach; ?>
            </tbody>
           </table>
         </div>
         <div class="card-footer">
           <a href="proses_cart.php?checkout=true">
             <button type="button" class="btn btn-dark">
               Checkout
             </button>
           </a>
         </div>
       </div>
     </div>
     <!-- footer -->
     <div class="footer bg-dark text-light text-center" style="margin-top: 10px">
       <footer>
        <p style="text-align: center">&copy; 2020 Elshita</p>
       </footer>
     </div>
     <!-- FOOTER END -->
   </body>
 </html>
