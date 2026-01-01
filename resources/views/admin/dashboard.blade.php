@extends('layouts.master')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard Admin</h3>
                <h6 class="op-7 mb-2">Sistem Informasi Manajemen UKM Kampus</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total UKM</p>
                                    <h4 class="card-title">{{ $totalUkm }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-calendar-alt"></i>
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
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Pendaftar Event</p>
                                    <h4 class="card-title">{{ $totalPendaftar }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Mahasiswa</p>
                                    <h4 class="card-title">{{ $totalMahasiswa }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Aktivitas Pendaftaran Terbaru</div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nama Mahasiswa</th>
                                        <th>Event</th>
                                        <th class="text-end">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendaftarTerbaru as $p)
                                        <tr>
                                            <td>{{ $p->user->name }}</td>
                                            <td>
    @if($p->event)
        <span class="badge badge-info">{{ $p->event->nama_event }}</span>
    @else
        <span class="badge badge-secondary">Event Tidak Ditemukan</span>
    @endif
</td>
                                            <td class="text-end">{{ $p->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Belum ada aktivitas pendaftaran.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-round">
                    <div class="card-body">
                        <div class="card-title fw-mediumbold">UKM Baru Bergabung</div>
                        <div class="card-list">
                            @forelse($ukmBaru as $ukm)
                                <div class="item-list">
                                    <div class="info-user ms-3">
                                        <div class="username fw-bold">{{ $ukm->nama_ukm }}</div>
                                        <div class="status text-muted">{{ $ukm->kategori }}</div>
                                    </div>
                                </div>
                                <hr>
                            @empty
                                <p class="text-center">Belum ada UKM terdaftar.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection