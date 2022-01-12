<?php
include("config.php");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width", initial-scale=1.0>
    <title>Login admin</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </head>
  <body>
    <div class="container" align="center" style="margin-top:50">
      <div class="card col-sm-6">
        <div class="card-body text-left">
          <h4>Masuk Sebagai Admin</h4>
          <form action="proses_login_admin.php" method="post">
            Username
            <input type="text" name="username" class="form-control" required>
            Password
            <input type="text" name="password" class="form-control" required>
            <br>
            <button type="submit" name="login_admin" class="btn btn-block btn-dark">
              Login
            </button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
