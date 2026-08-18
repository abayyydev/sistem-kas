<?php
// api/audit.php
header('Content-Type: application/json');
require_once '../config/database.php';
session_start();

// 1. Cek Login & Role
if (!isset($_SESSION['logged_in'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

// Hanya TUP, Admin, dan Super Admin yang boleh melihat audit
$allowed_roles = ['tup', 'admin', 'super_admin'];
if (!in_array($_SESSION['role'], $allowed_roles)) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Akses ditolak.']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

// --- HANDLE GET (AMBIL DATA) ---
if ($method === 'GET') {
    try {
        // Ambil SEMUA transaksi, lalu urutkan:
        // 1. Status 'pending' paling atas
        // 2. Diikuti tanggal terbaru
        $sql = "SELECT t.*, u.full_name as pic_name 
                FROM transactions t
                JOIN users u ON t.user_id = u.id
                ORDER BY 
                    CASE WHEN t.status = 'pending' THEN 1 ELSE 2 END ASC,
                    t.date DESC, 
                    t.created_at DESC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        echo json_encode(['success' => true, 'data' => $data]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

// Fungsi POST (Verifikasi/Tolak) telah dihapus sesuai permintaan.
?>