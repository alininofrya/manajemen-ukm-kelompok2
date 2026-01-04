<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKM Basket</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('assets/css/ukm/basket.css') }}" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <!-- GAMBAR + DESKRIPSI -->
        <div class="ukm-header text-center">
            <img src="{{ asset('assets/img/services/Basket.webp') }}" alt="UKM Basket">
        </div>

        <div class="ukm-info-box">
            <h3>UKM Basket</h3>
            <p>
                UKM Basket adalah wadah bagi mahasiswa yang ingin mengembangkan kemampuan bermain basket,
                meningkatkan fisik, belajar teamwork, serta mengikuti berbagai kompetisi antar universitas.
            </p>

            <p><strong>Jadwal Latihan: </strong>Setiap Selasa & Kamis, pukul 16:00 – 18:00</p>
        </div>

        <div class="join-form">
            <h4 class="fw-bold mb-3">Form Pendaftaran UKM Basket</h4>

            <form action="{{ route('ukm.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- NAMA -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <!-- KELAS -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kelas</label>
                    <input type="text" name="kelas" class="form-control" placeholder="Contoh: 2 TI D" required>
                </div>

                <!-- POSISI -->
                <div class="mb-3">
                    <label for="form-label fw-semibold">Posisi Pertama</label>
                    <select name="posisi" class="form-control" required>
                        <option value="">Pilih Posisi</option>
                        <option value="Point Guard (PG)">Point Guard (PG)</option>
                        <option value="Shooting Guard (SG)">Shooting Guard (SG)</option>
                        <option value="Small Forward (SF)">Small Forward (SF)</option>
                        <option value="Power Forward (PF)">Power Forward (PF)</option>
                        <option value="Center (C)">Center (C)</option>
                    </select>
                </div>

                <!-- POSISI -->
                <div class="mb-3">
                    <label for="form-label fw-semibold">Posisi Kedua yang berbeda</label>
                    <select name="posisi2" class="form-control" required>
                        <option value="">Pilih Posisi</option>
                        <option value="Point Guard (PG)">Point Guard (PG)</option>
                        <option value="Shooting Guard (SG)">Shooting Guard (SG)</option>
                        <option value="Small Forward (SF)">Small Forward (SF)</option>
                        <option value="Power Forward (PF)">Power Forward (PF)</option>
                        <option value="Center (C)">Center (C)</option>
                    </select>
                </div>

                <!-- TUJUAN -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tujuan Mengikuti UKM</label>
                    <textarea name="tujuan" class="form-control" rows="4" required
                        placeholder="Ceritakan alasan kamu ingin bergabung..."></textarea>
                </div>

                <button type="submit" class="btn btn-join w-100">Gabung UKM Basket</button>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
