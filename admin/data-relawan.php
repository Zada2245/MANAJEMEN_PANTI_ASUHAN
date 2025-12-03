<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php");
}

include '../koneksi.php'; 

// --- LOGIKA TERIMA / TOLAK ---

// 1. Jika Tombol Terima (Ceklis) ditekan
if(isset($_GET['terima'])){
    $id = $_GET['terima'];
    // Update status jadi Diterima
    mysqli_query($koneksi, "UPDATE relawan SET status='Diterima' WHERE id='$id'");
    echo "<script>alert('Relawan berhasil diterima!'); window.location='data-relawan.php';</script>";
}

// 2. Jika Tombol Tolak (Silang) ditekan
if(isset($_GET['tolak'])){
    $id = $_GET['tolak'];
    // Update status jadi Ditolak
    mysqli_query($koneksi, "UPDATE relawan SET status='Ditolak' WHERE id='$id'");
    echo "<script>alert('Relawan ditolak.'); window.location='data-relawan.php';</script>";
}

// Ambil Data Relawan
$data = mysqli_query($koneksi, "SELECT * FROM relawan ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Relawan - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        
        <div class="top-bar">
            <h4 class="fw-bold mb-0">Manajemen Relawan</h4>
            <div class="user-profile d-flex align-items-center gap-2">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin">
                <div class="d-none d-md-block">
                    <small class="d-block fw-bold">Ayu Alizza</small>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="fw-bold mb-0 text-secondary"><i class="fas fa-users text-warning me-2"></i> Daftar Pendaftar</h5>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Nama Relawan</th>
                            <th>Kontak</th>
                            <th>Peran Diminati</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3 text-secondary fw-bold" style="width:40px; height:40px;">
                                        <?php echo strtoupper(substr($row['nama_lengkap'], 0, 1)); ?>
                                    </div>
                                    <span class="fw-bold text-dark"><?php echo $row['nama_lengkap']; ?></span>
                                </div>
                            </td>
                            <td>
                                <small class="d-block text-muted"><i class="fas fa-envelope me-1"></i> <?php echo $row['email']; ?></small>
                                <small class="d-block text-muted"><i class="fas fa-phone me-1"></i> <?php echo $row['no_hp']; ?></small>
                            </td>
                            <td><span class="badge bg-info text-dark bg-opacity-10 border border-info"><?php echo $row['peran']; ?></span></td>
                            <td class="text-muted small"><?php echo date('d M Y', strtotime($row['tanggal_daftar'])); ?></td>
                            <td>
                                <?php 
                                    if($row['status'] == 'Diterima'){
                                        echo '<span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Diterima</span>';
                                    } elseif($row['status'] == 'Ditolak'){
                                        echo '<span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> Ditolak</span>';
                                    } else {
                                        echo '<span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i> Pending</span>';
                                    }
                                ?>
                            </td>
                            <td class="text-center">
                                <a href="data-relawan.php?terima=<?php echo $row['id']; ?>" class="btn btn-sm btn-light border text-success mx-1" title="Terima / Aktifkan" onclick="return confirm('Terima relawan ini menjadi anggota aktif?')">
                                    <i class="fas fa-check"></i>
                                </a>

                                <a href="data-relawan.php?tolak=<?php echo $row['id']; ?>" class="btn btn-sm btn-light border text-danger mx-1" title="Tolak Pendaftaran" onclick="return confirm('Apakah Anda yakin ingin menolak relawan ini?')">
                                    <i class="fas fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                        
                        <?php if(mysqli_num_rows($data) == 0): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada pendaftar relawan baru.</td>
                        </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>