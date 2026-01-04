<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard - UKM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body { font-family: Poppins, sans-serif; background: #f5f6fa; }
    .sidebar {
      width: 260px;
      height: 100vh;
      background: #1b1f3b;
      padding: 25px;
      position: fixed;
      top: 0;
      left: 0;
      color: #fff;
    }
    .sidebar h2 { font-weight: 700; margin-bottom: 35px; }
    .sidebar a {
      display: block;
      padding: 12px 15px;
      border-radius: 8px;
      margin-bottom: 10px;
      color: #dcdcdc;
      text-decoration: none;
    }
    .sidebar a:hover, .sidebar a.active {
      background: #3d3f75;
      color: #fff;
    }
    .main {
      margin-left: 260px;
      padding: 40px;
    }
    .card-box {
      padding: 25px;
      border-radius: 12px;
      background: #fff;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    .card-box h4 { font-weight: 600; }
  </style>
</head>
<body>

  <!-- SIDEBAR -->
  <div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="dashboard_admin" class="active"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
    <a href="mahasiswa"><i class="bi bi-people-fill me-2"></i>Mahasiswa</a>
    <a href="#"><i class="bi bi-diagram-3-fill me-2"></i>UKM</a>
    <a href="#"><i class="bi bi-person-badge-fill me-2"></i>Admin</a>
    <a href="#"><i class="bi bi-ui-checks-grid me-2"></i>Forms</a>
    <a href="#" class="mt-4"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
  </div>

  <!-- MAIN DASHBOARD -->
  <div class="main">
    <h1 class="fw-bold mb-4">Dashboard Admin</h1>

    <div class="row g-4">

      <div class="col-lg-4 col-md-6">
        <div class="card-box text-center">
          <i class="bi bi-people-fill fs-1 text-primary"></i>
          <h4 class="mt-3">Total Mahasiswa</h4>
          <p class="fs-4 fw-bold">120</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card-box text-center">
          <i class="bi bi-diagram-3-fill fs-1 text-success"></i>
          <h4 class="mt-3">Total UKM</h4>
          <p class="fs-4 fw-bold">12</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card-box text-center">
          <i class="bi bi-ui-checks-grid fs-1 text-warning"></i>
          <h4 class="mt-3">Form Masuk</h4>
          <p class="fs-4 fw-bold">34</p>
        </div>
      </div>

    </div>

    <div class="mt-5">
      <h3 class="fw-bold mb-3">Aktivitas Terbaru</h3>
      <div class="card-box">

        <!-- Activity Item 1 -->
        <div class="d-flex align-items-center justify-content-between p-3 rounded mb-3 activity-item" style="cursor:pointer;" onclick="window.location.href='forms/view/101'">
          <div class="d-flex align-items-center gap-3">
            <img src="https://i.pravatar.cc/55?img=12" class="rounded-circle" width="55" height="55">
            <div>
              <h6 class="mb-0 fw-bold">Budi Pratama</h6>
              <small class="text-muted">Mengirim form pendaftaran UKM Basket</small>
            </div>
          </div>
          <span class="badge bg-primary">Lihat</span>
        </div>

        <!-- Activity Item 2 -->
        <div class="d-flex align-items-center justify-content-between p-3 rounded mb-3 activity-item" style="cursor:pointer;" onclick="window.location.href='forms/view/102'">
          <div class="d-flex align-items-center gap-3">
            <img src="https://i.pravatar.cc/55?img=32" class="rounded-circle" width="55" height="55">
            <div>
              <h6 class="mb-0 fw-bold">Sinta Amalia</h6>
              <small class="text-muted">Upload berkas untuk UKM Seni Tari</small>
            </div>
          </div>
          <span class="badge bg-primary">Lihat</span>
        </div>

        <!-- Activity Item 3 -->
        <div class="d-flex align-items-center justify-content-between p-3 rounded mb-3 activity-item" style="cursor:pointer;" onclick="window.location.href='forms/view/103'">
          <div class="d-flex align-items-center gap-3">
            <img src="https://i.pravatar.cc/55?img=55" class="rounded-circle" width="55" height="55">
            <div>
              <h6 class="mb-0 fw-bold">Rizky Mahendra</h6>
              <small class="text-muted">Mengirim revisi portofolio UKM Musik</small>
            </div>
          </div>
          <span class="badge bg-primary">Lihat</span>
        </div>

        <!-- Activity Item 4 -->
        <div class="d-flex align-items-center justify-content-between p-3 rounded activity-item" style="cursor:pointer;" onclick="window.location.href='forms/view/104'">
          <div class="d-flex align-items-center gap-3">
            <img src="https://i.pravatar.cc/55?img=41" class="rounded-circle" width="55" height="55">
            <div>
              <h6 class="mb-0 fw-bold">Dewi Larasati</h6>
              <small class="text-muted">Admin memproses form UKM Taekwondo</small>
            </div>
          </div>
          <span class="badge bg-primary">Lihat</span>
        </div>

      </div>
    </div>

  </div>

</body>
</html>
