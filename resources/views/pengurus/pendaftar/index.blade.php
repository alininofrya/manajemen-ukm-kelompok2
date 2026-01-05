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
                                            <th class="border-0" style="width: 30%;">Alasan Mendaftar</th>
                                            <th class="border-0">Status</th>
                                            <th class="border-0 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (session('error'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Gagal!</strong> {{ session('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        @if (session('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Berhasil!</strong> {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
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
                                                    <div class="d-flex flex-column">
                                                        <span class="text-muted small fst-italic">
                                                            "{{ Str::limit($data->berkas, 50) }}"
                                                        </span>
                                                        @if(strlen($data->berkas) > 50)
                                                            <a href="#" class="text-primary small mt-1" data-bs-toggle="modal" data-bs-target="#modalAlasan{{ $data->id }}">
                                                                [Baca Selengkapnya]
                                                            </a>

                                                            <div class="modal fade" id="modalAlasan{{ $data->id }}" tabindex="-1" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title fw-bold">Alasan {{ $data->user->name }}</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p class="text-dark">{{ $data->berkas }}</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                {{-- SELESAI UBAH --}}

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
