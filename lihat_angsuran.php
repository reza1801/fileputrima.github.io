<?php
session_start(); // Mulai session

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: masuk.php");
    exit();
}

// Sertakan file koneksi
include('koneksi.php');

// Menangani pencarian berdasarkan nama nasabah
$search = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

// Query untuk mengambil data semua nasabah yang memiliki angsuran
$query = "SELECT DISTINCT NAMA, TOTAL_SALDO, ALAMAT, RT_RW, PINJAMAN FROM nasabah WHERE (ANGSURAN_1 > 0 OR ANGSURAN_2 > 0 OR ANGSURAN_3 > 0 OR ANGSURAN_4 > 0 OR ANGSURAN_5 > 0 OR ANGSURAN_6 > 0 OR ANGSURAN_7 > 0 OR ANGSURAN_8 > 0 OR ANGSURAN_9 > 0 OR ANGSURAN_10 > 0)";
if ($search) {
    $query .= " AND NAMA LIKE '%$search%'";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Angsuran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f0f9ff, #c1eafc, #a7d8f0);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background: rgba(0, 0, 0, 0.8);
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn {
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">DATA ANGSURAN NASABAH ANDA</a>
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
                        <form class="d-flex" action="lihat_angsuran.php" method="GET">
                            <input class="form-control me-2" type="search" placeholder="Cari Nasabah" aria-label="Search" name="search" value="<?= htmlspecialchars($search); ?>">
                            <button class="btn btn-outline-success" type="submit">Cari</button>
                            <?php if ($search): ?>
                                <a href="lihat_angsuran.php" class="btn btn-outline-warning ms-2">X</a>
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

    <!-- Daftar Nama Nasabah -->
    <div class="container mt-5">
        <h3 class="text-center">Daftar Angsuran Nasabah</h3>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php
                $nama = $row['NAMA'];
                $total_saldo = $row['TOTAL_SALDO'];
                $alamat = $row['ALAMAT'];
                $rt_rw = $row['RT_RW'];
                $pinjaman = $row['PINJAMAN'];

                $angsuran_query = "SELECT NO_PINJAMAN, 
                                  TANGGAL_1, ANGSURAN_1,
                                  TANGGAL_2, ANGSURAN_2,
                                  TANGGAL_3, ANGSURAN_3,
                                  TANGGAL_4, ANGSURAN_4,
                                  TANGGAL_5, ANGSURAN_5,
                                  TANGGAL_6, ANGSURAN_6,
                                  TANGGAL_7, ANGSURAN_7,
                                  TANGGAL_8, ANGSURAN_8,
                                  TANGGAL_9, ANGSURAN_9,
                                  TANGGAL_10, ANGSURAN_10
                                  FROM nasabah WHERE NAMA = '$nama'";

                $angsuran_result = mysqli_query($conn, $angsuran_query);
                if (mysqli_num_rows($angsuran_result) > 0):
                    $angsuran_row = mysqli_fetch_assoc($angsuran_result);
                    $sisa_saldo = $total_saldo;

                    for ($i = 1; $i <= 10; $i++) {
                        if (!empty($angsuran_row["ANGSURAN_$i"])) {
                            $sisa_saldo -= $angsuran_row["ANGSURAN_$i"];
                        }
                    }

                    if ($sisa_saldo <= 0) {
                        $insert_arsip = "INSERT INTO arsip (NO_PINJAMAN, NAMA, ALAMAT, RT_RW, PINJAMAN) VALUES ('" . $angsuran_row['NO_PINJAMAN'] . "', '$nama', '$alamat', '$rt_rw', '$pinjaman')";
                        if (mysqli_query($conn, $insert_arsip)) {
                            $delete_query = "DELETE FROM nasabah WHERE NAMA = '$nama'";
                            if (mysqli_query($conn, $delete_query)) {
                                echo "<div class='alert alert-success'>Data nasabah <strong>$nama</strong> telah lunas dan dipindahkan ke arsip.</div>";
                                continue;
                            }
                        }
                    }
                ?>

                    <div class="card mt-4">
                        <div class="card-header">
                            <h4 class="card-title"><?= htmlspecialchars($nama); ?></h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Tanggal dan Waktu</th>
                                        <th>No Pinjaman</th>
                                        <th>Nama</th>
                                        <th>Angsuran</th>
                                        <th>Sisa Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sisa_saldo = $total_saldo;
                                    for ($i = 1; $i <= 10; $i++):
                                        if (!empty($angsuran_row["ANGSURAN_$i"])): 
                                            $sisa_saldo -= $angsuran_row["ANGSURAN_$i"];
                                            ?>
                                            <tr>
                                                <td><?= htmlspecialchars($angsuran_row["TANGGAL_$i"]); ?></td>
                                                <td><?= htmlspecialchars($angsuran_row['NO_PINJAMAN']); ?></td>
                                                <td><?= htmlspecialchars($nama); ?></td>
                                                <td>Rp <?= number_format($angsuran_row["ANGSURAN_$i"], 0, ',', '.'); ?></td>
                                                <td>Rp <?= number_format($sisa_saldo, 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php endif;
                                    endfor;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-center">Belum ada data angsuran</p>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">Belum ada data nasabah yang memiliki angsuran.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
