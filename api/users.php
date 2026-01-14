<?php
// api/users.php
header('Content-Type: application/json');
require_once '../config/database.php';
session_start();

// 1. Cek Login & Role Admin
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Akses ditolak.']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

// --- GET: AMBIL SEMUA USER ---
if ($method === 'GET') {
    try {
        $stmt = $pdo->query("SELECT id, username, full_name, role, branch, created_at FROM users ORDER BY role ASC, branch ASC");
        $users = $stmt->fetchAll();
        echo json_encode(['success' => true, 'data' => $users]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

// --- POST: TAMBAH USER BARU ---
if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Validasi
    if (empty($input['username']) || empty($input['password']) || empty($input['full_name']) || empty($input['role'])) {
        echo json_encode(['success' => false, 'message' => 'Semua field wajib diisi.']);
        exit;
    }

    // Cek Username Kembar
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$input['username']]);
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'Username sudah digunakan!']);
        exit;
    }

    try {
        // Hash Password
        $hashed_password = password_hash($input['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, full_name, role, branch) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $input['username'],
            $hashed_password,
            $input['full_name'],
            $input['role'],
            $input['branch'] ?? '-'
        ]);

        echo json_encode(['success' => true, 'message' => 'User berhasil ditambahkan.']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Gagal menambah user.']);
    }
    exit;
}

// --- DELETE: HAPUS USER ---
if ($method === 'DELETE') {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'] ?? null;

    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'ID tidak valid.']);
        exit;
    }

    // Cegah Hapus Diri Sendiri
    if ($id == $_SESSION['user_id']) {
        echo json_encode(['success' => false, 'message' => 'Anda tidak bisa menghapus akun sendiri.']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true, 'message' => 'User berhasil dihapus.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus user.']);
    }
    exit;
}
?>