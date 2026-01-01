@extends('layouts.master')

@section('content')

    <style>
        /* Animasi Fade In untuk seluruh konten */
        .fade-in {
            animation: fadeIn ease 1s;
            -webkit-animation: fadeIn ease 1s;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Efek Hover pada Card */
        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        /* Animasi untuk Progress Bar atau Icon */
        .pulse {
            animation: pulse-animation 2s infinite;
        }

        @keyframes pulse-animation {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>

    <div class="page-inner fade-in">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard Pengurus: {{ $ukm->nama_ukm }}</h3>
                <h6 class="op-7 mb-2">
                    Selamat Datang,
                    <span class="text-primary fw-bold">{{ auth()->user()->name }}</span>
                    ({{ $member->jabatan }})
                </h6>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round hover-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small pulse">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Event</p>
                                    <h4 class="card-title">{{ $totalEvent }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round hover-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small pulse">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Anggota</p>
                                    <h4 class="card-title">{{ $totalAnggota }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-round hover-card border-start border-info" style="border-left: 5px solid !important;">
                    <div class="card-body">
                        <div class="card-title fw-bold">Profil {{ $ukm->nama_ukm }}</div>
                        <div class="row pt-2">
                            <div class="col-6">
                                <p class="mb-0 text-muted small">Pembina</p>
                                <p class="fw-bold mb-0">{{ $ukm->pembina }}</p>
                            </div>
                            <div class="col-6">
                                <p class="mb-0 text-muted small">Kategori</p>
                                <span class="badge badge-success">{{ $ukm->kategori }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-round shadow-sm">
                    <div class="card-header bg-white">
                        <div class="card-title">Pendaftar Event Terbaru</div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nama Mahasiswa</th>
                                        <th>Event</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
    @forelse($pendaftarTerbaru as $pendaftar)
    <tr>
        <td>
            <div class="d-flex align-items-center">
                <div class="avatar avatar-sm me-2">
                    <span class="avatar-title rounded-circle border border-white bg-info">
                        {{ substr($pendaftar->user->name, 0, 1) }}
                    </span>
                </div>
                <span class="fw-bold">{{ $pendaftar->user->name }}</span>
            </div>
        </td>
        <td>{{ $pendaftar->event->nama_event }}</td>
        <td>{{ \Carbon\Carbon::parse($pendaftar->created_at)->diffForHumans() }}</td>
        <td>
            @if($pendaftar->status == 'pending')
                <span class="badge badge-warning">Pending</span>
            @elseif($pendaftar->status == 'diterima')
                <span class="badge badge-success">Diterima</span>
            @else
                <span class="badge badge-danger">Ditolak</span>
            @endif
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" class="text-center p-5 text-muted">
            <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
            Belum ada pendaftaran baru hari ini.
        </td>
    </tr>
    @endforelse
</tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
    <div class="card card-round bg-primary-gradient text-white hover-card">
        <div class="card-body">
            <h4 class="fw-bold">Aksi Cepat</h4>
            <p class="small op-8">Kelola data UKM Anda dengan satu klik.</p>
            <div class="mt-4 d-flex flex-column gap-2"> 
                <a href="{{ route('pengurus.event.create') }}"
                    class="btn btn-white btn-border btn-round fw-bold d-flex align-items-center justify-content-center shadow-sm py-2">
                    <i class="fas fa-plus-circle me-2"></i> Buat Event Baru
                </a>
                <a href="{{ route('pengurus.anggota.index') }}"
                    class="btn btn-white btn-border btn-round fw-bold d-flex align-items-center justify-content-center shadow-sm py-2">
                    <i class="fas fa-user-friends me-2"></i> Kelola Anggota
                </a>
            </div>
        </div>
    </div>
</div>  
        </div>

        <hr>

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="fw-bold mb-0">Katalog Event</h4>
            <a href="{{ route('pengurus.event.index') }}" class="btn btn-sm btn-primary btn-round">
                Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row">
            @forelse($events as $event)
                <div class="col-md-4 mb-4">
                    <div class="card card-post card-round shadow-sm hover-card border-0">
                        <div
                            style="position: relative; width: 100%; height: 200px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 10px 10px 0 0;">
                            <img src="{{ asset('storage/posters/' . $event->poster) }}" alt="Poster"
                                style="width: 100%; height: 100%; object-fit: cover;">
                            <div style="position: absolute; top: 12px; left: 12px;">
                                <span class="badge badge-primary">
                                    {{ \Carbon\Carbon::parse($event->tanggal)->format('d M') }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title fw-bold" style="font-size: 16px;">{{ $event->nama_event }}</h3>
                            <p class="text-muted small">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                {{ $event->lokasi }}
                            </p>
                            <div class="mt-auto pt-3">
                                <a href="{{ route('pengurus.event.show', $event->id) }}"
                                    class="btn btn-outline-primary btn-sm btn-round btn-block">
                                    Detail Event
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Tidak ada event ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>

@endsection