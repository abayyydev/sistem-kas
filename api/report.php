<?php
// api/report.php
header('Content-Type: application/json');
require_once '../config/database.php';
session_start();

// 1. Cek Login
if (!isset($_SESSION['logged_in'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

// 2. Ambil Parameter Filter dari Frontend
$branch_filter = $_GET['branch'] ?? 'all'; // 'all', 'Jakarta', 'Bandung', dll
$month = $_GET['month'] ?? date('m');
$year = $_GET['year'] ?? date('Y');

try {
    // BASE QUERY: Ambil transaksi yang sudah diverifikasi (status='verified')
    // Jika ingin melihat semua termasuk pending, hapus kondisi status='verified'
    $sql = "SELECT t.*, u.full_name as pic_name 
            FROM transactions t
            JOIN users u ON t.user_id = u.id
            WHERE MONTH(t.date) = :month 
            AND YEAR(t.date) = :year
            AND t.status != 'rejected'"; // Tampilkan verified & pending (rejected tidak masuk laporan)

    $params = [
        'month' => $month,
        'year' => $year
    ];

    // Filter Cabang (Jika bukan 'all')
    // Jika user adalah PJ Gudang, paksa filter hanya ke cabangnya sendiri
    if ($_SESSION['role'] == 'pj_gudang') {
        $sql .= " AND t.branch = :branch";
        $params['branch'] = $_SESSION['branch'];
    } elseif ($branch_filter !== 'all') {
        $sql .= " AND t.branch = :branch";
        $params['branch'] = $branch_filter;
    }

    $sql .= " ORDER BY t.date DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $transactions = $stmt->fetchAll();

    // 3. Hitung Summary (Saldo Awal, Masuk, Keluar, Zakat)
    $total_in = 0;
    $total_out = 0;
    $total_zakat = 0;

    foreach ($transactions as $t) {
        if ($t['type'] === 'in') {
            $total_in += $t['amount'];
        } else {
            $total_out += $t['amount'];
            if ($t['is_zakat'] == 1) {
                $total_zakat += $t['amount'];
            }
        }
    }

    // Saldo Akhir (Berdasarkan filter ini saja)
    $balance = $total_in - $total_out;

    echo json_encode([
        'success' => true,
        'data' => [
                'summary' => [
                    'total_in' => $total_in,
                    'total_out' => $total_out,
                    'balance' => $balance,
                    'total_zakat' => $total_zakat
                ],
                'transactions' => $transactions
            ]
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>