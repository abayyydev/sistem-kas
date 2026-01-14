<?php
// api/branches.php
header('Content-Type: application/json');
require_once '../config/database.php';
session_start();

$method = $_SERVER['REQUEST_METHOD'];

// GET: Ambil Semua Cabang (Bisa diakses public/user login)
if ($method === 'GET') {
    $stmt = $pdo->query("SELECT * FROM branches ORDER BY name ASC");
    echo json_encode(['success' => true, 'data' => $stmt->fetchAll()]);
    exit;
}

// Security: Fitur Tambah/Hapus cuma untuk Admin
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
    exit;
}

// POST: Tambah Cabang
if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if(empty($input['name'])) {
        echo json_encode(['success' => false, 'message' => 'Nama wajib diisi']); exit;
    }
    
    $stmt = $pdo->prepare("INSERT INTO branches (name) VALUES (?)");
    $stmt->execute([$input['name']]);
    echo json_encode(['success' => true, 'message' => 'Cabang berhasil ditambah']);
    exit;
}

// DELETE: Hapus Cabang
if ($method === 'DELETE') {
    $input = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("DELETE FROM branches WHERE id = ?");
    $stmt->execute([$input['id']]);
    echo json_encode(['success' => true, 'message' => 'Cabang dihapus']);
    exit;
}
?>