<?php
session_start();
include('../config/koneksi.php');
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Hapus pelanggan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id=$id");
    header("Location: pelanggan.php");
    exit;
}

// Tambah pelanggan
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $barang = $_POST['barang'];
    mysqli_query($koneksi, "INSERT INTO pelanggan (nama, email, telepon, alamat, barang) VALUES ('$nama','$email','$telepon','$alamat','$barang')");
    header("Location: pelanggan.php");
    exit;
}

// Ambil data
$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Pelanggan | CRM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { display: flex; }
    #content { padding: 30px; flex-grow: 1; }
  </style>
</head>
<body>

<?php include('sidebar.php'); ?>

<div id="content">
  <h2>Data Pelanggan</h2>

  <form method="POST" class="mb-3">
    <div class="row g-2">
      <div class="col"><input type="text" name="nama" class="form-control" placeholder="Nama" required></div>
      <div class="col"><input type="email" name="email" class="form-control" placeholder="Email"></div>
      <div class="col"><input type="text" name="telepon" class="form-control" placeholder="Telepon"></div>
      <div class="col"><input type="text" name="alamat" class="form-control" placeholder="Alamat"></div>
      <div class="col"><input type="text" name="barang" class="form-control" placeholder="Barang" required></div>
      <div class="col"><button name="tambah" class="btn btn-primary">Tambah</button></div>
    </div>
  </form>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th><th>Nama</th><th>Email</th><th>Telepon</th><th>Alamat</th><th>Barang</th><th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; while($row = mysqli_fetch_assoc($pelanggan)): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['telepon'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td><?= $row['barang'] ?></td>
        <td>
          <a href="pelanggan.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus?')" class="btn btn-sm btn-danger">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

</body>
</html>
