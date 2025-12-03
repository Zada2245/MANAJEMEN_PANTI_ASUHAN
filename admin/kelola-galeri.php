<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php");
}

include '../koneksi.php'; 

// --- LOGIKA SIMPAN FOTO (UPLOAD) ---
if(isset($_POST['upload'])){
    $judul = $_POST['judul'];
    $tgl   = date('Y-m-d');

    // Ambil Data File
    $nama_file = $_FILES['gambar']['name'];
    $tmp_file  = $_FILES['gambar']['tmp_name'];
    $ukuran    = $_FILES['gambar']['size'];

    // Cek apakah ada file yang diupload
    if($nama_file != "") {
        // Beri nama unik (Timestamp + Nama Asli) agar tidak bentrok
        $nama_baru = time() . "_" . $nama_file;
        
        // Lokasi Simpan (Ke folder uploads di luar folder admin)
        $path_upload = "../uploads/" . $nama_baru;
        $path_db     = "uploads/" . $nama_baru; // Ini yang masuk database

        // Proses Upload
        if(move_uploaded_file($tmp_file, $path_upload)){
            // Simpan ke Database
            $query = "INSERT INTO galeri (judul, link_gambar, tanggal) VALUES ('$judul', '$path_db', '$tgl')";
            $simpan = mysqli_query($koneksi, $query);

            if($simpan){
                echo "<script>alert('Foto Berhasil Diupload!'); window.location='kelola-galeri.php';</script>";
            }
        } else {
            echo "<script>alert('Gagal mengupload file ke folder tujuan!');</script>";
        }
    } else {
        echo "<script>alert('Harap pilih file gambar!');</script>";
    }
}

// --- LOGIKA HAPUS FOTO ---
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];

    // 1. Ambil nama file dari database dulu
    $q_cek = mysqli_query($koneksi, "SELECT link_gambar FROM galeri WHERE id='$id'");
    $data_cek = mysqli_fetch_assoc($q_cek);
    $file_path = "../" . $data_cek['link_gambar']; // Tambah ../ karena kita di admin

    // 2. Hapus file fisik jika ada
    if(file_exists($file_path)){
        unlink($file_path);
    }

    // 3. Hapus data di database
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
    
    <style>
        .gallery-upload-card {
            border-radius: 15px;
            background: #fff;
            border: 1px dashed #fcb900; /* Border putus-putus kuning */
        }
        .img-preview-card {
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.2s;
        }
        .img-preview-card:hover {
            transform: scale(1.02);
        }
    </style>
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
                <div class="card shadow-sm p-4 mb-4 gallery-upload-card">
                    <h5 class="fw-bold mb-3 text-center"><i class="fas fa-cloud-upload-alt text-warning fa-2x mb-2"></i><br>Upload Foto Baru</h5>
                    
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="small fw-bold text-muted">Judul / Caption</label>
                            <input type="text" name="judul" class="form-control bg-light" placeholder="Kegiatan..." required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="small fw-bold text-muted">Pilih File Gambar</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*" required>
                            <div class="form-text text-muted small">*Format: JPG, PNG, JPEG</div>
                        </div>

                        <button type="submit" name="upload" class="btn btn-warning w-100 fw-bold text-white shadow-sm">
                            <i class="fas fa-upload me-2"></i> Upload Sekarang
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card border-0 shadow-sm p-3" style="border-radius: 15px;">
                    <h5 class="fw-bold mb-3 ps-2 border-start border-4 border-warning">&nbsp; Koleksi Foto</h5>
                    
                    <div class="row g-3">
                        <?php 
                        $galeri = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC");
                        
                        if(mysqli_num_rows($galeri) > 0) {
                            while($g = mysqli_fetch_assoc($galeri)) { 
                        ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="card border-0 shadow-sm h-100 img-preview-card">
                                <div style="height: 150px; overflow: hidden; position: relative;">
                                    <img src="../<?php echo $g['link_gambar']; ?>" class="w-100 h-100" style="object-fit: cover;">
                                    
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <a href="kelola-galeri.php?hapus=<?php echo $g['id']; ?>" class="btn btn-sm btn-danger shadow" onclick="return confirm('Yakin ingin menghapus foto ini? File fisik juga akan dihapus.')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body p-2 text-center bg-light">
                                    <small class="fw-bold d-block text-truncate text-dark"><?php echo $g['judul']; ?></small>
                                    <small class="text-muted" style="font-size: 0.7rem;"><?php echo date('d M Y', strtotime($g['tanggal'])); ?></small>
                                </div>
                            </div>
                        </div>
                        <?php 
                            } 
                        } else {
                            echo '<div class="text-center py-5 text-muted">Belum ada foto di galeri.</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>