<?php
session_start();
include('../config/koneksi.php'); // <--- tambahkan baris ini!

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard | CRM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { display: flex; }
    #sidebar {
      width: 250px;
      background-color: #343a40;
      min-height: 100vh;
      padding: 20px;
    }
    #sidebar a { color: white; display: block; margin-bottom: 10px; text-decoration: none; }
    #content { padding: 30px; flex-grow: 1; }
  </style>
</head>
<body>

<div id="sidebar">
  <h4 class="text-white">CRM Menu</h4>
  <a href="dashboard.php">🏠 Dashboard</a>
  <a href="pelanggan.php">👥 Data Pelanggan</a>
  <a href="transaksi.php">💰 Transaksi</a>
  <a href="laporan.php">📊 Laporan</a>
  <a href="../auth/logout.php">🚪 Logout</a>
</div>

<div id="content">
  <h2>Selamat Datang, <?= $_SESSION['username']; ?>!</h2>
  <p>Gunakan menu di sebelah kiri untuk mengelola data pelanggan, transaksi, dan laporan.</p>

  <hr>
  <h4>Tambah Admin Baru</h4>

  <?php
  if (isset($_POST['buat_admin'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $nama = $_POST['nama'];

      $password_hash = password_hash($password, PASSWORD_DEFAULT);

      $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
      if (mysqli_num_rows($cek) > 0) {
          echo "<div class='alert alert-warning'>Username sudah digunakan!</div>";
      } else {
          mysqli_query($koneksi, "INSERT INTO users (username, password, nama_lengkap) VALUES ('$username', '$password_hash', '$nama')");
          echo "<div class='alert alert-success'>Admin baru berhasil dibuat!</div>";
      }
  }
  ?>

  <form method="POST" class="row g-2 mb-4">
    <div class="col-md-3">
      <input type="text" name="username" class="form-control" placeholder="Username Baru" required>
    </div>
    <div class="col-md-3">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <div class="col-md-4">
      <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
    </div>
    <div class="col-md-2">
      <button name="buat_admin" class="btn btn-secondary w-100">Tambah Admin</button>
    </div>
  </form>
</div>

</body>
</html>
