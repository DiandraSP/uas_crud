<?php
// Mulai sesi
session_start();

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Arahkan ke halaman landing page (index.php)
header('Location: index.php');
exit;
?>
