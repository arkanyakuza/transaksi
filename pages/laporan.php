<?php
session_start();
include('../config/koneksi.php');
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Ambil data
$jumlah_pelanggan = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pelanggan"));
$jumlah_transaksi = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM transaksi"));
$total_pendapatan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(total) as total FROM transaksi"))['total'] ?? 0;

// Jika user klik tombol cetak/export
if (isset($_GET['export']) && $_GET['export'] === 'excel') {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=laporan_crm.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "
    <table border='1'>
      <tr><th colspan='2'>LAPORAN SISTEM CRM</th></tr>
      <tr><td>Jumlah Pelanggan</td><td>$jumlah_pelanggan</td></tr>
      <tr><td>Jumlah Transaksi</td><td>$jumlah_transaksi</td></tr>
      <tr><td>Total Pendapatan</td><td>Rp " . number_format($total_pendapatan, 0, ',', '.') . "</td></tr>
    </table>
    ";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Laporan | CRM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { display: flex; }
    #content { padding: 30px; flex-grow: 1; }
  </style>
</head>
<body>

<?php include('sidebar.php'); ?>

<div id="content">
  <h2>Laporan</h2>

  <div class="row g-3 mt-3">
    <div class="col-md-4">
      <div class="card bg-primary text-white">
        <div class="card-body">
          <h5 class="card-title">Jumlah Pelanggan</h5>
          <p class="card-text fs-3"><?= $jumlah_pelanggan ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-success text-white">
        <div class="card-body">
          <h5 class="card-title">Jumlah Transaksi</h5>
          <p class="card-text fs-3"><?= $jumlah_transaksi ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-warning text-dark">
        <div class="card-body">
          <h5 class="card-title">Total Pendapatan</h5>
          <p class="card-text fs-3">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Tombol Export -->
  <div class="mt-4">
    <a href="?export=excel" class="btn btn-outline-secondary">⬇️ Export ke Excel</a>
  </div>
</div>

</body>
</html>
