<?php include 'header.php'; ?>

<header style="background: url('https://images.unsplash.com/photo-1542810634-71277d95dcbb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80') no-repeat center center/cover; height: 600px; position: relative;" class="d-flex align-items-center justify-content-center text-white text-center">
    <div style="position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.4);"></div>
    <div class="container position-relative z-2">
        <h1 class="display-3 fw-bold">MAKE BIG <span class="text-warning">CHANGE</span><br>AND HELP THE WORLD</h1>
        <div class="mt-4">
            <a href="donation.php" class="btn btn-custom btn-lg me-2">Donate Now</a>
            <a href="about.php" class="btn btn-outline-light btn-lg">Read More</a>
        </div>
    </div>
</header>

<section class="container" style="margin-top: -60px; position: relative; z-index: 10;">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="p-5 text-center rounded shadow h-100" style="background-color: #fff8e1; border: 1px solid var(--primary-color);">
                <h3>Create Your Cause</h3>
                <a href="#" class="btn btn-custom mt-3">Get Accredited</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="bg-white p-5 text-center rounded shadow h-100 border">
                <h3>The Long Journey Begins Here</h3>
                <a href="donation.php" class="btn btn-outline-custom mt-3">Donate</a>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5 section-title">
            <h2>Recent Causes</h2>
            <p class="text-muted">Proyek terbaru kami yang membutuhkan uluran tangan Anda.</p>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="https://loremflickr.com/600/400/school,children" class="card-img-top" height="250">
                    <div class="card-body">
                        <h5 class="fw-bold">Education Needs</h5>
                        <p class="small text-muted">Bantuan pendidikan untuk anak kurang mampu.</p>
                        <div class="progress mb-3" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: 70%"></div>
                        </div>
                        <div class="d-flex justify-content-between small fw-bold">
                            <span>Raised: $7,000</span>
                            <span class="text-warning">Goal: $10,000</span>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <div class="row gx-2">
                            <div class="col-6"><a href="donation.php" class="btn btn-outline-warning w-100 btn-sm">Donate</a></div>
                            <div class="col-6"><a href="causes.php" class="btn btn-light w-100 btn-sm border">Read More</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="https://loremflickr.com/600/400/food,hunger" class="card-img-top" height="250">
                    <div class="card-body">
                        <h5 class="fw-bold">Food For All</h5>
                        <p class="small text-muted">Distribusi paket makanan bergizi.</p>
                        <div class="progress mb-3" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: 45%"></div>
                        </div>
                        <div class="d-flex justify-content-between small fw-bold">
                            <span>Raised: $4,500</span>
                            <span class="text-warning">Goal: $10,000</span>
                        </div>
                    </div>
                     <div class="card-footer bg-white border-top-0">
                        <div class="row gx-2">
                            <div class="col-6"><a href="donation.php" class="btn btn-outline-warning w-100 btn-sm">Donate</a></div>
                            <div class="col-6"><a href="causes.php" class="btn btn-light w-100 btn-sm border">Read More</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="https://loremflickr.com/600/400/water,people" class="card-img-top" height="250">
                    <div class="card-body">
                        <h5 class="fw-bold">Clean Water</h5>
                        <p class="small text-muted">Pembangunan sumur air bersih desa.</p>
                        <div class="progress mb-3" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: 85%"></div>
                        </div>
                        <div class="d-flex justify-content-between small fw-bold">
                            <span>Raised: $8,500</span>
                            <span class="text-warning">Goal: $10,000</span>
                        </div>
                    </div>
                     <div class="card-footer bg-white border-top-0">
                        <div class="row gx-2">
                            <div class="col-6"><a href="donation.php" class="btn btn-outline-warning w-100 btn-sm">Donate</a></div>
                            <div class="col-6"><a href="causes.php" class="btn btn-light w-100 btn-sm border">Read More</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container text-center">
        <h6 class="text-uppercase fw-bold text-muted">Contact</h6>
        <h2 class="fw-bold mb-4">Get In Touch</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="bg-white p-4 shadow-sm rounded">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control bg-light border-0 py-3" placeholder="Full Name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" class="form-control bg-light border-0 py-3" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control bg-light border-0 py-3" rows="4" placeholder="Message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-custom w-100 py-3">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>