<?php
// api/categories.php
header('Content-Type: application/json');
require_once '../config/database.php';
session_start();

$method = $_SERVER['REQUEST_METHOD'];

// GET: Ambil Kategori + Nama Grupnya (JOIN)
if ($method === 'GET') {
    // Kita JOIN ke tabel category_groups untuk dapat nama grupnya
    $sql = "SELECT c.*, g.name as group_name 
            FROM categories c
            JOIN category_groups g ON c.group_id = g.id
            ORDER BY g.name ASC, c.name ASC";

    $stmt = $pdo->query($sql);
    echo json_encode(['success' => true, 'data' => $stmt->fetchAll()]);
    exit;
}

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
    exit;
}

// POST: Tambah Kategori (Sekarang pakai group_id)
if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $stmt = $pdo->prepare("INSERT INTO categories (group_id, name, is_zakat) VALUES (?, ?, ?)");
    $stmt->execute([$input['group_id'], $input['name'], $input['is_zakat']]);
    echo json_encode(['success' => true, 'message' => 'Kategori berhasil ditambah']);
    exit;
}

// DELETE: Hapus
if ($method === 'DELETE') {
    $input = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->execute([$input['id']]);
    echo json_encode(['success' => true, 'message' => 'Kategori dihapus']);
    exit;
}
?>