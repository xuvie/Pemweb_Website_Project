<?php
session_start();
$hasil = true;
if (!empty($_POST)) {
  $pdo = require 'koneksi.php';
  $sql = "select * from users where email = :email";
  $query = $pdo->prepare($sql);
  $query->execute(array('email' => $_POST['email']));
  $user = $query->fetch();
  if (!$user) {
    $hasil = false;
  } elseif(sha1($_POST['password']) != $user['password']) {
    $hasil = false;
  } else {
    $hasil = true;
    $_SESSION['user']= array(
      'id' => $user['id'],
      'nama' => $user['nama'],
      'email' => $user['email'],
    );

    header("Location: index.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Colorlib Templates" />
    <meta name="author" content="Colorlib" />
    <meta name="keywords" content="Colorlib Templates" />
    <title>Sign In</title>
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all" />
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all" />
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all" />

    <link href="form.css" rel="stylesheet" media="all" />
  </head>

  <body>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
      <div class="wrapper wrapper--w780">
        <div class="card card-3">
          <div class="card-heading"></div>
          <div class="card-body">
            <h2 class="title">Login</h2>
            <form method="POST">
              <div class="input-group">
                <input class="input--style-3" type="email" placeholder="Email" name="email" />
              </div>
              <div class="input-group">
                <input class="input--style-3 js-datepicker" type="password" placeholder="Password" name="password" />
                <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
              </div>
              <a href="daftar.php">Create New Account</a><br /><br />
                <div class="signup_link">
                </div>
              <div class="p-t-10">
                <button class="btn btn--pill btn--green" type="submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>
    <script src="script.js"></script>
  </body>
</html>