<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";
$port = 3307;  // port yang digunakan

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
<?php
$servername = "localhost:3307"; // Ganti dengan nama server Anda
$username = "root";        // Username database
$password = "";            // Password database
$database = "data";    // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Buat tabel NASABAH jika belum ada
$sql = "CREATE TABLE IF NOT EXISTS data (
    NO_PINJAMAN VARCHAR(50) NOT NULL,
    NAMA VARCHAR(100) NOT NULL,
    ALAMAT VARCHAR(255) NOT NULL,
    RT_RW VARCHAR(20) NOT NULL,
    NIK VARCHAR(50) NOT NULL,
    PINJAMAN VARCHAR(50) NOT NULL,
    STATUS VARCHAR(20) NOT NULL
)";
if (!$conn->query($sql)) {
    die("Gagal membuat tabel: " . $conn->error);
}
?>
