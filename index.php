<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>CRM | Halaman Utama</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS Lokal -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#f2f2f2;">

  <div class="container text-center mt-5">
    <h1>Selamat Datang di Sistem CRM</h1>
    <p class="lead">Sistem informasi manajemen pelanggan berbasis web</p>

    <?php if (isset($_SESSION['login'])): ?>
      <p>Anda sudah login sebagai <strong><?= $_SESSION['username']; ?></strong></p>
      <a href="pages/dashboard.php" class="btn btn-success">Masuk ke Dashboard</a>
    <?php else: ?>
      <a href="auth/login.php" class="btn btn-primary">Login Sekarang</a>
    <?php endif; ?>
  </div>

</body>
</html>
