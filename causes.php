<?php 
include 'header.php'; 

// 1. KONEKSI DATABASE
$koneksi = mysqli_connect("localhost", "root", "", "db_panti");

// 2. HITUNG JUMLAH RELAWAN SAAT INI
$query_hitung = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM relawan");
$data_hitung  = mysqli_fetch_assoc($query_hitung);
$jumlah_saat_ini = $data_hitung['total'];
$batas_kuota     = 20;

// Cek apakah penuh?
$is_penuh = ($jumlah_saat_ini >= $batas_kuota);

// 3. LOGIKA PENDAFTARAN
if(isset($_POST['daftar_relawan'])){
    // Cek ulang kuota (untuk mencegah race condition)
    $cek_lagi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM relawan"));
    
    if($cek_lagi['total'] >= $batas_kuota){
        // JIKA PENUH (Tolak)
        echo "<script>
            alert('MOHON MAAF! Pendaftaran baru saja ditutup karena kuota sudah terpenuhi (20 orang).');
            window.location='causes.php';
        </script>";
    } else {
        // JIKA MASIH ADA SLOT (Simpan)
        $nama   = $_POST['nama'];
        $email  = $_POST['email'];
        $hp     = $_POST['hp'];
        $peran  = $_POST['peran'];
        $tgl    = date('Y-m-d');
        $status = 'Pending'; // Default status menunggu persetujuan admin

        $simpan = mysqli_query($koneksi, "INSERT INTO relawan (nama_lengkap, email, no_hp, peran, tanggal_daftar, status) VALUES ('$nama', '$email', '$hp', '$peran', '$tgl', '$status')");

        if($simpan){
            echo "<script>
                alert('Selamat! Pendaftaran Anda berhasil dikirim. Tunggu konfirmasi dari Admin.');
                window.location='causes.php';
            </script>";
        }
    }
}
?>

<div class="page-header">
    <div class="container">
        <h1 class="fw-bold">Gabung Relawan</h1>
        <p class="mb-0 text-white-50">Home / <span class="text-warning">Volunteer</span></p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://loremflickr.com/600/400/teamwork,volunteer" class="img-fluid rounded shadow-sm mb-4 w-100" alt="Volunteer">
                
                <h2 class="fw-bold mb-3">Jadilah Bagian dari Kebaikan</h2>
                <p class="text-muted">
                    Kami membutuhkan tenaga, pikiran, dan kasih sayang Anda untuk membantu operasional panti. 
                    Saat ini kami membatasi jumlah relawan aktif demi efektivitas manajemen.
                </p>

                <div class="card border-0 shadow-sm p-3 mt-4 <?php echo $is_penuh ? 'bg-danger text-white' : 'bg-light'; ?>">
                    <h5 class="fw-bold mb-3"><i class="fas fa-chart-pie me-2"></i> Status Kuota Relawan</h5>
                    
                    <div class="d-flex justify-content-between fw-bold mb-1">
                        <span>Terisi: <?php echo $jumlah_saat_ini; ?> Orang</span>
                        <span>Batas: <?php echo $batas_kuota; ?> Orang</span>
                    </div>

                    <div class="progress" style="height: 15px; background: rgba(255,255,255,0.5);">
                        <?php 
                            $persen = ($jumlah_saat_ini / $batas_kuota) * 100;
                            $warna_bar = $is_penuh ? 'bg-white' : 'bg-warning'; 
                        ?>
                        <div class="progress-bar <?php echo $warna_bar; ?>" style="width: <?php echo $persen; ?>%"></div>
                    </div>

                    <small class="mt-2 d-block fst-italic">
                        <?php 
                        if($is_penuh){
                            echo "*Mohon maaf, pendaftaran saat ini DITUTUP sementara.";
                        } else {
                            echo "*Masih tersisa " . ($batas_kuota - $jumlah_saat_ini) . " slot lagi. Segera daftar!";
                        }
                        ?>
                    </small>
                </div>
            </div>

            <div class="col-lg-6 ps-lg-5">
                <div class="card shadow border-0 p-4">
                    
                    <?php if($is_penuh): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-user-slash text-danger" style="font-size: 4rem;"></i>
                            <h3 class="fw-bold mt-3 text-danger">Pendaftaran Ditutup</h3>
                            <p class="text-muted">Kuota relawan telah mencapai batas maksimal (20 orang).<br>Silakan cek kembali di periode berikutnya.</p>
                            <button class="btn btn-secondary w-100 py-3 mt-2" disabled>Formulir Tidak Tersedia</button>
                        </div>

                    <?php else: ?>
                        <div class="border-bottom pb-3 mb-3">
                            <h3 class="fw-bold">Formulir Pendaftaran</h3>
                            <p class="text-muted small mb-0">Isi data diri Anda dengan benar.</p>
                        </div>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control bg-light py-2" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">Email</label>
                                    <input type="email" name="email" class="form-control bg-light py-2" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">No. WhatsApp</label>
                                    <input type="number" name="hp" class="form-control bg-light py-2" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-muted">Pilih Peran Relawan</label>
                                <select name="peran" class="form-select bg-light py-2" required>
                                    <option value="">-- Pilih Minat Anda --</option>
                                    <option value="Pengajar">Pengajar (Guru Les/Mengaji)</option>
                                    <option value="Logistik">Tim Logistik & Dapur</option>
                                    <option value="Medis">Tim Kesehatan/Medis</option>
                                    <option value="Acara">Tim Acara & Hiburan</option>
                                </select>
                            </div>

                            <div class="alert alert-warning small d-flex align-items-center">
                                <i class="fas fa-info-circle me-2 fs-5"></i>
                                <div>Dengan mendaftar, Anda bersedia mengikuti aturan panti dan menunggu seleksi Admin.</div>
                            </div>

                            <button type="submit" name="daftar_relawan" class="btn btn-custom w-100 py-3 fw-bold shadow">
                                <i class="fas fa-paper-plane me-2"></i> Kirim Pendaftaran
                            </button>
                        </form>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
</section>

<?php include 'footer.php'; ?>