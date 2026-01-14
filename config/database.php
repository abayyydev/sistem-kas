<?php
// config/database.php

$host = 'localhost';
$db_name = 'db_pettycash';
$username = 'root';
$password = ''; // Kosongkan jika pakai XAMPP default

try {
    $dsn = "mysql:host=$host;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Error ditampilkan sebagai Exception
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Data diambil sebagai Array Associative
        PDO::ATTR_EMULATE_PREPARES => false,                  // Native prepared statements
    ];

    $pdo = new PDO($dsn, $username, $password, $options);

    // Opsional: Cek koneksi (hanya untuk debug, hapus saat production)
    // echo "Koneksi Berhasil"; 

} catch (\PDOException $e) {
    // Jika gagal, tampilkan pesan error yang user-friendly (jangan dump error asli ke user)
    die("Koneksi Database Gagal: " . $e->getMessage());
}

// Set Timezone Indonesia
date_default_timezone_set('Asia/Jakarta');
?>