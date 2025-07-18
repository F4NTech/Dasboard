
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0.5, 0.5, 0.5, 0.5); 
      z-index: 0;
    }
    html, body {
      height: 100%;
      margin: 4;
      background: url('Aplikasi/dist/img/PLTS.png') no-repeat center center fixed;
      background-size: cover;
    }

    .login-container {
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-box {
      background-color: rgba(255, 255, 255, 0.5); /* Transparansi 50% */
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(5px);
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 360px;
    }

    .login-box h4 {
      text-align: center;
      margin-bottom: 25px;
      font-weight: bold;
    }
    .login-box img {
      margin: center;
      margin-bottom: 25px;
      font-weight: bold;
      margin-left: 95px;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="overlay"></div>
  <div class="login-container">

    <div class="login-box">
      <img src="Logo/Unas.png" alt="Logo" style="width: 100px; height: auto;">
      <h4>Login</h4>
      <form action="Conf/autentifikasi.php" method="post">
        <div class="form-group">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
      </form>
    </div>
  </div>
</body>
</html>



<!-- jQuery -->
<script src="app/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<!-- <script src="app/dist/js/adminlte.min.js"></script> -->
<!-- SweetAlert2 -->
<script src="app/plugins/sweetalert2/sweetalert2.min.js"></script>
</body>
<?php
if (isset($_GET['error'])) {
  echo "
  <script>
    var Toast = Swal.mixin({
      toast: true,
      position: 'center-top',
      showConfirmButton: false,
      timer: 3000
    });
    Toast.fire({
      icon: 'warning',
      title: 'Login Gagal',
    })
  </script>";
}
else{
  echo '';
}
?>
</html>