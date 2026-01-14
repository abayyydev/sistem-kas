<?php
// api/groups.php
header('Content-Type: application/json');
require_once '../config/database.php';
session_start();

$method = $_SERVER['REQUEST_METHOD'];

// GET: Ambil Semua Grup
if ($method === 'GET') {
    $stmt = $pdo->query("SELECT * FROM category_groups ORDER BY name ASC");
    echo json_encode(['success' => true, 'data' => $stmt->fetchAll()]);
    exit;
}

// Security Check
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
    exit;
}

// POST: Tambah Grup
if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (empty($input['name'])) {
        echo json_encode(['success' => false, 'message' => 'Nama grup wajib diisi']);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO category_groups (name) VALUES (?)");
    $stmt->execute([$input['name']]);
    echo json_encode(['success' => true, 'message' => 'Grup berhasil ditambah']);
    exit;
}

// DELETE: Hapus Grup
if ($method === 'DELETE') {
    $input = json_decode(file_get_contents('php://input'), true);
    // Cek apakah grup sedang dipakai oleh kategori?
    $check = $pdo->prepare("SELECT id FROM categories WHERE group_id = ?");
    $check->execute([$input['id']]);
    if ($check->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'Gagal! Grup ini masih memiliki kategori di dalamnya.']);
        exit;
    }

    $stmt = $pdo->prepare("DELETE FROM category_groups WHERE id = ?");
    $stmt->execute([$input['id']]);
    echo json_encode(['success' => true, 'message' => 'Grup dihapus']);
    exit;
}
?>