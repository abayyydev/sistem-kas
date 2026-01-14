<?php
// api/dashboard.php
header('Content-Type: application/json');
require_once '../config/database.php';
session_start();

// 1. Cek Login
if (!isset($_SESSION['logged_in'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$role = $_SESSION['role'];
$user_branch = $_SESSION['branch'];
$user_id = $_SESSION['user_id'];

try {
    // 2. Base Query
    // Kita hitung saldo berdasarkan transaksi yang sudah diaudit (verified) agar akurat,
    // atau 'pending' juga ikut dihitung tergantung kebijakan (di sini kita hitung semua biar real-time).
    $query = "SELECT 
                SUM(CASE WHEN type = 'in' THEN amount ELSE 0 END) as total_in,
                SUM(CASE WHEN type = 'out' THEN amount ELSE 0 END) as total_out,
                SUM(CASE WHEN type = 'out' AND is_zakat = 1 THEN amount ELSE 0 END) as total_zakat
              FROM transactions WHERE 1=1";

    $params = [];

    // 3. Filter Berdasarkan Role
    // Jika PJ Gudang, HANYA tampilkan data cabang dia sendiri
    if ($role == 'pj_gudang') {
        $query .= " AND branch = :branch";
        $params['branch'] = $user_branch;
    }
    // Jika TUP/Admin/Pimpinan, tampilkan SEMUA (Global) atau bisa ditambah filter request GET
    // (Kode di atas default-nya menampilkan akumulasi nasional untuk level manajemen)

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $result = $stmt->fetch();

    // 4. Hitung Saldo Akhir
    $saldo_akhir = $result['total_in'] - $result['total_out'];

    echo json_encode([
        'success' => true,
        'data' => [
            'saldo' => (float) $saldo_akhir,
            'pemasukan' => (float) $result['total_in'],
            'pengeluaran' => (float) $result['total_out'],
            'potensi_zakat' => (float) $result['total_zakat']
        ]
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>