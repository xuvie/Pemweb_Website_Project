<?php
$error = '';
$hasil = false;
if (!empty($_POST)) {
    $pdo = require 'koneksi.php';
    if ($_POST['password'] != $_POST['password2']) {
        $error = 'Password dan Ketik Ulang Password harus sama';
    } else if (strlen($_POST['password']) < 6) {
        $error ='Password harus minimal 6 karakter';
    }else {
        // Validasi email
        $sql = "select count(*) from users where email=:emailUser";
        $query = $pdo->prepare($sql);
        $query->execute(array('emailUser' => $_POST['email']));
        $count = $query->fetchColumn();
        if ($count > 0) {
            $error = 'Gunakan email lain';
        } else {
            $sql = "insert into users (nama, email , password) 
            values (:nama, :email, :password)";
            $query2 = $pdo->prepare($sql);
            $query2->execute(array(
                'nama' => $_POST['nama'],
                'email' => $_POST['email'],
                'password' => sha1($_POST['password']),
            ));
            $hasil = true;
            unset($_POST);
        }
        header("Location: login.php");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="form.css" rel="stylesheet" media="all" />
  </head>

  <body>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">

      <div class="wrapper wrapper--w780">
        <div class="card card-3">
          <div class="card-heading"></div>
          <div class="card-body">
            <h2 class="title">Registration</h2>
            <p class="text-white">Silahkan mendaftar sebelum menggunakan forum.</p>
          <br >
          <?php if ($hasil == true) {?>
          <p class="text-success">
              Registrasi berhasil, silahkan <a href="login.php">login</a>.
          </p>
          <?php }?>
          <?php
          if ($error != '') {
              echo '<p class="text-danger">'. $error . '</p>';
          }
          ?>
            <form method="POST">
              <div class="input-group">
                <input class="input--style-3" type="text" name="nama" placeholder="Nama" required value="<?php echo isset($_POST['nama']) ? $_POST['nama'] : '';?>">
              </div>
              <div class="input-group">
                <input class="input--style-3 js-datepicker" type="email" name="email" placeholder="Email" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : '';?>">
                <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
              </div>
              <div class="input-group">
                <input class="input--style-3" type="password" name="password" placeholder="Password" required>
              </div>
              <div class="input-group">
                <input class="input--style-3" type="password" name="password2" placeholder="Konfirmasi Password" required>
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