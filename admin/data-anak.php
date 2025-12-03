<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php");
}

include '../koneksi.php'; 

// --- LOGIKA PHP ---

// 1. Simpan Data Anak (DENGAN UPLOAD FOTO)
if(isset($_POST['simpan'])){
    $nama       = $_POST['nama'];
    $tgl_lahir  = $_POST['tgl_lahir'];
    $jk         = $_POST['jk'];
    $jenjang    = $_POST['jenjang'];
    $sekolah    = $_POST['sekolah'];
    $kelas      = $_POST['kelas'];
    $kesehatan  = $_POST['kesehatan'];
    $hobi       = $_POST['hobi'];
    $catatan    = $_POST['catatan'];
    $tgl_masuk  = date('Y-m-d');

    // LOGIKA UPLOAD FOTO
    // Ambil info file
    $nama_file = $_FILES['foto']['name'];
    $tmp_file  = $_FILES['foto']['tmp_name'];
    
    // Beri nama unik agar tidak bentrok (pakai timestamp)
    $nama_baru = time() . "_" . $nama_file;
    
    // Tentukan lokasi folder (Folder 'uploads' ada di luar folder 'admin')
    $path_upload = "../uploads/" . $nama_baru;
    
    // Path yang akan disimpan di database (untuk dipanggil di halaman depan)
    $path_db = "uploads/" . $nama_baru;

    // Proses Upload
    if(move_uploaded_file($tmp_file, $path_upload)){
        // Jika upload berhasil, simpan ke DB
        $query = "INSERT INTO anak_asuh (nama, tgl_lahir, jenis_kelamin, pendidikan_jenjang, nama_sekolah, kelas, status_kesehatan, hobi, catatan_perkembangan, foto, tanggal_masuk) 
                  VALUES ('$nama', '$tgl_lahir', '$jk', '$jenjang', '$sekolah', '$kelas', '$kesehatan', '$hobi', '$catatan', '$path_db', '$tgl_masuk')";
        
        mysqli_query($koneksi, $query);
        echo "<script>alert('Data Anak & Foto Berhasil Disimpan!'); window.location='data-anak.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupload foto!');</script>";
    }
}

// 2. Hapus Data
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    
    // (Opsional) Hapus file fisik foto lama jika mau lebih bersih
    $q_cek = mysqli_query($koneksi, "SELECT foto FROM anak_asuh WHERE id='$id'");
    $d_cek = mysqli_fetch_assoc($q_cek);
    if(file_exists("../" . $d_cek['foto'])){
        unlink("../" . $d_cek['foto']);
    }

    mysqli_query($koneksi, "DELETE FROM anak_asuh WHERE id = '$id'");
    echo "<script>window.location='data-anak.php';</script>";
}

// 3. Ambil Data
$data_anak = mysqli_query($koneksi, "SELECT * FROM anak_asuh ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Anak Asuh - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .form-section-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: #fcb900;
            text-transform: uppercase;
            border-bottom: 2px solid #f1f3f5;
            padding-bottom: 5px;
            margin-bottom: 15px;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <div class="top-bar">
            <h4 class="fw-bold mb-0">Data Anak Asuh</h4>
            <div class="user-profile d-flex align-items-center gap-2">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin">
                <small class="d-none d-md-block fw-bold">Ayu Alizza</small>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 mb-4">
                <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="fw-bold mb-0"><i class="fas fa-user-plus text-warning me-2"></i> Input Data Baru</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            
                            <div class="form-section-title">1. Identitas Anak</div>
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control bg-light" required>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="small fw-bold text-muted">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="form-control bg-light" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="small fw-bold text-muted">Jenis Kelamin</label>
                                    <select name="jk" class="form-select bg-light">
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">Upload Foto Anak</label>
                                <input type="file" name="foto" class="form-control" accept="image/*" required>
                                <div class="form-text text-muted small">*Format: JPG, PNG, JPEG</div>
                            </div>

                            <div class="form-section-title">2. Pendidikan</div>
                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label class="small fw-bold text-muted">Jenjang</label>
                                    <select name="jenjang" class="form-select bg-light">
                                        <option value="TK">TK</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA/SMK">SMA/SMK</option>
                                    </select>
                                </div>
                                <div class="col-8 mb-3">
                                    <label class="small fw-bold text-muted">Nama Sekolah</label>
                                    <input type="text" name="sekolah" class="form-control bg-light" placeholder="Nama Sekolah">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="small fw-bold text-muted">Kelas Saat Ini</label>
                                    <input type="text" name="kelas" class="form-control bg-light" placeholder="Contoh: 5 SD">
                                </div>
                            </div>

                            <div class="form-section-title">3. Perkembangan</div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="small fw-bold text-muted">Kesehatan</label>
                                    <input type="text" name="kesehatan" class="form-control bg-light" placeholder="Cth: Sehat / Asma">
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="small fw-bold text-muted">Hobi/Minat</label>
                                    <input type="text" name="hobi" class="form-control bg-light" placeholder="Cth: Melukis">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">Catatan Perkembangan</label>
                                <textarea name="catatan" class="form-control bg-light" rows="3" placeholder="Catatan perilaku, prestasi, atau kebutuhan khusus..."></textarea>
                            </div>

                            <button type="submit" name="simpan" class="btn btn-warning w-100 fw-bold text-white mt-3">Simpan Data Anak</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                    <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0 text-secondary"><i class="fas fa-list text-warning me-2"></i> Daftar Anak Asuh</h5>
                        <span class="badge bg-light text-dark border"><?php echo mysqli_num_rows($data_anak); ?> Anak</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-3">Profil</th>
                                    <th>Pendidikan</th>
                                    <th>Kesehatan & Catatan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_assoc($data_anak)) { 
                                    // Hitung Umur
                                    $bday = new DateTime($row['tgl_lahir']);
                                    $today = new DateTime('today');
                                    $umur = $bday->diff($today)->y;
                                ?>
                                <tr>
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center">
                                            <img src="../<?php echo $row['foto']; ?>" class="rounded-circle me-3 shadow-sm" style="width: 45px; height: 45px; object-fit: cover;">
                                            <div>
                                                <span class="fw-bold d-block text-dark"><?php echo $row['nama']; ?></span>
                                                <small class="text-muted" style="font-size: 0.75rem;">
                                                    <?php echo $row['jenis_kelamin']; ?> | <strong><?php echo $umur; ?> Thn</strong>
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-dark bg-opacity-10 border border-info mb-1"><?php echo $row['pendidikan_jenjang']; ?></span>
                                        <small class="d-block text-muted" style="font-size: 0.75rem;"><?php echo $row['nama_sekolah']; ?></small>
                                        <small class="d-block text-muted" style="font-size: 0.75rem;">Kelas: <?php echo $row['kelas']; ?></small>
                                    </td>
                                    <td>
                                        <small class="d-block text-success fw-bold"><i class="fas fa-heartbeat me-1"></i> <?php echo $row['status_kesehatan']; ?></small>
                                        <small class="d-block text-muted text-truncate" style="max-width: 150px;" title="<?php echo $row['catatan_perkembangan']; ?>">
                                            <?php echo $row['catatan_perkembangan']; ?>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <a href="data-anak.php?hapus=<?php echo $row['id']; ?>" class="btn btn-sm btn-light border text-danger" onclick="return confirm('Hapus data anak ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                                
                                <?php if(mysqli_num_rows($data_anak) == 0): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Belum ada data anak asuh.</td>
                                </tr>
                                <?php endif; ?>
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