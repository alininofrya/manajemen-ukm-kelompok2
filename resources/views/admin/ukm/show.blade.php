@extends('layouts.master')

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Detail UKM: {{ $ukm->nama_ukm }}</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="fas fa-chevron-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.ukm.index') }}">Daftar UKM</a>
            </li>
            <li class="separator">
                <i class="fas fa-chevron-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Detail Anggota</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Struktur Pengurus & Anggota</h4>
                        <a href="{{ route('admin.ukm.index') }}" class="btn btn-primary btn-round ms-auto">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <p class="mb-0 text-muted">Pembina:</p>
                            <p class="fw-bold text-uppercase">{{ $ukm->pembina }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-0 text-muted">Kategori:</p>
                            <p class="fw-bold text-uppercase">{{ $ukm->kategori }}</p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-head-bg-info">
                            <thead>
                                <tr>
                                    <th style="width: 10%">No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Jabatan</th>
                                    <th>Email Kampus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ukm->members as $index => $member)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $member->user->name }}</td>
                                        <td>
                                            <span class="badge badge-success">{{ $member->jabatan }}</span>
                                        </td>
                                        <td>{{ $member->user->email }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            <img src="https://via.placeholder.com/150?text=No+Data" alt="no-data" class="mb-3"
                                                style="opacity: 0.5;">
                                            <p class="text-muted">Belum ada pengurus atau anggota yang terdaftar di UKM ini.</p>
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
@endsection