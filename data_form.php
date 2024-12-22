<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 50%, #fbc2eb 100%);
            font-family: Arial, sans-serif;
            animation: gradientAnimation 6s infinite alternate;
            background-size: 400% 400%;
            color: #333;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .navbar {
            background-color: #343a40;
        }

        .card {
            background-color: #ffffff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .card-header {
            background-color: #343a40;
            color: white;
            border-radius: 15px 15px 0 0;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .form-container {
            display: none;
        }

        .btn {
            border-radius: 25px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">SELAMAT DATANG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            PILIH FORM INPUT
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#" onclick="showForm('angsuran')">Masukkan Angsuran</a></li>
                            <li><a class="dropdown-item" href="#" onclick="showForm('nasabah')">Tambah Nasabah</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lihat_data.php">Lihat Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lihat_angsuran.php">Lihat Angsuran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="arsip.php">Arsip</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Pesan notifikasi -->
    <div class="container mt-3">
        <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <?= $message; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Form Masukkan Angsuran -->
    <div class="container mt-5 form-container" id="angsuranForm">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Form Masukkan Angsuran</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" onsubmit="return validateForm()">
                            <div class="mb-3">
                                <label for="NO_PINJAMAN" class="form-label">No Pinjaman</label>
                                <input type="text" class="form-control" id="NO_PINJAMAN" name="NO_PINJAMAN" required oninput="getAngsuranFromSaldo()">
                            </div>
                            <div class="mb-3">
                                <label for="ANGSURAN" class="form-label">Angsuran</label>
                                <input type="text" class="form-control" id="ANGSURAN" name="ANGSURAN" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="NAMA" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="NAMA" name="NAMA" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="ALAMAT" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="ALAMAT" name="ALAMAT" readonly>
                            </div>
                            <input type="hidden" class="form-control" id="TANGGAL" name="TANGGAL" value="<?php echo date('Y-m-d H:i:s'); ?>">
                            <button type="submit" name="masukkan_angsuran" class="btn btn-success w-100">Simpan Angsuran</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Tambah Nasabah -->
    <div class="container mt-5 form-container" id="nasabahForm">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Form Tambah Nasabah</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="NO_PINJAMAN" class="form-label">No Pinjaman</label>
                                <input type="text" class="form-control" id="NO_PINJAMAN" name="NO_PINJAMAN" required>
                            </div>
                            <div class="mb-3">
                                <label for="NAMA" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="NAMA" name="NAMA" required>
                            </div>
                            <div class="mb-3">
                                <label for="ALAMAT" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="ALAMAT" name="ALAMAT" required>
                            </div>
                            <div class="mb-3">
                                <label for="RT_RW" class="form-label">No RT/RW</label>
                                <input type="text" class="form-control" id="RT_RW" name="RT_RW" required>
                            </div>
                            <div class="mb-3">
                                <label for="PINJAMAN" class="form-label">Pinjaman</label>
                                <input type="text" class="form-control" id="PINJAMAN" name="PINJAMAN" required oninput="formatCurrency(this)">
                            </div>
                            <input type="hidden" class="form-control" id="TANGGAL" name="TANGGAL" value="<?php echo date('Y-m-d H:i:s'); ?>">
                            <button type="submit" name="tambah_nasabah" class="btn btn-primary w-100">Simpan Nasabah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function formatCurrency(input) {
            let value = input.value.replace(/[^\d]/g, '');
            if (value) {
                value = parseInt(value).toLocaleString('id-ID');
                input.value = 'Rp ' + value;
            }
        }

        function getAngsuranFromSaldo() {
            let noPinjaman = document.getElementById('NO_PINJAMAN').value;
            if (noPinjaman) {
                fetchAngsuran(noPinjaman);
            }
        }

        function fetchAngsuran(noPinjaman) {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_angsuran.php?no_pinjaman=' + noPinjaman, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    let response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        let angsuran = response.saldo * 0.1;
                        document.getElementById('ANGSURAN').value = 'Rp ' + angsuran.toLocaleString('id-ID');
                        document.getElementById('NAMA').value = response.nama;
                        document.getElementById('ALAMAT').value = response.alamat;
                    } else {
                        alert(response.message);
                    }
                }
            };
            xhr.send();
        }

        function validateForm() {
            let angsuran = document.getElementById('ANGSURAN').value;
            if (!angsuran || angsuran === 'Rp 0') {
                alert('Angsuran tidak valid.');
                return false;
            }
            return true;
        }

        function showForm(formType) {
            document.getElementById('angsuranForm').style.display = 'none';
            document.getElementById('nasabahForm').style.display = 'none';

            if (formType === 'angsuran') {
                document.getElementById('angsuranForm').style.display = 'block';
            } else if (formType === 'nasabah') {
                document.getElementById('nasabahForm').style.display = 'block';
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
