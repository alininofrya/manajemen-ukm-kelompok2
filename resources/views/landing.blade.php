<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Portal UKM PRO - Platform Kegiatan Mahasiswa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://themewagon.github.io/elearning/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://themewagon.github.io/elearning/css/style.css" rel="stylesheet">

    <style>
        :root {
            --primary: #06BBCC;
            --dark: #181d38;
        }

        /* Hero Header Tetap Sesuai Permintaan */
        .hero-header {
            background: linear-gradient(90deg, rgba(24, 29, 56, .9) 0%, rgba(24, 29, 56, .4) 100%),
                        url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1440');
            background-size: cover;
            background-position: center;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }

        /* Merapikan Card Event Agar Tetap Modern */
        .event-card {
            border-radius: 15px;
            overflow: hidden;
            transition: 0.4s;
            border: 1px solid #eee;
            background: #fff;
            height: 100%;
        }

        .event-img-container { height: 220px; overflow: hidden; position: relative; }
        .event-img-container img { width: 100%; height: 100%; object-fit: cover; }
        .category-badge { position: absolute; top: 15px; left: 15px; background: var(--primary); color: white; padding: 4px 12px; border-radius: 50px; font-size: 12px; font-weight: 600; }
        .event-info { padding: 20px; }
        .ukm-name { color: var(--primary); font-weight: 700; font-size: 14px; }
        .event-title { font-weight: 800; font-size: 18px; color: var(--dark); margin: 8px 0; }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="/" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-graduation-cap me-3"></i>UKM PRO</h2>
        </a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="/" class="nav-item nav-link active">Home</a>
                @auth
                    @php
                        $role = auth()->user()->role;
                        $dash = $role == 'admin' ? '/admin/dashboard' : ($role == 'pengurus' ? '/pengurus/dashboard' : '/mahasiswa/dashboard');
                    @endphp
                    <a href="{{ url($dash) }}" class="nav-item nav-link">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="nav-item nav-link">Masuk</a>
                @endauth
            </div>
            @auth
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger py-4 px-lg-5 d-none d-lg-block" style="border-radius: 0">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Daftar Sekarang<i class="fa fa-arrow-right ms-3"></i></a>
            @endauth
        </div>
    </nav>

    <div class="container-fluid p-0 mb-5">
        <div class="hero-header">
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-sm-10 col-lg-7">
                        <h5 class="text-primary text-uppercase mb-3">Pusat Kegiatan Mahasiswa</h5>
                        <h1 class="display-3 text-white">Temukan Bakatmu Di Luar Ruang Kelas</h1>
                        <p class="fs-5 text-white mb-4 pb-2">Gabung dengan berbagai event seru dari UKM Kampus.</p>
                        <a href="#events" class="btn btn-primary py-md-3 px-md-5 me-3">Lihat Event</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl py-5" id="events">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="section-title bg-white text-center text-primary px-3">Kegiatan</h6>
                <h1 class="mb-5">Event UKM Mendatang</h1>
            </div>
            <div class="row g-4">
                @forelse($events as $event)
                    <div class="col-lg-4 col-md-6">
                        <div class="event-card">
                            <div class="event-img-container">
                                <span class="category-badge">Hot Event</span>
                                <img src="{{ $event->poster ? asset('storage/' . $event->poster) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800' }}" alt="Poster">
                            </div>
                            <div class="event-info">
                                <div class="ukm-name"><i class="fa fa-users me-2"></i>{{ $event->ukm->nama_ukm }}</div>
                                <h4 class="event-title">{{ $event->nama_event }}</h4>
                                <p class="text-muted small mb-3">{{ Str::limit($event->deskripsi, 85) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted small"><i class="fa fa-calendar-alt me-1"></i> 2025</span>
                                    @auth
                                        @if(auth()->user()->role == 'mahasiswa')
                                            <a href="{{ route('mahasiswa.event.form', $event->id) }}" class="btn btn-sm btn-primary rounded-pill px-3">Daftar</a>
                                        @else
                                            <span class="badge bg-light text-dark">Staff Only</span>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Login</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5"><p class="text-muted">Belum ada event.</p></div>
                @endforelse
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p class="mb-0">&copy; 2025 Portal UKM PRO.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>