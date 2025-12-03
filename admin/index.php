<?php 
// Koneksi Database
include '../koneksi.php'; 

// 1. HITUNG TOTAL DONASI (Semua)
$q_total = mysqli_query($koneksi, "SELECT SUM(nominal) as total FROM donasi");
$d_total = mysqli_fetch_assoc($q_total);
$total_uang = $d_total['total'] ?? 0;

// 2. HITUNG JUMLAH DONATUR
$q_donatur = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM donasi");
$d_donatur = mysqli_fetch_assoc($q_donatur);
$jml_donatur = $d_donatur['jumlah'] ?? 0;

// 3. DATA UNTUK GRAFIK (7 Hari Terakhir)
$q_grafik = mysqli_query($koneksi, "
    SELECT DATE_FORMAT(tanggal, '%d %M') as tgl, SUM(nominal) as total 
    FROM donasi 
    GROUP BY tanggal 
    ORDER BY tanggal ASC 
    LIMIT 7
");
$label_chart = [];
$data_chart = [];
while($g = mysqli_fetch_assoc($q_grafik)){
    $label_chart[] = $g['tgl'];
    $data_chart[] = $g['total'];
}

// 4. DATA TRANSAKSI TERBARU (5 Data)
$q_recent = mysqli_query($koneksi, "SELECT * FROM donasi ORDER BY id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Charity Hope</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        
        <div class="top-bar">
            <h4 class="fw-bold mb-0">Dashboard</h4>
            <div class="d-flex align-items-center">
                <div class="search-box me-4 d-none d-md-block">
                    <input type="text" placeholder="Search anything...">
                </div>
                <div class="d-flex align-items-center gap-3">
                    <i class="far fa-bell fa-lg text-secondary"></i>
                    <div class="user-profile d-flex align-items-center gap-2">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin">
                        <div class="d-none d-md-block">
                            <small class="d-block fw-bold">Ayu Alizza</small>
                            <small class="text-muted" style="font-size: 0.7rem;">Super Admin</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-card d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Total Donations</small>
                        <h3 class="fw-bold my-1">Rp <?php echo number_format($total_uang / 1000000, 1); ?>M</h3>
                        <small class="text-success"><i class="fas fa-arrow-up"></i> +12%</small>
                    </div>
                    <div class="stat-icon bg-icon-warning">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Total Donors</small>
                        <h3 class="fw-bold my-1"><?php echo $jml_donatur; ?></h3>
                        <small class="text-muted">Orang Baik</small>
                    </div>
                    <div class="stat-icon bg-icon-primary">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Active Causes</small>
                        <h3 class="fw-bold my-1">3</h3>
                        <small class="text-muted">Program</small>
                    </div>
                    <div class="stat-icon bg-icon-warning">
                        <i class="fas fa-bullseye"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Total Volunteers</small>
                        <h3 class="fw-bold my-1">10</h3>
                        <small class="text-muted">Relawan</small>
                    </div>
                    <div class="stat-icon bg-icon-success">
                        <i class="fas fa-hand-paper"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="chart-container h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold">Donation Trend</h5>
                        <span class="badge bg-warning text-dark">Weekly</span>
                    </div>
                    <canvas id="donationChart" height="120"></canvas>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="chart-container h-100">
                    <h5 class="fw-bold mb-4">Donation by Category</h5>
                    <div style="height: 200px; display:flex; justify-content:center;">
                        <canvas id="categoryChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small text-muted">
                        <span class="me-2"><i class="fas fa-circle text-warning"></i> Education</span>
                        <span class="me-2"><i class="fas fa-circle text-danger"></i> Food</span>
                        <span><i class="fas fa-circle text-info"></i> Health</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="chart-container">
                    <h5 class="fw-bold mb-3">Recent Donations</h5>
                    <div class="table-responsive">
                        <table class="table table-custom table-hover">
                            <thead>
                                <tr>
                                    <th>Donor Name</th>
                                    <th>Bank</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($t = mysqli_fetch_assoc($q_recent)) { ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width:35px; height:35px;">
                                                <i class="fas fa-user text-secondary"></i>
                                            </div>
                                            <span class="fw-bold"><?php echo $t['nama_donatur']; ?></span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border"><?php echo $t['bank']; ?></span></td>
                                    <td><?php echo $t['tanggal']; ?></td>
                                    <td class="fw-bold text-warning">Rp <?php echo number_format($t['nominal']); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="chart-container">
                    <h5 class="fw-bold mb-4">Urgent Causes</h5>
                    
                    <div class="d-flex align-items-center mb-4">
                        <img src="https://loremflickr.com/100/100/school" class="rounded me-3" width="60" height="60" style="object-fit:cover;">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">Education Needs</h6>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-warning" style="width: 70%"></div>
                            </div>
                            <div class="d-flex justify-content-between small mt-1">
                                <span class="fw-bold">$7,000</span>
                                <span class="text-muted">Goal</span>
                            </div>
                        </div>
                        <a href="#" class="btn-view ms-2">View</a>
                    </div>

                    <div class="d-flex align-items-center">
                        <img src="https://loremflickr.com/100/100/food" class="rounded me-3" width="60" height="60" style="object-fit:cover;">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">Food For All</h6>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-warning" style="width: 45%"></div>
                            </div>
                            <div class="d-flex justify-content-between small mt-1">
                                <span class="fw-bold">$4,500</span>
                                <span class="text-muted">Goal</span>
                            </div>
                        </div>
                        <a href="#" class="btn-view ms-2">View</a>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script>
        // Data dari PHP
        const labels = <?php echo json_encode($label_chart); ?>;
        const dataNominal = <?php echo json_encode($data_chart); ?>;

        // 1. Line Chart (Kurva)
        const ctx = document.getElementById('donationChart').getContext('2d');
        
        // Buat Gradient Warna
        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(252, 185, 0, 0.4)'); // Warna atas
        gradient.addColorStop(1, 'rgba(252, 185, 0, 0.0)'); // Warna bawah

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Donation (Rp)',
                    data: dataNominal,
                    borderColor: '#fcb900',
                    backgroundColor: gradient,
                    borderWidth: 2,
                    tension: 0.4, // INI YANG MEMBUAT GARIS MELENGKUNG (KURVA)
                    fill: true,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#fcb900',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { borderDash: [5, 5] }, beginAtZero: true },
                    x: { grid: { display: false } }
                }
            }
        });

        // 2. Pie Chart (Donut)
        const ctxPie = document.getElementById('categoryChart');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: ['Education', 'Food', 'Health'],
                datasets: [{
                    data: [55, 30, 15], // Data dummy (bisa diganti query SQL)
                    backgroundColor: ['#fcb900', '#dc3545', '#0dcaf0'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                cutout: '70%' // Membuat lubang tengah besar
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>