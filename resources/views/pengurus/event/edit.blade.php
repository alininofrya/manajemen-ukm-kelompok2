@extends('layouts.master')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Event</div>
                    </div>
                    <form action="{{ route('pengurus.event.update', $event->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_event">Nama Event</label>
                                        <input type="text" class="form-control" id="nama_event" name="nama_event"
                                            value="{{ old('nama_event', $event->nama_event) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Event</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                                            value="{{ old('tanggal', $event->tanggal) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lokasi">Lokasi</label>
                                        <input type="text" class="form-control" id="lokasi" name="lokasi"
                                            value="{{ old('lokasi', $event->lokasi) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi Event</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $event->deskripsi) }}</textarea>
                                    </div>
                                    <input type="file" class="form-control" id="poster" name="poster"
                                        accept=".jpg,.jpeg,.png">

                                    @error('poster')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    <small class="text-muted">
                                        Poster saat ini: {{ $event->poster }}
                                    </small>

                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            <a href="{{ route('pengurus.event.index') }}" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
