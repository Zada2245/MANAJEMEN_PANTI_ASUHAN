<?php 
include '../koneksi.php'; 

// Simpan Foto Baru
if(isset($_POST['upload'])){
    $judul = $_POST['judul'];
    $link  = $_POST['link'];
    $tgl   = date('Y-m-d');
    mysqli_query($koneksi, "INSERT INTO galeri (judul, link_gambar, tanggal) VALUES ('$judul', '$link', '$tgl')");
    echo "<script>window.location='kelola-galeri.php';</script>";
}

// Hapus Foto
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM galeri WHERE id = '$id'");
    echo "<script>window.location='kelola-galeri.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Galeri - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <div class="top-bar">
            <h4 class="fw-bold mb-0">Gallery Manager</h4>
            <div class="user-profile d-flex align-items-center gap-2">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin">
                <small class="d-none d-md-block fw-bold">Ayu Alizza</small>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 mb-4" style="border-radius: 15px;">
                    <h5 class="fw-bold mb-3">Tambah Foto</h5>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="small fw-bold text-muted">Judul Foto</label>
                            <input type="text" name="judul" class="form-control bg-light" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted">Link Gambar (URL)</label>
                            <input type="text" name="link" class="form-control bg-light" placeholder="https://..." required>
                        </div>
                        <button type="submit" name="upload" class="btn btn-warning w-100 fw-bold text-white">Upload</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row g-3">
                    <?php 
                    $galeri = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC");
                    while($g = mysqli_fetch_assoc($galeri)) { 
                    ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius: 12px;">
                            <div style="height: 150px; overflow: hidden;">
                                <img src="<?php echo $g['link_gambar']; ?>" class="w-100 h-100" style="object-fit: cover;">
                            </div>
                            <div class="card-body p-2 text-center">
                                <small class="fw-bold d-block text-truncate"><?php echo $g['judul']; ?></small>
                                <a href="kelola-galeri.php?hapus=<?php echo $g['id']; ?>" class="btn btn-xs btn-outline-danger mt-2" onclick="return confirm('Hapus foto ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>