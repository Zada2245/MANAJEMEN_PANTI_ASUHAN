<?php include 'header.php'; ?>

<div class="page-header">
    <div class="container">
        <h1 class="fw-bold">Causes Details</h1>
        <p class="mb-0 text-white-50">Home / Causes / <span class="text-warning">Education</span></p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <img src="https://loremflickr.com/800/400/class,students" class="img-fluid rounded mb-4 w-100" alt="Cause">
                
                <h2 class="fw-bold">Education Needs For Change The World.</h2>
                <div class="d-flex justify-content-between my-3 small fw-bold">
                    <span class="text-warning">45% Donated</span>
                    <span>Goal: $10,000</span>
                </div>
                <div class="progress mb-4" style="height: 10px;">
                    <div class="progress-bar bg-warning" style="width: 45%"></div>
                </div>

                <p class="text-muted">Pendidikan adalah kunci masa depan. Banyak anak di pedalaman tidak memiliki akses buku dan alat tulis. Donasi Anda akan digunakan untuk membangun perpustakaan desa.</p>
                
                <h4 class="fw-bold mt-4">Course Challenges</h4>
                <p class="text-muted">Akses jalan yang sulit dan kurangnya tenaga pengajar menjadi kendala utama kami.</p>

                <div class="my-4">
                    <h5 class="fw-bold">Summary And Document</h5>
                    <button class="btn btn-light border w-100 py-3 text-start d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-file-pdf text-danger me-2"></i> Proposal_Project.pdf</span>
                        <i class="fas fa-download text-muted"></i>
                    </button>
                </div>

                <div class="bg-light p-4 rounded border mt-5">
                    <h4 class="fw-bold mb-3">Select Donation Amount</h4>
                    <form action="donation.php">
                        <div class="d-flex gap-2 mb-3 flex-wrap">
                            <label class="btn btn-outline-warning flex-fill"><input type="radio" name="amt" class="d-none"> $10</label>
                            <label class="btn btn-outline-warning flex-fill"><input type="radio" name="amt" class="d-none"> $25</label>
                            <label class="btn btn-outline-warning flex-fill active"><input type="radio" name="amt" class="d-none" checked> $50</label>
                            <label class="btn btn-outline-warning flex-fill"><input type="radio" name="amt" class="d-none"> $100</label>
                        </div>
                        <input type="number" class="form-control mb-3" placeholder="Custom Amount">
                        <button class="btn btn-custom w-100 py-3">Donate Now</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="mb-4">
                    <h5 class="fw-bold border-bottom pb-2 border-warning d-inline-block">Search Here</h5>
                    <form class="d-flex mt-3">
                        <input class="form-control me-2" type="search" placeholder="Search...">
                        <button class="btn btn-warning text-white" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>

                <div class="mb-4">
                    <h5 class="fw-bold border-bottom pb-2 border-warning d-inline-block">Causes Categories</h5>
                    <ul class="list-group list-group-flush mt-3">
                        <li class="list-group-item d-flex justify-content-between">Education <span class="badge bg-warning rounded-pill">14</span></li>
                        <li class="list-group-item d-flex justify-content-between">Health <span class="badge bg-warning rounded-pill">5</span></li>
                        <li class="list-group-item d-flex justify-content-between">Human Rights <span class="badge bg-warning rounded-pill">8</span></li>
                    </ul>
                </div>
                
                <div class="card bg-warning bg-opacity-10 border-warning">
                    <div class="card-body">
                        <h5 class="fw-bold">Urgent Cause</h5>
                        <img src="https://loremflickr.com/300/200/poor,child" class="img-fluid rounded mb-2">
                        <h6 class="fw-bold small">Help Hunger People</h6>
                        <a href="donation.php" class="btn btn-sm btn-custom w-100">Donate</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>