<?php 
include 'header.php'; 


$koneksi = mysqli_connect("localhost", "root", "", "db_panti");
?>

<div class="page-header">
    <div class="container">
        <h1 class="fw-bold">Anak Asuh Kami</h1>
        <p class="mb-0">Home / <span class="text-warning">Children</span></p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        
        <div class="text-center mb-5 section-title">
            <h2>Generasi Penerus Harapan</h2>
            <p class="text-muted">Kenali anak-anak hebat yang sedang berjuang meraih mimpi mereka.</p>
        </div>

        <div class="row g-4">
            <?php 
            // Ambil data anak dari database
            $query_anak = mysqli_query($koneksi, "SELECT * FROM anak_asuh ORDER BY nama ASC");
            
            if(mysqli_num_rows($query_anak) > 0) {
                while($anak = mysqli_fetch_assoc($query_anak)) { 
                    $lahir = new DateTime($anak['tgl_lahir']);
                    $hari_ini = new DateTime('today');
                    $umur = $lahir->diff($hari_ini)->y;
            ?>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 card-anak">
                    <div style="height: 250px; overflow: hidden;" class="position-relative">
                        <img src="<?php echo $anak['foto']; ?>" class="w-100 h-100" style="object-fit: cover; transition: 0.3s;" alt="<?php echo $anak['nama']; ?>">
                        
                        <div class="position-absolute top-0 end-0 bg-warning text-dark fw-bold px-3 py-1 m-2 rounded-pill small shadow">
                            <?php echo $umur; ?> Tahun
                        </div>
                    </div>

                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="fw-bold mb-1"><?php echo $anak['nama']; ?></h5>
                        <p class="text-muted small mb-3"><?php echo $anak['pendidikan_jenjang']; ?> - Kelas <?php echo $anak['kelas']; ?></p>
                        
                        <div class="bg-light p-2 rounded mb-3 text-start small">
                            <div class="d-flex align-items-center mb-1">
                                <i class="fas fa-heart text-danger me-2" style="width:20px;"></i> 
                                <span>Hobi: <strong><?php echo $anak['hobi']; ?></strong></span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-star text-warning me-2" style="width:20px;"></i> 
                                <span>Cita-cita: <strong>Sukses</strong></span>
                            </div>
                        </div>

                        <p class="card-text text-muted small fst-italic flex-grow-1">
                            "<?php echo substr($anak['catatan_perkembangan'], 0, 100); ?>..."
                        </p>
                        
                        </div>
                </div>
            </div>
            <?php 
                } 
            } else {
                echo "<div class='col-12 text-center py-5 text-muted'>Belum ada data anak asuh yang ditampilkan.</div>";
            }
            ?>
        </div>

    </div>
</section>

<style>
    .card-anak:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
    }
    .card-anak img:hover {
        transform: scale(1.1);
    }
</style>

<?php include 'footer.php'; ?>