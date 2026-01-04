<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKM Sepak Bola</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('assets/css/ukm/basket.css') }}" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <!-- GAMBAR + DESKRIPSI -->
        <div class="ukm-header text-center">
            <img src="{{ asset('assets/img/services/Sepak_bola.webp') }}" alt="UKM Basket">
        </div>

        <div class="ukm-info-box">
            <h3>UKM Sepak Bola</h3>
            <p>
                Suka sepak bola? Ayo bergabung dengan UKM Sepak Bola! Di sini kamu bisa latihan bareng, belajar strategi permainan,
                memperluas pertemanan, dan ikut kompetisi seru mewakili kampus.
            </p>

            <p><strong>Jadwal Latihan: </strong>Setiap Senin, pukul 16:00 – 18:00</p>
        </div>

        <div class="join-form">
            <h4 class="fw-bold mb-3">Form Pendaftaran UKM Sepak Bola</h4>

            <form action="#" method="POST" enctype="multipart/form-data">
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
                        <option value="Point Guard (PG)">Kiper</option>
                        <option value="Shooting Guard (SG)">Bek</option>
                        <option value="Small Forward (SF)">Gelandang</option>
                        <option value="Power Forward (PF)">Penyerang</option>
                        <option value="Center (C)">Pemain Sayap</option>
                    </select>
                </div>

                <!-- POSISI -->
                <div class="mb-3">
                    <label for="form-label fw-semibold">Posisi Kedua yang berbeda</label>
                    <select name="posisi" class="form-control" required>
                        <option value="Point Guard (PG)">Kiper</option>
                        <option value="Shooting Guard (SG)">Bek</option>
                        <option value="Small Forward (SF)">Gelandang</option>
                        <option value="Power Forward (PF)">Penyerang</option>
                        <option value="Center (C)">Pemain Sayap</option>
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
