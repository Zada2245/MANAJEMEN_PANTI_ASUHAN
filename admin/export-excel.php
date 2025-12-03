<?php

include '../koneksi.php';

// Fungsi header agar browser mendownload file ini sebagai Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Donasi_".date('Y-m-d').".xls");

// --- LOGIKA FILTER (Sama seperti di data-donasi.php) ---
$where_clause = "WHERE 1=1"; 
$filter_bank = isset($_GET['bank']) ? $_GET['bank'] : '';
if($filter_bank != ''){ $where_clause .= " AND bank = '$filter_bank'"; }

$search_q = isset($_GET['q']) ? $_GET['q'] : '';
if($search_q != ''){ $where_clause .= " AND nama_donatur LIKE '%$search_q%'"; }

$data = mysqli_query($koneksi, "SELECT * FROM donasi $where_clause ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid black; padding: 8px; }
        th { background-color: #fcb900; }
    </style>
</head>
<body>
    <center>
        <h2>LAPORAN DONASI MASUK</h2>
        <h3>CHARITY HOPE FOUNDATION</h3>
        <p>Per Tanggal: <?php echo date('d-m-Y'); ?></p>
    </center>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Donatur</th>
                <th>Email</th>
                <th>Bank</th>
                <th>Nominal</th>
                <th>Tanggal</th>
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
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['nama_donatur']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['bank']; ?></td>
                <td style="text-align: right;">Rp <?php echo $row['nominal']; ?></td>
                <td><?php echo $row['tanggal']; ?></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="4" style="text-align: center; font-weight: bold;">TOTAL PEMASUKAN</td>
                <td style="text-align: right; font-weight: bold;">Rp <?php echo $total; ?></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>