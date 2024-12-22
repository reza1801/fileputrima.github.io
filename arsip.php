<?php
session_start(); // Mulai session

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: masuk.php");
    exit();
}

// Sertakan file koneksi
include('koneksi.php');

// Menangani pencarian berdasarkan nama nasabah di arsip
$search = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

// Query untuk mengambil data dari tabel arsip
$query = "SELECT NO_PINJAMAN, NAMA, ALAMAT, RT_RW, PINJAMAN FROM arsip";
if ($search) {
    $query .= " WHERE NAMA LIKE '%$search%'";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Arsip Nasabah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom right, #a8dadc, #f1faee, #457b9d);
            min-height: 100vh;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">DATA ARSIP NASABAH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-2">
                        <a class="nav-link btn btn-secondary text-white" href="data_form.php">Kembali</a>
                    </li>
                    <!-- Form Pencarian -->
                    <li class="nav-item me-2">
                        <form class="d-flex" action="arsip.php" method="GET">
                            <input class="form-control me-2" type="search" placeholder="Cari Nasabah" aria-label="Search" name="search" value="<?= htmlspecialchars($search); ?>">
                            <button class="btn btn-outline-success" type="submit">Cari</button>
                            <?php if ($search): ?>
                                <a href="arsip.php" class="btn btn-outline-warning ms-2">X</a>
                            <?php endif; ?>
                        </form>
                    </li>
                    <!-- Tombol Logout di pojok kanan -->
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Daftar Arsip Nasabah -->
    <div class="container mt-5">
        <h3 class="text-center">Data Arsip Nasabah</h3>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="card mt-4 p-4">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No Pinjaman</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>RT/RW</th>
                            <th>Pinjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['NO_PINJAMAN']); ?></td>
                                <td><?= htmlspecialchars($row['NAMA']); ?></td>
                                <td><?= htmlspecialchars($row['ALAMAT']); ?></td>
                                <td><?= htmlspecialchars($row['RT_RW']); ?></td>
                                <td>Rp <?= number_format($row['PINJAMAN'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center">Belum ada data arsip nasabah.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
