@extends('layouts.master')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-center justify-content-between mb-4 fade-up">
            <div>
                <h3 class="fw-bold mb-1">Manajemen Event Kami</h3>
                <p class="text-muted mb-0">Kelola pendaftaran dan informasi event UKM Anda</p>
            </div>

            <a href="{{ route('pengurus.event.create') }}" class="btn btn-primary btn-round shadow">
                <i class="fa fa-plus-circle me-1"></i> Tambah Event Baru
            </a>
        </div>

        <div class="card card-round shadow-sm fade-up" style="animation-delay: 0.2s">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-modern mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 100px;">Poster</th>
                                <th>Nama Event</th>
                                <th>Tanggal Pelaksanaan</th>
                                <th class="text-center">Pendaftar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $index => $event)
                                <tr class="fade-up row-delay-{{ $index }}">
                                    <td class="text-center">
                                        <img src="{{ asset('storage/posters/' . $event->poster) }}" alt="Poster"
                                            class="poster-img">
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark" style="font-size: 15px;">{{ $event->nama_event }}</div>
                                        <span class="text-muted small">
                                            <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                            {{ $event->lokasi ?? 'Lokasi belum diatur' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-dark">
                                            <i class="far fa-calendar-alt text-primary me-2"></i>
                                            {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge-peserta">
                                            <i class="fas fa-user-friends me-1"></i> 0 Peserta
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('pengurus.event.show', $event->id) }}"
                                                class="btn btn-action-custom btn-outline-primary" data-bs-toggle="tooltip"
                                                title="Lihat Detail">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a href="{{ route('pengurus.event.edit', $event->id) }}"
                                                class="btn btn-action-custom btn-outline-info" data-bs-toggle="tooltip"
                                                title="Edit Data">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <form action="{{ route('pengurus.event.destroy', $event->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-action-custom btn-outline-danger"
                                                    onclick="return confirm('Yakin ingin menghapus event ini?')"
                                                    data-bs-toggle="tooltip" title="Hapus Event">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-calendar-times fa-3x mb-3 d-block"></i>
                                            Belum ada event yang dibuat. Klik tombol "Tambah Event" untuk memulai.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Animasi Fade In Up untuk Baris Tabel */
        .fade-up {
            animation: fadeUp 0.6s ease backwards;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Staggered Delay untuk baris tabel agar muncul berurutan */
        @foreach($events as $index => $event)
            .row-delay-{{ $index }} {
                animation-delay:
                    {{ $index * 0.1 }}
                    s;
            }

        @endforeach

        /* Custom Table Styling */
        .table-modern thead th {
            background-color: #1572e8 !important;
            /* Biru KaiAdmin */
            color: white !important;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            border: none !important;
            padding: 15px !important;
        }

        .table-modern tbody td {
            padding: 15px !important;
            vertical-align: middle !important;
            border-bottom: 1px solid #f1f1f1 !important;
            transition: all 0.2s ease;
        }

        .table-modern tbody tr:hover td {
            background-color: #fbfcff !important;
        }

        /* Poster Thumbnail Effect */
        .poster-img {
            width: 45px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            cursor: zoom-in;
        }

        .poster-img:hover {
            transform: scale(2.5);
            z-index: 100;
            position: relative;
        }

        /* Badge Custom */
        .badge-peserta {
            background: #e1fcef;
            color: #15b763;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 50px;
        }

        /* Tombol Aksi */
        .btn-action-custom {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.3s;
            margin: 0 2px;
        }
    </style>
@endsection