@extends('layouts.master')

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Manajemen UKM</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#"><i class="fas fa-home"></i></a>
            </li>
            <li class="separator"><i class="fas fa-chevron-right"></i></li>
            <li class="nav-item">
                <a href="{{ route('ukm.index') }}">Daftar UKM</a>
            </li>
            <li class="separator"><i class="fas fa-chevron-right"></i></li>
            <li class="nav-item">
                <a href="#">Edit UKM</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Edit Data UKM</div>
                </div>
                <form action="{{ route('ukm.update', $ukm->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="nama_ukm">Nama UKM</label>
                                    <input type="text" class="form-control" id="nama_ukm" name="nama_ukm"
                                        value="{{ $ukm->nama_ukm }}" required />
                                </div>

                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-select" id="kategori" name="kategori" required>
                                        <option value="Olahraga" {{ $ukm->kategori == 'Olahraga' ? 'selected' : '' }}>Olahraga
                                        </option>
                                        <option value="Seni" {{ $ukm->kategori == 'Seni' ? 'selected' : '' }}>Seni</option>
                                        <option value="Akademik" {{ $ukm->kategori == 'Akademik' ? 'selected' : '' }}>Akademik
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="pembina">Nama Pembina</label>
                                    <input type="text" class="form-control" id="pembina" name="pembina"
                                        value="{{ $ukm->pembina }}" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                        <a href="{{ route('ukm.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection