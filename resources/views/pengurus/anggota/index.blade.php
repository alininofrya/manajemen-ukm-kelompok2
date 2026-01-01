@extends('layouts.master')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-center justify-content-between pt-2 pb-4 fade-in-up">
            <div>
                <h3 class="fw-bold mb-1">Daftar Anggota {{ $ukm->nama_ukm }}</h3>
                <p class="text-muted small mb-0">Kelola data anggota dan jabatan di bawah naungan UKM Anda.</p>
            </div>
            <button class="btn btn-primary btn-round shadow" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota">
                <i class="fa fa-plus-circle me-1"></i> Tambah Anggota
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 fade-in-up" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row fade-in-up" style="animation-delay: 0.2s">
            <div class="col-md-12">
                <div class="card card-member border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-modern mb-0">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Email</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($anggota as $row)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-initial me-3">
                                                        {{ strtoupper(substr($row->user->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <span class="fw-bold text-dark">{{ $row->user->name }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge-soft {{ strtolower($row->jabatan) == 'ketua' ? 'badge-ketua' : 'badge-anggota' }}">
                                                    <i class="fas {{ strtolower($row->jabatan) == 'ketua' ? 'fa-crown' : 'fa-user' }} me-1"></i>
                                                    {{ $row->jabatan }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-muted">
                                                    <i class="far fa-envelope me-2"></i>{{ $row->user->email }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button class="btn-action-custom text-info" data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit{{ $row->id }}" title="Edit Anggota">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <form action="{{ route('pengurus.anggota.destroy', $row->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-action-custom text-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')"
                                                            title="Hapus Anggota">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modalEdit{{ $row->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header border-0">
                                                        <h5 class="modal-title fw-bold text-primary">
                                                            <i class="fas fa-user-edit me-2"></i>Edit Data Anggota
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('pengurus.anggota.update', $row->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group mb-3 text-start">
                                                                <label class="form-label fw-bold">Nama Lengkap</label>
                                                                <input type="text" name="name" class="form-control" value="{{ $row->user->name }}" required>
                                                            </div>
                                                            
                                                            <div class="form-group mb-3 text-start">
                                                                <label class="form-label fw-bold">Email</label>
                                                                <input type="email" name="email" class="form-control" value="{{ $row->user->email }}" required>
                                                            </div>

                                                            <div class="form-group mb-3 text-start">
                                                                <label class="form-label fw-bold">Jabatan</label>
                                                                <input type="text" name="jabatan" class="form-control" value="{{ $row->jabatan }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary px-4 shadow">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <p class="text-muted">Belum ada anggota yang terdaftar.</p>
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

    <div class="modal fade" id="modalTambahAnggota" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold text-primary">Tambah Anggota Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pengurus.anggota.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3 text-start">
                            <label class="form-label fw-bold">Pilih Mahasiswa</label>
                            <select name="user_id" class="form-control" required>
                                <option value="" disabled selected>Pilih Mahasiswa</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3 text-start">
                            <label class="form-label fw-bold">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Sekretaris, Anggota" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 shadow">Daftarkan Anggota</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .btn-action-custom {
            background: none;
            border: none;
            font-size: 1.1rem;
            transition: transform 0.2s ease;
            cursor: pointer;
            padding: 5px;
        }

        .btn-action-custom:hover {
            transform: scale(1.2);
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out backwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .table tbody tr {
            opacity: 0;
            animation: fadeInUp 0.5s ease-out forwards;
        }

        @for ($i = 1; $i <= 20; $i++)
            .table tbody tr:nth-child({{ $i }}) {
                animation-delay: {{ 0.1 + ($i * 0.05) }}s;
            }
        @endfor

        .card-member {
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .table-modern thead th {
            background-color: #f8f9fb !important;
            color: #8898aa !important;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 1px;
            padding: 15px 20px !important;
            border: none !important;
        }

        .table-modern tbody td {
            padding: 18px 20px !important;
            vertical-align: middle;
            border-bottom: 1px solid #f6f9fc;
        }

        .table-modern tbody tr:hover {
            background-color: #fbfcff;
            transition: 0.3s;
        }

        .avatar-initial {
            width: 35px;
            height: 35px;
            background: #eef2ff;
            color: #4338ca;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-weight: bold;
            font-size: 13px;
        }

        .badge-soft {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-ketua { background-color: #f0f7ff; color: #007bff; }
        .badge-anggota { background-color: #f0fff4; color: #28a745; }
        
        /* Form Label Styling */
        .form-label { color: #525f7f; font-size: 0.9rem; }
    </style>
@endsection