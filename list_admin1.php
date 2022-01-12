<?php
session_start();
include("config.php");

 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8" content="width=device-width, initial-scale=1">
     <title>Customer List</title>
     <link rel="stylesheet" href="assets/css/bootstrap.css">
     <script src="assets/js/jquery.min.js"></script>
     <script src="assets/js/popper.min.js"></script>
     <script src="assets/js/bootstrap.js"></script>
     <link rel="stylesheet" href="css_customer.css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
     integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ"
     crossorigin="anonymous">
   </head>
   <script type="text/javascript">
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

   <body>
     <!-- navigasi  -->
     <div id="navbar">
       <a href="#default" id="logo">Web Book Store</a>
       <div id="navbar-right">
         <a href="#home">Home</a>
         <a href="transaksi_admin.php">Transaksi</a>
         <a href="list_customer1.php">List Customer</a>
         <a class="active" href="#">List Admin</a>
         <a href="login_admin.php">Logout</a>
       </div>
     </div>
     <!-- end navigasi -->

     <!-- body list admin -->
     <div class="container" style="margin-top:300px">
       <?php
       if (isset($_POST["cari"])) {
         $cari = $_POST["cari"];
         // sql untuk pencarian
         $sql = "select * from admin where nama like'%$cari%'";

       }else {
         // sql untuk tampilan default
         $sql = "select * from admin";
       }
       // eksekusi perintah sql
       $query = mysqli_query($connect, $sql);
        ?>
        <div>
          <div>
            <table class="table" border="1">
              <thead class="bg-dark text-light">
                <tr>
                  <th>Id Admin</th>
                  <th>Nama</th>
                  <th>Kontak</th>
                  <th>Username</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($query as $key => $admin): ?>
                  <tr>
                    <td><?php echo $admin["id_admin"] ?></td>
                    <td><?php echo $admin["nama"] ?></td>
                    <td><?php echo $admin["kontak"] ?></td>
                    <td><?php echo $admin["username"] ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
     </div>
     <!-- body list admin -->


     <br>
     <br>

   </body>
 </html>
