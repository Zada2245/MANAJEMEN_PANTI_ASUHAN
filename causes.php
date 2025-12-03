<?php include 'header.php'; ?>

<div class="page-header">
    <div class="container">
        <h1 class="fw-bold">Detail Kebutuhan Panti</h1>
        <p class="mb-0 text-white-50">Home / Causes / <span class="text-warning">Kebutuhan Panti</span></p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <img src="https://loremflickr.com/800/400/orphanage,children" class="img-fluid rounded mb-4 w-100" alt="Kondisi Panti">
                
                <h2 class="fw-bold">Bantu Kami Bertahan: Stok Sembako Menipis & Atap Bocor</h2>
                
                <div class="d-flex justify-content-between my-3 small fw-bold">
                    <span class="text-warning">Rp 4.500.000 Terkumpul</span>
                    <span>Target: Rp 15.000.000</span>
                </div>
                <div class="progress mb-4" style="height: 10px;">
                    <div class="progress-bar bg-warning" style="width: 30%"></div>
                </div>

                <h4 class="fw-bold mt-4">Kondisi Panti Saat Ini</h4>
                <p class="text-muted">
                    Saat ini, Panti Asuhan kami yang menampung 50 anak yatim piatu sedang mengalami masa sulit. 
                    Persediaan bahan pokok di gudang hanya cukup untuk 3 hari ke depan. Selain itu, karena musim hujan yang terus menerus, 
                    beberapa atap di kamar tidur anak-anak mengalami kebocoran parah yang menyebabkan kasur mereka basah dan lembab.
                </p>
                <p class="text-muted">
                    Kami berusaha semampu kami, namun biaya operasional bulan ini membengkak karena adanya anak asuh baru yang sakit dan memerlukan biaya pengobatan.
                </p>

                <div class="bg-white border rounded p-4 my-4 shadow-sm">
                    <h5 class="fw-bold text-danger border-bottom pb-2"><i class="fas fa-clipboard-list me-2"></i>Daftar Kebutuhan Mendesak</h5>
                    <p class="small text-muted mb-3">Berikut adalah rincian kebutuhan yang kami perlukan segera:</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-utensils text-warning me-2"></i> Sembako (Beras 50kg, Minyak, Telur)</span>
                            <span class="badge bg-danger rounded-pill">Sangat Mendesak</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-home text-warning me-2"></i> Perbaikan 3 titik atap bocor</span>
                            <span class="badge bg-danger rounded-pill">Mendesak</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-baby text-warning me-2"></i> Susu Balita & Popok</span>
                            <span class="badge bg-warning text-dark rounded-pill">Butuh Segera</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-book text-warning me-2"></i> Buku Tulis & Alat Sekolah</span>
                            <span class="badge bg-info text-dark rounded-pill">Rutin</span>
                        </li>
                    </ul>
                </div>

                <div class="my-4">
                    <button class="btn btn-light border w-100 py-3 text-start d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-file-alt text-primary me-2"></i> Rincian_Anggaran_Perbaikan.pdf</span>
                        <i class="fas fa-download text-muted"></i>
                    </button>
                </div>

                <div class="bg-light p-4 rounded border mt-5 border-warning border-2">
                    <h4 class="fw-bold mb-3 text-center">Salurkan Bantuan Anda</h4>
                    <p class="text-center text-muted small mb-4">Bantuan Anda, sekecil apapun, sangat berarti untuk senyum mereka.</p>
                    
                    <form action="donation.php" method="GET">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Masukkan Nominal Bantuan</label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold bg-white">Rp</span>
                                <input type="number" name="amount" class="form-control py-3" placeholder="Contoh: 50000" min="10000" required>
                            </div>
                            <div class="form-text text-muted">*Masukkan nominal tanpa titik.</div>
                        </div>
                        <button type="submit" class="btn btn-custom w-100 py-3 fw-bold shadow">
                            <i class="fas fa-heart me-2"></i> Donasi Sekarang
                        </button>
                    </form>
                </div>
                </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="mb-4">
                    <h5 class="fw-bold border-bottom pb-2 border-warning d-inline-block">Cari Program</h5>
                    <form class="d-flex mt-3">
                        <input class="form-control me-2" type="search" placeholder="Cari...">
                        <button class="btn btn-warning text-white" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>

                <div class="mb-4">
                    <h5 class="fw-bold border-bottom pb-2 border-warning d-inline-block">Kategori Bantuan</h5>
                    <ul class="list-group list-group-flush mt-3">
                        <li class="list-group-item d-flex justify-content-between">Pendidikan <span class="badge bg-warning rounded-pill">14</span></li>
                        <li class="list-group-item d-flex justify-content-between">Kesehatan <span class="badge bg-warning rounded-pill">5</span></li>
                        <li class="list-group-item d-flex justify-content-between">Pembangunan <span class="badge bg-warning rounded-pill">8</span></li>
                    </ul>
                </div>
                
                <div class="card bg-warning bg-opacity-10 border-warning">
                    <div class="card-body">
                        <h5 class="fw-bold">Program Mendesak Lainnya</h5>
                        <img src="https://loremflickr.com/300/200/poor,meal" class="img-fluid rounded mb-2">
                        <h6 class="fw-bold small">Sedekah Makan Jumat</h6>
                        <a href="donation.php" class="btn btn-sm btn-custom w-100">Bantu Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>