<?php 
include 'header.php'; 
// Koneksi manual jika header.php belum ada koneksi, atau include 'koneksi.php';
$koneksi = mysqli_connect("localhost", "root", "", "db_panti");
?>

<div class="page-header">
    <div class="container">
        <h1 class="fw-bold">Our Gallery</h1>
        <p class="mb-0">Home / <span class="text-warning">Gallery</span></p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        
        <div class="mb-5 position-relative">
            <div style="height: 400px; background: url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80') center/cover;" class="rounded shadow w-100 d-flex align-items-center justify-content-center text-white">
                <i class="fas fa-play-circle display-1" style="opacity: 0.8; cursor: pointer;"></i>
            </div>
            <p class="text-center mt-3 text-muted fst-italic">Dokumentasi kegiatan lapangan kami bersama relawan.</p>
        </div>

        <div class="row g-4">
            <?php 
            $query_galeri = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC");
            if(mysqli_num_rows($query_galeri) > 0) {
                while($foto = mysqli_fetch_assoc($query_galeri)) { 
            ?>
            <div class="col-md-4 col-sm-6">
                <div class="card border-0 shadow-sm h-100">
                    <div style="height: 250px; overflow: hidden;" class="rounded-top">
                        <img src="<?php echo $foto['link_gambar']; ?>" class="w-100 h-100" style="object-fit: cover; transition: 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" alt="Galeri">
                    </div>
                    <div class="card-body text-center">
                        <h6 class="fw-bold mb-0"><?php echo $foto['judul']; ?></h6>
                        <small class="text-muted"><?php echo date('d M Y', strtotime($foto['tanggal'])); ?></small>
                    </div>
                </div>
            </div>
            <?php 
                } 
            } else {
                echo "<p class='text-center text-muted'>Belum ada foto di galeri.</p>";
            }
            ?>
        </div>

    </div>
</section>

<?php include 'footer.php'; ?>