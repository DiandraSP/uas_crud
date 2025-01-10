<?php
session_start();
// Jika tidak login, arahkan ke login.php
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil file function.php
require 'function.php';

// Mengambil data pasien berdasarkan NIK dari parameter GET
$nik = $_GET['nik'];

// Mengambil data pasien dari database berdasarkan NIK
$pasien = query("SELECT * FROM pasien WHERE nik = '$nik'")[0];

// Jika tombol "Ubah" ditekan
if (isset($_POST['ubah'])) {
    // Jika data berhasil diubah
    if (ubahPasien($_POST) > 0) {
        echo "<script>
                alert('Data pasien berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
    } else {
        // Jika data gagal diubah
        echo "<script>
                alert('Data pasien gagal diubah!');
            </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Ubah Data Pasien</title>
</head>

<body background="img/bg/bck.png">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Sistem Admin Data Pasien</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Container -->
    <div class="container">
        <div class="row mt-3">
            <div class="col-md">
                <h3 class="fw-bold text-uppercase">Ubah Data Pasien</h3>
                <hr>
            </div>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="gambarLama" value="<?= $pasien['gambar']; ?>">
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="number" class="form-control w-50" id="nik" name="nik" value="<?= $pasien['nik']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control w-50" id="nama" name="nama" value="<?= $pasien['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control w-50" id="tanggal_lahir" name="tanggal_lahir"
                    value="<?= $pasien['tanggal_lahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="Laki-Laki"
                        <?= $pasien['jenis_kelamin'] == 'Laki-Laki' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="laki">Laki-Laki</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan"
                        <?= $pasien['jenis_kelamin'] == 'Perempuan' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control w-50" id="alamat" name="alamat" rows="3"><?= $pasien['alamat']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">Nomor HP</label>
                <input type="text" class="form-control w-50" id="no_hp" name="no_hp" value="<?= $pasien['no_hp']; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar <i>(Saat ini)</i></label>
                <br>
                <img src="img/<?= $pasien['gambar']; ?>" width="50%" style="margin-bottom: 10px;">
                <input class="form-control form-control-sm w-50" id="gambar" name="gambar" type="file">
            </div>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-warning" name="ubah">Ubah</button>
        </form>
    </div>
    <!-- End Container -->

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>Sistem Admin Data Pasien &copy; <?= date('Y'); ?></p>
    </footer>
    <!-- End Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
