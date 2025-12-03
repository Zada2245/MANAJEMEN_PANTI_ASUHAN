<?php include 'header.php'; ?>

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
                <img src="https://loremflickr.com/600/400/students" class="img-fluid rounded mb-3 w-100" alt="">
                <h6 class="text-warning text-uppercase small fw-bold">You are donating to:</h6>
                <h3 class="fw-bold">Education Needs For Change The World.</h3>
                <p class="text-muted small">Donasi Anda akan sangat berarti bagi anak-anak ini. Setiap rupiah yang Anda berikan akan dikelola secara transparan.</p>
                <div class="bg-light p-3 rounded">
                    <div class="d-flex justify-content-between small fw-bold mb-1">
                        <span>45% Donated</span>
                        <span>Goal: 100%</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-warning" style="width: 45%"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card shadow-sm border-0 p-4">
                    <h4 class="fw-bold mb-4">Donation Details</h4>
                    
                    <form>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Masukkan Nominal Donasi</label>
                            
                            <div class="input-group">
                                <span class="input-group-text fw-bold bg-light">Rp</span>
                                <input type="number" class="form-control py-3" placeholder="Contoh: 100000" min="10000" required>
                            </div>
                            <div class="form-text text-muted">
                                *Masukkan nominal tanpa titik atau koma (Minimal Rp 10.000)
                            </div>
                        </div>
                        <h5 class="fw-bold mt-4 mb-3">Personal Details</h5>
                        <div class="row">
                            <div class="col-6 mb-3"><input type="text" class="form-control bg-light" placeholder="Nama Depan"></div>
                            <div class="col-6 mb-3"><input type="text" class="form-control bg-light" placeholder="Nama Belakang"></div>
                            <div class="col-6 mb-3"><input type="email" class="form-control bg-light" placeholder="Alamat Email"></div>
                            <div class="col-6 mb-3"><input type="tel" class="form-control bg-light" placeholder="Nomor Telepon"></div>
                        </div>

                        <h5 class="fw-bold mt-3 mb-2">Payment Method</h5>
                        <div class="mb-4">
                            <i class="fab fa-cc-visa fa-2x text-primary me-2"></i>
                            <i class="fab fa-cc-mastercard fa-2x text-danger me-2"></i>
                            <i class="fab fa-cc-paypal fa-2x text-primary"></i>
                        </div>

                        <button class="btn btn-custom w-100 py-3 fw-bold shadow">Lanjutkan Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>