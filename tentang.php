<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Gradasi tiga warna untuk background */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #a2c2e8, #a8e0a7, #f3c0c0); /* Biru muda, hijau muda, pink muda */
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 10px 20px;
            color: white;
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar ul li {
            margin: 0 15px;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .navbar ul li a:hover {
            text-decoration: underline;
        }

        .container {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
            flex-grow: 1;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .content {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .card h3 {
            margin-bottom: 15px;
        }

        .card p {
            color: #555;
        }

        .card .button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .card .button:hover {
            background-color: #555;
        }

        .hidden-section {
            margin-top: 40px;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            display: none;
            text-align: center; /* Memastikan teks di tengah */
        }

        .hidden-section h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        /* Memperlebar kolom input dan memperbaiki tampilan */
        .styled-input {
            width: 80%; /* Mengatur lebar menjadi 80% dari lebar kontainer */
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            background-color: #f4f4f4;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            min-height: 200px; /* Lebarkan area input */
            resize: vertical; /* Memungkinkan pengubahan ukuran input secara vertikal */
            margin-left: auto;  /* Menambahkan margin kiri otomatis */
            margin-right: auto; /* Menambahkan margin kanan otomatis */
            display: block;  /* Membuatnya menjadi blok agar margin otomatis bekerja */
        }

        .styled-input:focus {
            border-color: #333;
            outline: none;
            background-color: #fff;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button-container .button {
            padding: 12px 30px;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo">KSP KOSPIN JASA</div>
        <ul>
            <li><a href="halaman.php">KEMBALI</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="header">
            <h1>TENTANG KAMI</h1>
            <p>Aplikasi pertama di dunia untuk input data koperasi harian.</p>
        </div>

        <div class="content">
            <div class="card">
                <h3>Fitur</h3>
                <p>Memudahkan petugas dalam meng-input data nasabah ,juga memudahkan admin untuk mengecek data yang lebih real time.</p>
                <a href="#detail-section" class="button" onclick="showDetails()">Pelajari Lebih Lanjut</a>
            </div>
        </div>

        <div id="detail-section" class="hidden-section">
            <h3>Detail Informasi</h3>
            <textarea class="styled-input" placeholder="Tentang Aplikasi KSP KOSPIN JASA
Aplikasi KSP KOSPIN JASA dirancang untuk memudahkan proses input data angsuran dan pinjaman bagi petugas lapangan koperasi simpan pinjam. Dengan aplikasi ini, petugas dapat dengan cepat dan akurat mencatat data nasabah, melacak status pinjaman, dan mengelola informasi penting lainnya secara efisien.

Fitur utama aplikasi ini meliputi:

Pencatatan Data Nasabah: Memungkinkan petugas untuk memasukkan informasi nasabah seperti nama, alamat, jumlah pinjaman, dan nomor pinjaman dengan mudah.
Pengelolaan Pinjaman: Petugas dapat dengan cepat memantau status pinjaman nasabah dan melakukan pembaruan secara real-time.
Keamanan Data: Aplikasi ini memastikan bahwa data nasabah dan transaksi pinjaman tersimpan dengan aman, dilengkapi dengan sistem login yang aman.
Aksesibilitas: Dengan antarmuka yang sederhana dan mudah digunakan, aplikasi ini dapat diakses oleh petugas lapangan kapan saja dan di mana saja, meningkatkan efisiensi kerja.
Dengan Aplikasi KSP KOSPIN JASA, kami berkomitmen untuk memberikan solusi yang efektif dan handal bagi petugas lapangan dalam mengelola data pinjaman secara lebih terorganisir dan tepat waktu." readonly></textarea>
        </div>
    </div>

    <script>
        function showDetails() {
            const section = document.getElementById('detail-section');
            section.style.display = 'block';
            section.scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</body>

</html>
