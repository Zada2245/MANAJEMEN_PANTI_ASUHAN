<?php 
// PASTIKAN ADA SESSION START DI PALING ATAS
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php");
}

include '../koneksi.php'; 

// --- LOGIKA FILTER & PENCARIAN ---
$where_clause = "WHERE 1=1"; // Default kondisi (semua data)

// 1. Filter Bank
$filter_bank = isset($_GET['bank']) ? $_GET['bank'] : '';
if($filter_bank != ''){
    $where_clause .= " AND bank = '$filter_bank'";
}

// 2. Pencarian Nama
$search_q = isset($_GET['q']) ? $_GET['q'] : '';
if($search_q != ''){
    $where_clause .= " AND nama_donatur LIKE '%$search_q%'";
}

// Query Data Utama
$query_str = "SELECT * FROM donasi $where_clause ORDER BY id DESC";
$data = mysqli_query($koneksi, $query_str);

// Hitung Total Uang (Sesuai Filter)
$query_sum = mysqli_query($koneksi, "SELECT SUM(nominal) as total, COUNT(*) as jumlah FROM donasi $where_clause");
$summary = mysqli_fetch_assoc($query_sum);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Donasi - Admin Charity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    
    <style>
        .filter-card {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        }
        .table-card {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            border: none;
        }
        .table thead th {
            background-color: #f8f9fa;
            color: #6c757d;
            font-weight: 600;
            border-bottom: 2px solid #edf2f7;
            padding: 15px;
        }
        .table tbody td {
            vertical-align: middle;
            padding: 15px;
            border-bottom: 1px solid #f1f3f5;
            color: #495057;
        }
        .avatar-initial {
            width: 35px;
            height: 35px;
            background-color: #e9ecef;
            color: #495057;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.85rem;
            margin-right: 12px;
        }
    </style>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        
        <div class="top-bar">
            <h4 class="fw-bold mb-0">Manajemen Donasi</h4>
            <div class="d-flex align-items-center">
                <div class="user-profile d-flex align-items-center gap-2">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin">
                    <div class="d-none d-md-block">
                        <small class="d-block fw-bold">Ayu Alizza</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="stat-card d-flex align-items-center p-3">
                    <div class="stat-icon bg-icon-success me-3">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Total Masuk (Sesuai Filter)</small>
                        <h4 class="fw-bold mb-0">Rp <?php echo number_format($summary['total']); ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-card d-flex align-items-center p-3">
                    <div class="stat-icon bg-icon-primary me-3">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Jumlah Transaksi</small>
                        <h4 class="fw-bold mb-0"><?php echo number_format($summary['jumlah']); ?>x Transaksi</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter-card">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small text-muted fw-bold">Filter Bank</label>
                    <select name="bank" class="form-select border-0 bg-light">
                        <option value="">Semua Bank</option>
                        <option value="BCA" <?php if($filter_bank == 'BCA') echo 'selected'; ?>>BCA</option>
                        <option value="BRI" <?php if($filter_bank == 'BRI') echo 'selected'; ?>>BRI</option>
                        <option value="MANDIRI" <?php if($filter_bank == 'MANDIRI') echo 'selected'; ?>>MANDIRI</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label small text-muted fw-bold">Cari Donatur</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="q" class="form-control border-0 bg-light" placeholder="Ketik nama..." value="<?php echo $search_q; ?>">
                    </div>
                </div>

                <div class="col-md-5 text-md-end">
                    <button type="submit" class="btn btn-warning text-white fw-bold"><i class="fas fa-filter me-1"></i> Filter</button>
                    <a href="data-donasi.php" class="btn btn-light border ms-1"><i class="fas fa-sync-alt text-muted"></i></a>
                    
                    <div class="btn-group ms-2">
                        <button type="button" class="btn btn-success dropdown-toggle fw-bold" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-download me-1"></i> Export
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li>
                                <a class="dropdown-item py-2" href="export-excel.php?bank=<?php echo $filter_bank; ?>&q=<?php echo $search_q; ?>" target="_blank">
                                    <i class="fas fa-file-excel text-success me-2"></i> Ke Excel (.xls)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="cetak-laporan.php?bank=<?php echo $filter_bank; ?>&q=<?php echo $search_q; ?>" target="_blank">
                                    <i class="fas fa-file-pdf text-danger me-2"></i> Ke PDF / Cetak
                                </a>
                            </li>
                        </ul>
                    </div>
                    </div>
                
            </form>
        </div>

        <div class="card table-card">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="fw-bold mb-0">Riwayat Transaksi</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th width="25%">Nama Donatur</th>
                            <th width="15%">Metode</th>
                            <th width="20%">Nominal</th>
                            <th width="20%">Tanggal</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if(mysqli_num_rows($data) > 0){
                            while($row = mysqli_fetch_assoc($data)) { 
                                $inisial = strtoupper(substr($row['nama_donatur'], 0, 1));
                        ?>
                        <tr>
                            <td class="text-center text-muted"><?php echo $no++; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-initial"><?php echo $inisial; ?></div>
                                    <div>
                                        <span class="fw-bold text-dark d-block"><?php echo $row['nama_donatur']; ?></span>
                                        <small class="text-muted" style="font-size: 0.75rem;"><?php echo $row['email']; ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php 
                                    $badge_color = 'bg-secondary';
                                    if($row['bank'] == 'BCA') $badge_color = 'bg-primary';
                                    elseif($row['bank'] == 'BRI') $badge_color = 'bg-info';
                                    elseif($row['bank'] == 'MANDIRI') $badge_color = 'bg-warning text-dark';
                                ?>
                                <span class="badge <?php echo $badge_color; ?> rounded-pill px-3"><?php echo $row['bank']; ?></span>
                            </td>
                            <td class="fw-bold text-success">
                                Rp <?php echo number_format($row['nominal']); ?>
                            </td>
                            <td class="text-muted">
                                <i class="far fa-calendar-alt me-1"></i> <?php echo date('d M Y', strtotime($row['tanggal'])); ?>
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-light text-primary" title="Detail"><i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-light text-danger" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php 
                            } 
                        } else {
                        ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png" width="80" class="mb-3 opacity-50">
                                    <p class="mb-0">Tidak ada data donasi ditemukan.</p>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                <small class="text-muted">Menampilkan data terbaru</small>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link bg-warning border-warning" href="#">1</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>