<?php 
include 'header.php'; 

// KONEKSI DATABASE (Sesuaikan path/lokasi file koneksi.php Anda)
// Jika file koneksi.php ada di folder utama, gunakan: include 'koneksi.php';
// Jika belum ada file koneksi terpisah, pakai kode koneksi manual di bawah ini:
$koneksi = mysqli_connect("localhost", "root", "", "db_panti");

// LOGIKA PENYIMPANAN DATA
if(isset($_POST['kirim_donasi'])){
    $nominal = $_POST['amount'];
    $nama    = $_POST['nama_donatur'];
    $email   = $_POST['email'];
    $bank    = $_POST['bank'];
    $tgl     = date('Y-m-d');

    // Simpan ke Tabel 'donasi'
    $query = "INSERT INTO donasi (nama_donatur, email, nominal, bank, tanggal) VALUES ('$nama', '$email', '$nominal', '$bank', '$tgl')";
    $simpan = mysqli_query($koneksi, $query);

    if($simpan){
        // Notifikasi Berhasil & Redirect ke Home
        echo "<script>
            alert('Terima kasih! Donasi Anda sebesar Rp " . number_format($nominal) . " melalui " . $bank . " berhasil dicatat.');
            window.location='home.php';
        </script>";
    } else {
        echo "<script>alert('Gagal menyimpan donasi.');</script>";
    }
}

// Menangkap nominal dari halaman causes (jika ada)
$default_amount = isset($_GET['amount']) ? $_GET['amount'] : '';
?>

<div class="page-header" style="padding: 60px 0;">
    <div class="container">
        <h1 class="fw-bold">Make a Donation</h1>
        <p class="mb-0 text-white-50">Home / <span class="text-warning">Donate</span></p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-4">
                <img src="https://loremflickr.com/600/400/students" class="img-fluid rounded mb-3 w-100 shadow-sm" alt="">
                <h6 class="text-warning text-uppercase small fw-bold">Anda berdonasi untuk:</h6>
                <h3 class="fw-bold">Bantuan Pendidikan & Operasional Panti</h3>
                <p class="text-muted small">Donasi Anda akan tercatat secara otomatis di sistem kami dan akan digunakan untuk kebutuhan mendesak anak-anak panti.</p>
                
                <div class="bg-light p-3 rounded border">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <span class="small fw-bold">Transparansi Dana</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <span class="small fw-bold">Laporan Berkala</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <span class="small fw-bold">Amanah & Terpercaya</span>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card shadow-sm border-0 p-4">
                    <h4 class="fw-bold mb-4">Formulir Donasi</h4>
                    
                    <form method="POST" action="">
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted">NOMINAL DONASI (RP)</label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold bg-warning text-dark border-warning">Rp</span>
                                <input type="number" name="amount" class="form-control py-3 fw-bold" placeholder="0" min="10000" value="<?php echo $default_amount; ?>" required>
                            </div>
                            <div class="form-text text-muted">*Minimal donasi Rp 10.000</div>
                        </div>

                        <h5 class="fw-bold mt-4 mb-3 border-bottom pb-2">Data Donatur</h5>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">NAMA LENGKAP</label>
                            <input type="text" name="nama_donatur" class="form-control bg-light py-3" placeholder="Nama Hamba Allah / Nama Asli" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">ALAMAT EMAIL</label>
                                <input type="email" name="email" class="form-control bg-light py-3" placeholder="email@contoh.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">METODE PEMBAYARAN</label>
                                <select name="bank" class="form-select bg-light py-3" required>
                                    <option value="" selected disabled>-- Pilih Bank --</option>
                                    <option value="BCA">Bank BCA (Transfer)</option>
                                    <option value="BRI">Bank BRI (Transfer)</option>
                                    <option value="MANDIRI">Bank Mandiri (Transfer)</option>
                                </select>
                            </div>
                        </div>

                        <div class="alert alert-info d-flex align-items-center mt-2" role="alert">
                            <i class="fas fa-info-circle me-3 fs-4"></i>
                            <div class="small">
                                Silakan transfer sesuai nominal ke rekening Yayasan. Notifikasi akan muncul setelah Anda klik tombol di bawah.
                            </div>
                        </div>

                        <button type="submit" name="kirim_donasi" class="btn btn-custom w-100 py-3 fw-bold shadow mt-3 text-uppercase">
                            <i class="fas fa-heart me-2"></i> Konfirmasi Donasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>