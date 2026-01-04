<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pilih UKM Kamu</title>

  <!-- Fonts & Bootstrap -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

  <link href="{{ asset('assets/css/ukm.css') }}" rel="stylesheet">
</head>

<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg bg-white fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="/index">UKM Kampus</a>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navmenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navmenu">
        <ul class="navbar-nav ms-auto gap-4">
          <li><a href="home" class="nav-link">Home</a></li>
          <li><a href="home#about" class="nav-link">About</a></li>
          <li><a href="ukm" class="nav-link active fw-semibold">Daftar UKM</a></li>
          <li><a href="#logout" class="nav-link">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <section id="page-header">
    <h2>Pilih UKM Kamu</h2>
    <p>Pilih UKM sesuai minatmu. Setiap UKM memiliki poin sebagai reward aktivitas keikutsertaanmu.</p>
  </section>

  <section class="container pb-5">
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="ukm-card">
          <img src="{{ asset('assets/img/services/Basket.webp')}}">
          <div>
            <h5>UKM Basket</h5>
            <p>Wadah untuk mengembangkan bakat basket dan mengikuti turnamen kampus.</p>
            <button class="btn btn-primary btn-ukm" onclick="window.location.href='/ukm/basket'">Pilih UKM</button>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="ukm-card">
          <img src="{{ asset('assets/img/services/Voli.webp') }}">
          <div>
            <h5>UKM Voli</h5>
            <p>Tempat pembinaan bola voli dengan latihan rutin dan kompetisi internal.</p>
            <button class="btn btn-primary btn-ukm" onclick="window.location.href='/ukm/voli'">Pilih UKM</button>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="ukm-card">
          <img src="{{ asset('assets/img/services/Sepak_bola.webp') }}">
          <div>
            <h5>UKM Sepak Bola</h5>
            <p>Komunitas aktif dengan jadwal latihan rutin serta event pertandingan.</p>
            <button class="btn btn-primary btn-ukm" onclick="window.location.href='/ukm/sepak_bola'">Pilih UKM</button>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="ukm-card">
          <img src="{{ asset('assets/img/services/Taekwondo.webp') }}">
          <div>
            <h5>UKM Taekwondo</h5>
            <p>Latihan bela diri untuk meningkatkan disiplin fisik dan mental.</p>
            <button class="btn btn-primary btn-ukm" onclick="window.location.href='/ukm/taekwondo'">Pilih UKM</button>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="ukm-card">
          <img src="{{ asset('assets/img/services/Seni_tari.webp') }}">
          <div>
            <h5>UKM Seni Tari</h5>
            <p>Mengembangkan kreativitas dalam tari tradisional dan modern.</p>
            <button class="btn btn-primary btn-ukm" onclick="window.location.href='/ukm/seni_tari'">Pilih UKM</button>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="ukm-card">
          <img src="{{ asset('assets/img/services/Musik.webp') }}">
          <div>
            <h5>UKM Musik</h5>
            <p>Komunitas musisi kampus untuk latihan, kolaborasi, dan tampil di event.</p>
            <button class="btn btn-primary btn-ukm" onclick="window.location.href='/basket'">Pilih UKM</button>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- FOOTER -->
  <footer class="text-center">
    <p>© 2025 UKM Kampus — All Rights Reserved.</p>
    <div>
      <a href="#"><i class="bi bi-instagram fs-4 me-3"></i></a>
      <a href="#"><i class="bi bi-facebook fs-4 me-3"></i></a>
      <a href="#"><i class="bi bi-youtube fs-4"></i></a>
    </div>
  </footer>

</body>

</html>
