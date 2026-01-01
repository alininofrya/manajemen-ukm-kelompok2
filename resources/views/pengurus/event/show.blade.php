@extends('layouts.master')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Detail Event</h4>
                            <a href="{{ route('pengurus.dashboard') }}" class="btn btn-warning btn-round ml-auto">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/posters/' . $event->poster) }}" class="img-fluid rounded shadow"
                                style="max-height: 400px;">
                        </div>
                        <hr>
                        <h2 class="fw-bold text-primary">{{ $event->nama_event }}</h2>
                        <p class="badge badge-info">{{ $event->ukm->nama_ukm }}</p>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <p><strong><i class="fas fa-calendar"></i> Tanggal:</strong><br>
                                    {{ \Carbon\Carbon::parse($event->tanggal)->format('d F Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong><i class="fas fa-map-marker-alt"></i> Lokasi:</strong><br>
                                    {{ $event->lokasi }}</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <p><strong><i class="fas fa-align-left"></i> Deskripsi:</strong></p>
                            <p style="white-space: pre-line;">{{ $event->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection