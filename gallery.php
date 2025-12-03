<?php include 'header.php'; ?>

<div class="page-header">
    <div class="container">
        <h1 class="fw-bold">Our Gallery</h1>
        <p class="mb-0">Home / <span class="text-warning">Gallery</span></p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        
        <div class="mb-5 position-relative">
            <div style="height: 500px; background-color: #444;" class="rounded shadow w-100 d-flex align-items-center justify-content-center text-white display-1">
                <i class="fas fa-play-circle"></i>
            </div>
            <p class="text-center mt-2 text-muted fst-italic">Dokumentasi kegiatan lapangan kami</p>
        </div>

        <div class="row g-3">
            <?php for($k=1; $k<=6; $k++) { ?>
            <div class="col-md-4 col-sm-6">
                <div style="height: 300px; background-color: #eee;" class="rounded border d-flex align-items-center justify-content-center text-muted">
                    [GALERI <?php echo $k; ?>]
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="d-flex justify-content-center mt-5">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item active"><a class="page-link bg-warning border-warning" href="#">1</a></li>
                    <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                    <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                    <li class="page-item"><a class="page-link text-dark" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>