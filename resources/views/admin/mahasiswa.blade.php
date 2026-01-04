@extends('layouts.admin')

@section('content')
<div class="container">

    <h2 class="fw-bold mb-4">Data Mahasiswa</h2>

    <div class="card">
        <div class="card-body">

            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Program Studi</th>
                        <th>Email</th>
                        <th>Password (Hashed)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($mahasiswa as $mhs)
                    <tr>
                        <td>{{ $mhs->nim }}</td>
                        <td>{{ $mhs->first_name }} {{ $mhs->last_name }}</td>
                        <td>{{ $mhs->birthday }}</td>
                        <td>{{ $mhs->prodi }}</td>
                        <td>{{ $mhs->email }}</td>
                        <td class="text-muted">{{ $mhs->password }}</td>
                        <td>
                            <a href="{{ route('admin.mahasiswa.edit', $mhs->nim) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                            <form action="{{ route('admin.mahasiswa.delete', $mhs->nim) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
