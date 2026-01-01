@extends('layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        
        <div class="row mb-4">
            <div class="col-md-12">
                <h4 class="fw-bold">Selamat Datang, {{ auth()->user()->name }}!</h4>
                <p class="text-muted">Pantau status pendaftaran event kamu di sini.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card card-stats card-round border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Event Saya</p>
                                    <h4 class="card-title">{{ $myEvents->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Riwayat Pendaftaran Event</h5>
                <a href="{{ url('/') }}" class="btn btn-primary btn-sm rounded-pill">Daftar Event Baru</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>EVENT</th>
                                <th>PENYELENGGARA</th>
                                <th>STATUS</th>
                                <th>TANGGAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($myEvents as $item)
                            <tr>
                                <td class="fw-bold">{{ $item->event->nama_event }}</td>
                                <td>{{ $item->event->ukm->nama_ukm }}</td>
                                <td>
                                    @if($item->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($item->status == 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @else
                                        <span class="badge bg-danger text-white">Ditolak</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Kamu belum mendaftar di event manapun.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h5 class="fw-bold mt-5 mb-3">Daftar Organisasi (UKM)</h5>
        <div class="row">
            @foreach($ukms as $ukm)
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="fw-bold text-primary">{{ $ukm->nama_ukm }}</h6>
                        <p class="small text-muted mb-0">{{ Str::limit($ukm->deskripsi, 100) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection