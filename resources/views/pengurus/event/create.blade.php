@extends('layouts.master')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Buat Event Baru</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pengurus.event.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf   
                            <div class="form-group">
                                <label>Nama Event</label>
                                <input type="text" name="nama_event" class="form-group-default form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pelaksanaan</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Upload Poster (Gambar)</label>
                                <input type="file" name="poster" class="form-control-file" accept="image/*" required>
                                <small class="text-muted">Format: JPG, PNG, Max 2MB</small>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Simpan Event</button>
                                <a href="{{ route('pengurus.dashboard') }}" class="btn btn-danger">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection