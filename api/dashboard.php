<?php
header('Content-Type: application/json');
require_once '../config/database.php';
session_start();

if (!isset($_SESSION['logged_in'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$role = $_SESSION['role'];
$user_branch = $_SESSION['branch'];
$user_id = $_SESSION['user_id'];

// Ambil filter tanggal dari GET request
$start_date = $_GET['start_date'] ?? null;
$end_date = $_GET['end_date'] ?? null;

try {
    $date_filter = "";
    $params = [];

    // Jika ada filter tanggal, gunakan BETWEEN
    if ($start_date && $end_date) {
        $date_filter = " AND date BETWEEN :start AND :end";
        $params['start'] = $start_date;
        $params['end'] = $end_date;
    }

    // 1. Summary Utama (Hanya data yang verified)
    $query_base = "SELECT 
                    SUM(CASE WHEN type = 'in' THEN amount ELSE 0 END) as total_in,
                    SUM(CASE WHEN type = 'out' THEN amount ELSE 0 END) as total_out,
                    SUM(CASE WHEN type = 'out' AND is_zakat = 1 THEN amount ELSE 0 END) as total_zakat
                  FROM transactions WHERE status = 'verified'" . $date_filter;

    if ($role == 'pj_gudang') {
        $query_base .= " AND branch = :branch";
        $params['branch'] = $user_branch;
    }

    $stmt = $pdo->prepare($query_base);
    $stmt->execute($params);
    $summary = $stmt->fetch();

    $data = [
        'saldo' => (float) ($summary['total_in'] - $summary['total_out']),
        'pemasukan' => (float) $summary['total_in'],
        'pengeluaran' => (float) $summary['total_out'],
        'potensi_zakat' => (float) $summary['total_zakat']
    ];

    // 2. Data Statistik Khusus Admin/Pimpinan
    if ($role == 'admin' || $role == 'pimpinan') {
        // Bar Chart: Pengeluaran Per Cabang
        $q_branch = "SELECT branch, SUM(amount) as total_out FROM transactions 
                     WHERE type = 'out' AND status = 'verified' $date_filter 
                     GROUP BY branch ORDER BY total_out DESC";
        $stmt_b = $pdo->prepare($q_branch);
        $stmt_b->execute($params);
        $data['branch_stats'] = $stmt_b->fetchAll(PDO::FETCH_ASSOC);

        // Doughnut Chart: Top Kategori
        $q_cat = "SELECT category, SUM(amount) as total FROM transactions 
                  WHERE type = 'out' AND status = 'verified' $date_filter 
                  GROUP BY category ORDER BY total DESC LIMIT 5";
        $stmt_c = $pdo->prepare($q_cat);
        $stmt_c->execute($params);
        $data['top_categories'] = $stmt_c->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Aktivitas Terakhir (Tetap munculkan 10 terakhir tanpa terpengaruh filter tanggal agar dashboard tidak kosong)
    $q_recent = "SELECT t.*, u.full_name FROM transactions t JOIN users u ON t.user_id = u.id";
    $p_recent = [];
    if ($role == 'pj_gudang') {
        $q_recent .= " WHERE t.branch = :branch";
        $p_recent['branch'] = $user_branch;
    }
    $q_recent .= " ORDER BY t.created_at DESC LIMIT 10";
    $stmt_r = $pdo->prepare($q_recent);
    $stmt_r->execute($p_recent);
    $data['recent_transactions'] = $stmt_r->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'data' => $data]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}