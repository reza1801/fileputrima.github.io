<?php
include('koneksi.php'); // Sertakan file koneksi

// Ambil no_pinjaman dari query string dan validasi
$no_pinjaman = isset($_GET['no_pinjaman']) ? trim($_GET['no_pinjaman']) : '';

// Validasi input no_pinjaman
if (empty($no_pinjaman)) {
    echo json_encode([
        'success' => false,
        'message' => 'No Pinjaman tidak valid atau kosong.'
    ]);
    exit;
}

// Menyiapkan query dengan prepared statement untuk mencegah SQL injection
$query = "SELECT * FROM nasabah WHERE NO_PINJAMAN = ?";
$stmt = mysqli_prepare($conn, $query);

// Cek jika query berhasil dipersiapkan
if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'Terjadi kesalahan pada query database.'
    ]);
    exit;
}

// Bind parameter dan eksekusi query
mysqli_stmt_bind_param($stmt, "s", $no_pinjaman);
mysqli_stmt_execute($stmt);

// Menyimpan hasil eksekusi query
$result = mysqli_stmt_get_result($stmt);

// Jika data ditemukan
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Mengembalikan data dalam format JSON
    echo json_encode([
        'success' => true,
        'saldo' => $row['TOTAL_SALDO'],  // Mengambil saldo pinjaman
        'nama' => $row['NAMA'],          // Mengambil nama
        'alamat' => $row['ALAMAT']       // Mengambil alamat
    ]);
} else {
    // Jika tidak ditemukan
    echo json_encode([
        'success' => false,
        'message' => 'No Pinjaman tidak ditemukan.'
    ]);
}

// Menutup statement dan koneksi database
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
