<?php
session_start();  // Mulai session

// Hancurkan semua session data
session_destroy();

// Redirect ke halaman login (masuk.php)
header("Location: masuk.php");
exit();
?>
