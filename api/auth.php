<?php
// api/auth.php
header('Content-Type: application/json');
require_once '../config/database.php';

// Memulai session PHP
session_start();

// Menerima input JSON dari JavaScript
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['username']) || !isset($input['password'])) {
    echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
    exit;
}

$username = trim($input['username']);
$password = $input['password'];

try {
    // 1. Cari user berdasarkan username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    // 2. Verifikasi Password
    if ($user && password_verify($password, $user['password'])) {

        // 3. Set Session Variables (PENTING untuk menjaga login)
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['branch'] = $user['branch'];
        $_SESSION['logged_in'] = true;

        // Catat Audit Log Login (Opsional tapi bagus untuk skripsi)
        $logStmt = $pdo->prepare("INSERT INTO audit_logs (user_id, action, details, ip_address) VALUES (?, ?, ?, ?)");
        $logStmt->execute([$user['id'], 'LOGIN', 'User berhasil login', $_SERVER['REMOTE_ADDR']]);

        echo json_encode([
            'success' => true,
            'message' => 'Login berhasil',
            'role' => $user['role']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Username atau Password salah!']);
    }

} catch (PDOException $e) {
    // Jangan tampilkan error database asli ke user untuk keamanan
    error_log("Database Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan sistem database']);
}
?>