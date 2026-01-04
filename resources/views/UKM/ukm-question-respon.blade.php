<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UKM - Response</title>

  <!-- Fonts & Bootstrap -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #ffffff;
    }

    .navbar {
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    /* CARD */
    .response-card {
      max-width: 700px;
      margin: 120px auto 40px auto;
      background: #fff;
      padding: 35px;
      border-radius: 16px;
      border: 1px solid #e4e4e4;
      box-shadow: 0px 10px 40px rgba(0, 0, 0, 0.06);
      text-align: center;
    }

    .response-card img {
      width: 160px;
      height: 160px;
      object-fit: cover;
      border-radius: 12px;
      margin-bottom: 15px;
    }

    .info-box {
      text-align: left;
      margin-top: 20px;
    }

    .info-box p {
      margin: 6px 0;
      font-size: 15px;
    }

    .btn-home {
      margin-top: 20px;
      padding: 12px 25px;
      border-radius: 10px;
      background: #007bff;
      color: white;
      font-weight: 600;
      text-decoration: none;
      transition: 0.2s;
      display: inline-block;
    }

    .btn-home:hover {
      transform: scale(1.05);
      opacity: 0.95;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg bg-white fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">UKM Kampus</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto gap-3">
          <li><a class="nav-link" href="/home">Home</a></li>
          <li><a class="nav-link" href="/ukm">Daftar UKM</a></li>
        </ul>
      </div>
    </div>
  </nav>


  <!-- RESPONSE CARD -->
  <div class="response-card" data-aos="fade-up">
    <img src="https://images.unsplash.com/photo-1533106418989-88406c7cc8ca" alt="UKM Selected" />

    <h2 class="fw-bold">Terima Kasih Telah Mendaftar!</h2>
    <p class="text-muted mt-2">Berikut adalah ringkasan data pendaftaranmu.</p>

    <div class="info-box">
      <p><strong>Nama:</strong> {{ $nama }}</p>
      <p><strong>Kelas:</strong> {{ $kelas }}</p>
      <p><strong>Posisi:</strong>{{ $posisi }}</p>
      <p><strong>Posisi2:</strong>{{ $posisi2 }}</p>
      <p><strong>Tujuan Bergabung:</strong> {{ $tujuan }}</p>
      <p><strong>Status:</strong> <span class="text-success fw-bold">Menunggu Persetujuan</span></p>
    </div>

    <a href="/ukm" class="btn-home">Kembali ke Daftar UKM</a>
  </div>


  <!-- SCRIPTS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
