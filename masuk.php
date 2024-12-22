<?php
// Mulai sesi untuk session login
session_start();

// Jika pengguna sudah login, redirect ke data_form.php
if (isset($_SESSION['username'])) {
    header("Location: data_form.php");
    exit();
}

// Memasukkan file koneksi
include('koneksi.php');  // Pastikan ini berada sebelum query

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk cek login
    $sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Cek apakah ada data yang cocok
    if ($result->num_rows > 0) {
        // Menyimpan session jika login berhasil
        $_SESSION['username'] = $username;
        header("Location: data_form.php");
        exit();
    } else {
        // Jika login gagal
        $error = "Gagal masuk";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Styling untuk body */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #ADD8E6, #90EE90);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Styling untuk container form */
        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        /* Styling untuk header */
        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        /* Styling untuk input fields */
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        /* Styling untuk button */
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Styling untuk error message */
        .error {
            color: red;
            margin-top: 10px;
            font-size: 14px;
        }

        /* Styling untuk link (optional) */
        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Menambahkan jarak dan styling untuk tombol kembali */
        .back-button {
            width: 100%;
            padding: 12px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php
        // Menampilkan pesan error jika gagal login
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
        <form method="POST" action="masuk.php">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <!-- Tombol Kembali dengan jarak dan desain lebih baik -->
            <a href="halaman.php"><button type="button" class="back-button">Kembali</button></a>
        </form>
    </div>
</body>
</html>
