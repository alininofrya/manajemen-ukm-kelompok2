@extends('layouts.master')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i> <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card border-0 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-white border-0">
                        <h4 class="card-title text-uppercase font-weight-bold">Daftar UKM Kampus</h4>
                        <button class="btn btn-primary btn-round shadow-sm" data-bs-toggle="modal"
                            data-bs-target="#modalTambahUkm">
                            <i class="fa fa-plus"></i> Tambah UKM
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-head-bg-primary">
                                <thead>
                                    <tr>
                                        <th>Nama UKM</th>
                                        <th>Kategori</th>
                                        <th>Pembina</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ukms as $u)
                                        <tr>
                                            <td class="fw-bold">{{ $u->nama_ukm }}</td>
                                            <td>{{ $u->kategori }}</td>
                                            <td>{{ $u->pembina }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ route('admin.ukm.show', $u->id) }}"
                                                        class="btn btn-link btn-info p-2" title="Lihat Anggota">
                                                        <i class="fa fa-users"></i>
                                                    </a>

                                                    <button class="btn btn-link btn-primary p-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit{{ $u->id }}" title="Edit UKM">
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                    <form action="{{ route('admin.ukm.destroy', $u->id) }}" method="POST"
                                                        class="m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link btn-danger p-2"
                                                            onclick="return confirm('Yakin ingin menghapus UKM ini?')"
                                                            title="Hapus">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modalEdit{{ $u->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header border-0">
                                                        <h5 class="modal-title fw-bold">Edit Data UKM</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('admin.ukm.update', $u->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                                <label class="fw-bold text-dark">Nama UKM</label>
                                                                <input type="text" name="nama_ukm" class="form-control"
                                                                    value="{{ $u->nama_ukm }}" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="fw-bold text-dark">Kategori</label>
                                                                <input type="text" name="kategori" class="form-control"
                                                                    value="{{ $u->kategori }}" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="fw-bold text-dark">Pembina</label>
                                                                <input type="text" name="pembina" class="form-control"
                                                                    value="{{ $u->pembina }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary shadow-sm">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahUkm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Tambah UKM Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.ukm.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="fw-bold text-dark">Nama UKM</label>
                            <input type="text" name="nama_ukm" class="form-control" placeholder="Masukkan nama UKM"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="fw-bold text-dark">Kategori</label>
                            <input type="text" name="kategori" class="form-control" placeholder="Contoh: Olahraga / Seni"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="fw-bold text-dark">Pembina</label>
                            <input type="text" name="pembina" class="form-control" placeholder="Nama Pembina UKM" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary shadow-sm">Simpan UKM</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection