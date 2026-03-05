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

// Hanya TUP dan Admin yang boleh audit
$allowed_roles = ['tup', 'admin'];
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

// --- HANDLE POST (VERIFIKASI / TOLAK) ---
if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $trx_id = $input['id'] ?? null;
    $action = $input['action'] ?? null; // 'verify' atau 'reject'
    $reason = $input['reason'] ?? '';   // Alasan jika ditolak

    if (!$trx_id || !in_array($action, ['verify', 'reject'])) {
        echo json_encode(['success' => false, 'message' => 'Data tidak valid.']);
        exit;
    }

    try {
        $pdo->beginTransaction();

        $new_status = ($action === 'verify') ? 'verified' : 'rejected';
        $auditor_id = $_SESSION['user_id'];
        $now = date('Y-m-d H:i:s');

        // 1. Update Status Transaksi
        $sql = "UPDATE transactions 
                SET status = :status, 
                    verified_by = :auditor, 
                    verified_at = :waktu 
                WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'status' => $new_status,
            'auditor' => $auditor_id,
            'waktu' => $now,
            'id' => $trx_id
        ]);

        // 2. Catat Audit Log
        $log_action = ($action === 'verify') ? 'VERIFY_DATA' : 'REJECT_DATA';
        $log_desc = "Audit Transaksi ID #$trx_id menjadi $new_status. " . ($reason ? "Alasan: $reason" : "");
        
        $log_sql = "INSERT INTO audit_logs (user_id, action, details, ip_address) VALUES (?, ?, ?, ?)";
        $log_stmt = $pdo->prepare($log_sql);
        $log_stmt->execute([$auditor_id, $log_action, $log_desc, $_SERVER['REMOTE_ADDR']]);

        $pdo->commit();
        echo json_encode(['success' => true, 'message' => "Data berhasil di-" . $action]);

    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}
?>