<?php
// api/transaction.php
header('Content-Type: application/json');
require_once '../config/database.php';
session_start();

// 1. Cek Login & Role
if (!isset($_SESSION['logged_in'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Anda harus login.']);
    exit;
}

$allowed_roles = ['pj_gudang', 'admin'];
if (!in_array($_SESSION['role'], $allowed_roles)) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Akses ditolak.']);
    exit;
}

// 2. Ambil Input dari $_POST dan $_FILES
$user_id = $_SESSION['user_id'];
$branch = $_SESSION['branch']; // Otomatis pakai cabang user yang login
$date = $_POST['date'] ?? null;
$type = $_POST['type'] ?? null;
$category = $_POST['category'] ?? null;
$amount = $_POST['amount'] ?? 0;
$description = $_POST['description'] ?? '';
$is_zakat = isset($_POST['is_zakat']) ? 1 : 0;

// Validasi Dasar
if (!$date || !$type || !$category || !$amount || !$description) {
    echo json_encode(['success' => false, 'message' => 'Semua field wajib diisi!']);
    exit;
}

try {
    // 3. Handle File Upload
    $proof_file_name = null;

    if (isset($_FILES['proof_file']) && $_FILES['proof_file']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../assets/uploads/';

        // Buat folder jika belum ada
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_tmp = $_FILES['proof_file']['tmp_name'];
        $file_ext = strtolower(pathinfo($_FILES['proof_file']['name'], PATHINFO_EXTENSION));

        // Validasi Ekstensi
        $allowed_ext = ['jpg', 'jpeg', 'png', 'pdf'];
        if (!in_array($file_ext, $allowed_ext)) {
            echo json_encode(['success' => false, 'message' => 'Format file harus JPG, PNG, atau PDF.']);
            exit;
        }

        // Generate Nama Unik (Biar tidak bentrok)
        // Format: proof_USERID_TIMESTAMP.ext
        $proof_file_name = 'proof_' . $user_id . '_' . time() . '.' . $file_ext;
        $destination = $upload_dir . $proof_file_name;

        if (!move_uploaded_file($file_tmp, $destination)) {
            echo json_encode(['success' => false, 'message' => 'Gagal mengupload gambar.']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Bukti transaksi wajib diupload!']);
        exit;
    }

    // 4. Insert Transaksi ke Database
    $pdo->beginTransaction();

    $sql = "INSERT INTO transactions (user_id, branch, date, type, category, description, amount, is_zakat, proof_file, status) 
            VALUES (:uid, :branch, :date, :type, :cat, :desc, :amt, :zakat, :proof, 'pending')";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'uid' => $user_id,
        'branch' => $branch,
        'date' => $date,
        'type' => $type,
        'cat' => $category,
        'desc' => $description,
        'amt' => $amount,
        'zakat' => $is_zakat,
        'proof' => $proof_file_name
    ]);

    // 5. Catat Audit Log
    $log_sql = "INSERT INTO audit_logs (user_id, action, details, ip_address) VALUES (?, ?, ?, ?)";
    $log_stmt = $pdo->prepare($log_sql);
    $log_details = "Input Transaksi: $type Rp " . number_format($amount) . " ($category)";
    $log_stmt->execute([$user_id, 'INPUT_TRANSAKSI', $log_details, $_SERVER['REMOTE_ADDR']]);

    $pdo->commit();

    echo json_encode(['success' => true, 'message' => 'Transaksi berhasil disimpan']);

} catch (Exception $e) {
    $pdo->rollBack();
    error_log($e->getMessage()); // Log error server
    echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan server: ' . $e->getMessage()]);
}
?>