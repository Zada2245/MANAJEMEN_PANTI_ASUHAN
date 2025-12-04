<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php");
}

include '../koneksi.php'; 

// --- LOGIKA PHP ---

// 1. Simpan Berita (DENGAN UPLOAD FOTO)
if(isset($_POST['simpan'])){
    $judul  = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi    = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $tgl    = date('Y-m-d');

    // LOGIKA UPLOAD
    $nama_file = $_FILES['gambar']['name'];
    $tmp_file  = $_FILES['gambar']['tmp_name'];
    
    // Cek ada gambar atau tidak
    if($nama_file != "") {
        $nama_baru   = time() . "_" . $nama_file; // Nama unik
        $path_upload = "../uploads/" . $nama_baru; // Ke folder fisik
        $path_db     = "uploads/" . $nama_baru;    // Ke database

        if(move_uploaded_file($tmp_file, $path_upload)){
            $query = "INSERT INTO berita (judul, isi, gambar, tanggal) VALUES ('$judul', '$isi', '$path_db', '$tgl')";
            $simpan = mysqli_query($koneksi, $query);
            
            if($simpan){
                echo "<script>alert('Berita Berhasil Terbit!'); window.location='input-berita.php';</script>";
            }
        } else {
            echo "<script>alert('Gagal upload gambar!');</script>";
        }
    } else {
        echo "<script>alert('Harap pilih gambar cover berita!');</script>";
    }
}

// 2. Hapus Berita
if(isset($_GET['hapus'])){
    $id_hapus = $_GET['hapus'];

    // Hapus file fisik gambar lama
    $q_cek = mysqli_query($koneksi, "SELECT gambar FROM berita WHERE id='$id_hapus'");
    $d_cek = mysqli_fetch_assoc($q_cek);
    
    // Cek apakah gambar lokal (bukan url internet)
    if(file_exists("../" . $d_cek['gambar'])){
        unlink("../" . $d_cek['gambar']);
    }

    mysqli_query($koneksi, "DELETE FROM berita WHERE id = '$id_hapus'");
    echo "<script>window.location='input-berita.php';</script>";
}

// 3. Ambil Data Berita
$query_berita = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita - Admin Charity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
        .news-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            border: none;
            overflow: hidden;
        }
        .form-control {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            padding: 12px 15px;
        }
        .form-control:focus {
            background-color: #fff;
            box-shadow: none;
            border-color: #fcb900;
        }
        .news-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #edf2f7;
            color: #6c757d;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        
        <div class="top-bar">
            <h4 class="fw-bold mb-0">News & Blog</h4>
            <div class="user-profile d-flex align-items-center gap-2">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin">
                <div class="d-none d-md-block">
                    <small class="d-block fw-bold">Ayu Alizza</small>
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-lg-4 mb-4">
                <div class="news-card h-100">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="fw-bold mb-0"><i class="fas fa-pen-nib text-warning me-2"></i> Tulis Berita</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Judul Artikel</label>
                                <input type="text" name="judul" class="form-control" placeholder="Masukkan judul menarik..." required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Cover Berita</label>
                                <input type="file" name="gambar" class="form-control" accept="image/*" required>
                                <div class="form-text text-muted small">*Format: JPG, PNG, JPEG</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">Isi Konten</label>
                                <textarea name="isi" class="form-control" rows="8" placeholder="Tulis cerita lengkap di sini..." required></textarea>
                            </div>

                            <button type="submit" name="simpan" class="btn btn-warning w-100 py-2 fw-bold text-white shadow-sm">
                                <i class="fas fa-paper-plane me-2"></i> Terbitkan Berita
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="news-card h-100">
                    <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Daftar Berita Terbit</h5>
                        <span class="badge bg-light text-dark border"><?php echo mysqli_num_rows($query_berita); ?> Artikel</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th width="15%">Cover</th>
                                    <th width="40%">Judul & Tanggal</th>
                                    <th width="25%">Cuplikan</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                while($row = mysqli_fetch_assoc($query_berita)) { 
                                ?>
                                <tr>
                                    <td class="text-center text-muted"><?php echo $no++; ?></td>
                                    <td>
                                        <?php 
                                            // Cek apakah gambar lokal atau link url lama
                                            $img_src = $row['gambar'];
                                            if(!filter_var($img_src, FILTER_VALIDATE_URL)){
                                                $img_src = "../" . $img_src; 
                                            }
                                        ?>
                                        <img src="<?php echo $img_src; ?>" class="news-thumbnail shadow-sm" alt="Thumb" onerror="this.src='https://placehold.co/60x60?text=No+Img'">
                                    </td>
                                    <td>
                                        <span class="d-block fw-bold text-dark text-truncate" style="max-width: 200px;"><?php echo $row['judul']; ?></span>
                                        <small class="text-muted"><i class="far fa-calendar me-1"></i> <?php echo date('d M Y', strtotime($row['tanggal'])); ?></small>
                                    </td>
                                    <td>
                                        <span class="d-block text-muted small text-truncate" style="max-width: 150px;">
                                            <?php echo substr(strip_tags($row['isi']), 0, 50); ?>...
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="input-berita.php?hapus=<?php echo $row['id']; ?>" class="btn btn-sm btn-light text-danger border" onclick="return confirm('Yakin ingin menghapus berita ini?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>