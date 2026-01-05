@extends('layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card border-0 shadow-sm col-md-8 mx-auto">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0">Form Pendaftaran Event: {{ $event->nama_event }}</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <small><i class="fas fa-info-circle"></i> Silakan upload berkas persyaratan (KTM/Surat Izin) dalam
                            format PDF atau Gambar.</small>
                    </div>

                    <form action="{{ route('mahasiswa.event.simpan', $event->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <div class="form-group">
                                <label>Alasan Mendaftar</label>
                                <textarea name="alasan" class="form-control" rows="4" placeholder="Tuliskan alasan kamu mengikuti event ini..."
                                    required></textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ url('/') }}" class="btn btn-light rounded-pill px-4">Kembali</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Kirim Pendaftaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
