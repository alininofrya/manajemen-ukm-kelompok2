<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi UKM Kampus</title>

    <!-- Font & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

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
                    <li><a class="nav-link active" href="home">Home</a></li>
                    <li><a class="nav-link" href="#about">About</a></li>
                    <li><a class="nav-link" href="ukm">Daftar UKM</a></li>
                    <li><a class="nav-link" href="#Logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section id="hero" class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1>Temukan Passion dan Komunitas Terbaikmu</h1>
                <p>Kami membantu mahasiswa menemukan UKM sesuai bakat, hobi, dan minat mereka. Lebih dari 30 UKM
                    tersedia.</p>
                <a href="ukm" class="hero-btn">Mulai Cari UKM</a>
            </div>

            <div class="col-lg-6 hero-image mt-4 mt-lg-0">
                <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b" alt="Students" width="500px">
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section id="about" class="container text-center mt-5">
        <h2 class="fw-bold">Tentang Kami</h2>
        <p class="mt-3 w-75 mx-auto">
            Aplikasi UKM ini dibuat untuk membantu mahasiswa menemukan tempat berkembang yang tepat.
            Dengan sistem pencarian sederhana dan daftar UKM lengkap, kamu bisa menemukan komunitas terbaikmu!
        </p>
    </section>

    <!-- FITUR / BENEFIT -->
    <section id="features" class="container mt-5">
        <h2 class="fw-bold mb-4 text-center">Kenapa Memilih UKM Kampus?</h2>

        <div class="row g-4">

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <i class="bi bi-people-fill text-primary"></i>
                    <h5>Komunitas Aktif</h5>
                    <p>Bergabung dengan ratusan mahasiswa yang aktif mengikuti kegiatan setiap minggunya.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <i class="bi bi-lightbulb-fill text-warning"></i>
                    <h5>Pengembangan Skill</h5>
                    <p>Setiap UKM difokuskan untuk meningkatkan kemampuan anggotanya.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <i class="bi bi-award-fill text-success"></i>
                    <h5>Prestasi Kampus</h5>
                    <p>UKM sering meraih prestasi di tingkat universitas hingga nasional.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="container text-center mt-5">
        <h2 class="fw-bold">Hubungi Kami</h2>
        <p class="mt-2">Ada pertanyaan? Kami siap membantu.</p>
        <p>Email: <b>ukm.kampus@example.com</b></p>
    </section>

    <!-- FOOTER -->
    <footer class="text-center">
        <p>© 2025 UKM Kampus — All Rights Reserved.</p>
        <div class="mt-2">
            <a href="#"><i class="bi bi-instagram fs-4 me-3"></i></a>
            <a href="#"><i class="bi bi-facebook fs-4 me-3"></i></a>
            <a href="#"><i class="bi bi-youtube fs-4"></i></a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
