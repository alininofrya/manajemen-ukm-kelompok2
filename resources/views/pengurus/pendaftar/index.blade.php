@extends('layouts.master')

@section('content')
    <div class="container fade-in-up">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3 text-primary">
                    <i class="fas fa-user-edit me-2"></i>Kelola Pendaftar Event
                </h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="{{ route('pengurus.dashboard') }}"><i class="fas fa-home"></i></a></li>
                    <li class="separator"><i class="fas fa-chevron-right"></i></li>
                    <li class="nav-item"><a href="#">Pendaftaran</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm border-0 card-round">
                        <div class="card-header bg-white border-bottom-0 pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="card-title fw-bold text-dark">Daftar Mahasiswa yang Mendaftar</div>
                                <span class="badge bg-info shadow-sm">{{ count($pendaftarans) }} Mahasiswa</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="border-0">Nama Mahasiswa</th>
                                            <th class="border-0">Event yang Diikuti</th>
                                            <th class="border-0">Berkas</th>
                                            <th class="border-0">Status</th>
                                            <th class="border-0 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pendaftarans as $data)
                                            <tr>
                                                <td class="fw-bold text-dark">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm me-3">
                                                            <span
                                                                class="avatar-title rounded-circle bg-primary shadow-sm text-white">
                                                                {{ substr($data->user->name, 0, 1) }}
                                                            </span>
                                                        </div>
                                                        {{ $data->user->name }}
                                                    </div>
                                                </td>
                                                <td><span class="text-muted">{{ $data->event->nama_event }}</span></td>
                                                <td>
                                                    @if ($data->berkas)
                                                        <a href="{{ route('pengurus.download', $data->id) }}"
                                                            class="btn btn-sm btn-outline-secondary btn-round">
                                                            <i class="fa fa-download me-1 text-danger"></i> Download Berkas
                                                        </a>
                                                        class="btn btn-sm btn-outline-secondary btn-round">
                                                        <i class="fa fa-file-pdf me-1 text-danger"></i> Lihat Berkas
                                                        </a>
                                                    @else
                                                        <span class="text-danger small fw-bold"><i>Tanpa Berkas</i></span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->status == 'pending')
                                                        <span class="badge bg-warning shadow-sm"><i
                                                                class="fas fa-clock me-1"></i> Menunggu</span>
                                                    @elseif($data->status == 'diterima')
                                                        <span class="badge bg-success shadow-sm"><i
                                                                class="fas fa-check-circle me-1"></i> Diterima</span>
                                                    @else
                                                        <span class="badge bg-danger shadow-sm"><i
                                                                class="fas fa-times-circle me-1"></i> Ditolak</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($data->status == 'pending')
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <form
                                                                action="{{ route('pengurus.pendaftar.update', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="status" value="diterima">
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-success btn-round px-3">
                                                                    Terima
                                                                </button>
                                                            </form>

                                                            <form
                                                                action="{{ route('pengurus.pendaftar.update', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="status" value="ditolak">
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger btn-round px-3">
                                                                    Tolak
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @else
                                                        <span class="text-muted small fw-italic"><i
                                                                class="fa fa-lock me-1"></i> Sudah direspon</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-5">
                                                    <div class="py-4">
                                                        <i class="fas fa-inbox fa-3x text-light mb-3"></i>
                                                        <p class="text-muted fw-bold">Belum ada pendaftar yang masuk ke
                                                            sistem.</p>
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
            </div>
        </div>
    </div>
    <style>
        /* Animasi masuk untuk halaman */
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Efek hover pada baris tabel agar lebih interaktif */
        .table-hover tbody tr {
            transition: all 0.3s ease;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05) !important;
            transform: scale(1.005);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        /* Mempercantik tampilan badge */
        .badge {
            padding: 0.5em 0.8em;
            border-radius: 50px;
            font-weight: 600;
        }
    </style>
@endsection
