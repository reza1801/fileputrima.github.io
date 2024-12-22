<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HALAMAN_AWAL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style2.css"/>    
    <style>
        /* Gradasi tiga warna */
        body {
            background: linear-gradient(to right, #a2c2e8, #a8e0a7, #f3c0c0); /* Biru muda, hijau muda, dan pink muda */
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .banner {
            padding: 100px 0;
            background: rgba(255, 255, 255, 0.7); /* Memberikan efek transparan */
            border-radius: 10px;
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">KSP KOSPIN JASA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-right" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="tentang.php">tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="masuk.php">MASUK</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            KONTAK
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">PUTRI MERI ARYUNDA</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">+62-857-1347-8087</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <div class="container-fluid banner">
        <div class="container text-center">
            <h4 class="display-6"> SELAMAT DATANG</h4>
            <h4 class="display-6">DI APLIKASI INPUT DATA KSP KOSPIN JASA</h4>
            <h3 class="display-1"> SELAMAT BERKERJA!</h3>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
