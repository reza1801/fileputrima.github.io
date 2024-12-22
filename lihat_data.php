<?php
session_start(); // Mulai session

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: masuk.php");
    exit();
}

// Sertakan file koneksi
include('koneksi.php');

// Perbarui nilai TOTAL_SALDO ke database jika belum diupdate
$updateQuery = "UPDATE nasabah SET TOTAL_SALDO = PINJAMAN * 1.20 WHERE TOTAL_SALDO IS NULL OR TOTAL_SALDO < PINJAMAN * 1.20";
$updateResult = mysqli_query($conn, $updateQuery);

if (!$updateResult) {
    die("Gagal memperbarui TOTAL_SALDO: " . mysqli_error($conn));
}

// Hapus data nasabah yang sudah lunas (saldo 0)
$deleteQuery = "DELETE FROM nasabah WHERE TOTAL_SALDO = 0";
$deleteResult = mysqli_query($conn, $deleteQuery);
if (!$deleteResult) {
    die("Gagal menghapus data nasabah lunas: " . mysqli_error($conn));
}

// Proses pencarian
$search = '';
$searchMessage = ''; // Pesan untuk pencarian
if (!empty($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
} elseif (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

// Modifikasi query untuk mencari berdasarkan nama
$query = "SELECT * FROM nasabah";
if ($search !== '') {
    $query .= " WHERE NAMA LIKE '%$search%'";
    $searchMessage = "Hasil pencarian untuk: '$search'";  // Tampilkan pesan pencarian
}
$query .= " ORDER BY NO_PINJAMAN";

// Jalankan query
$result = mysqli_query($conn, $query);

// Cek apakah query berhasil
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

// Fungsi untuk format mata uang Rupiah
function formatRupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ADD8E6, #90EE90);
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #343a40;
        }

        .card {
            background-color: #ffffff;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #343a40;
            color: white;
        }

        .table {
            width: 100%;
            margin-bottom: 20px;
            table-layout: fixed;
        }

        .table th,
        .table td {
            text-align: center;
            padding: 8px 12px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">DATA NASABAH ANDA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item ms-2">
                        <a class="nav-link btn btn-primary ms-2" href="data_form.php">Kembali</a>
                    </li>
                    <!-- Form Pencarian -->
                    <li class="nav-item ms-2">
                        <form class="d-flex" action="lihat_data.php" method="GET">
                            <input class="form-control ms-2" type="search" placeholder="Cari Nasabah" aria-label="Search" name="search" value="<?= htmlspecialchars($search); ?>">
                            <button class="btn btn-outline-success ms-2" type="submit">Cari</button>
                            <?php if ($search): ?>
                                <a href="lihat_data.php" class="btn btn-outline-warning ms-2">X</a>
                            <?php endif; ?>
                        </form>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link btn btn-danger ms-2" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Tabel Data Nasabah -->
    <div class="container mt-5">
        <?php if ($searchMessage): ?>
            <div class="alert alert-info">
                <?= $searchMessage; ?>
            </div>
        <?php endif; ?>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3>Data Nasabah: <?= htmlspecialchars($row['NAMA']); ?></h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>No Pinjaman</th>
                                    <td><?= htmlspecialchars($row['NO_PINJAMAN']); ?></td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td><?= htmlspecialchars($row['NAMA']); ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td><?= htmlspecialchars($row['ALAMAT']); ?></td>
                                </tr>
                                <tr>
                                    <th>RT/RW</th>
                                    <td><?= htmlspecialchars($row['RT_RW']); ?></td>
                                </tr>
                                <tr>
                                    <th>Pinjaman</th>
                                    <td><?= formatRupiah($row['PINJAMAN']); ?></td>
                                </tr>
                                <tr>
                                    <th>Bunga (20%)</th>
                                    <td><?= formatRupiah($row['PINJAMAN'] * 0.20); ?></td>
                                </tr>
                                <tr>
                                    <th>Total Saldo (120%)</th>
                                    <td><?= formatRupiah($row['TOTAL_SALDO']); ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td><?= htmlspecialchars($row['TANGGAL']); ?></td>
                                </tr>
                                <!-- Jika saldo sudah lunas, tampilkan tombol hapus -->
                                <?php if ($row['TOTAL_SALDO'] == 0): ?>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <form action="hapus_nasabah.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data nasabah ini?');">
                                                <input type="hidden" name="NO_PINJAMAN" value="<?= $row['NO_PINJAMAN']; ?>">
                                                <button type="submit" class="btn btn-danger">Hapus Nasabah (Lunas)</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="card shadow">
                <div class="card-header text-center">
                    <h3>Data Nasabah</h3>
                </div>
                <div class="card-body text-center">
                    <p>Data tidak ditemukan</p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> 
</body>

</html>
