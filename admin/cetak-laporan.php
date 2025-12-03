<?php
session_start();
if($_SESSION['status'] != "login"){ header("location:login.php"); }
include '../koneksi.php';

// --- PERBAIKAN JAM (SET ZONA WAKTU KE WIB) ---
date_default_timezone_set('Asia/Jakarta'); 
// ---------------------------------------------

// --- LOGIKA FILTER ---
$where_clause = "WHERE 1=1"; 
$filter_bank = isset($_GET['bank']) ? $_GET['bank'] : '';
if($filter_bank != ''){ $where_clause .= " AND bank = '$filter_bank'"; }

$search_q = isset($_GET['q']) ? $_GET['q'] : '';
if($search_q != ''){ $where_clause .= " AND nama_donatur LIKE '%$search_q%'"; }

$data = mysqli_query($koneksi, "SELECT * FROM donasi $where_clause ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Cetak Laporan Donasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .logo { font-size: 24px; font-weight: bold; color: #fcb900; text-shadow: 1px 1px #333; }
        .sub-logo { color: #333; font-weight: bold; }
        .table thead th { background-color: #f0f0f0 !important; -webkit-print-color-adjust: exact; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <div class="logo">CHARITY HOPE FOUNDATION</div>
        <div class="sub-logo">LAPORAN REKAPITULASI DONASI</div>
        
        <small>Dicetak pada: <?php echo date('d F Y, H:i:s'); ?> WIB | Oleh: <?php echo $_SESSION['username']; ?></small>
    </div>

    <?php if($filter_bank != ''): ?>
        <p><strong>Filter Bank:</strong> <?php echo $filter_bank; ?></p>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama Donatur</th>
                <th width="20%">Email</th>
                <th width="10%">Bank</th>
                <th width="20%">Tanggal</th>
                <th width="20%">Nominal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $total = 0;
            while($row = mysqli_fetch_assoc($data)){
                $total += $row['nominal'];
            ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td><?php echo $row['nama_donatur']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td class="text-center"><?php echo $row['bank']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                <td class="text-end fw-bold"><?php echo number_format($row['nominal']); ?></td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr class="table-dark text-white">
                <td colspan="5" class="text-end fw-bold">TOTAL PEMASUKAN</td>
                <td class="text-end fw-bold">Rp <?php echo number_format($total); ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="mt-5" style="float: right; text-align: center; width: 200px;">
        <p>Yogyakarta, <?php echo date('d F Y'); ?></p>
        <br><br><br>
        <p class="fw-bold fw-underline">( Ayu Alizza )</p>
        <p>Finance Manager</p>
    </div>

    <div class="fixed-bottom p-3 no-print">
        <a href="data-donasi.php" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

</body>
</html>