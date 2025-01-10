<?php
// Mulai sesi
session_start();

// Jika pengguna belum login, redirect ke login.php
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil file function.php
require 'function.php';

// Proses tambah data
if (isset($_POST['simpan'])) {
    // Memanggil fungsi tambah dan memeriksa apakah data berhasil ditambahkan
    if (tambahUser($_POST) > 0) {
        echo "<script>
                alert('Data pasien berhasil ditambahkan!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data pasien gagal ditambahkan!');
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
    <title>Tambah Data Pasien</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
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

    <!-- Main Content -->
    <div class="container">
        <div class="row my-4">
            <div class="col-md">
                <h3 class="text-light text-uppercase">Tambah Data Pasien</h3>
                <hr class="bg-light">
            </div>
        </div>

        <div class="row">
            <div class="col-md text-light">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="number" class="form-control w-50" id="nik" name="nik" placeholder="Masukkan NIK"
                            min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control w-50" id="nama" name="nama" placeholder="Masukkan Nama"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="tmpt_Lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control w-50" id="tmpt_Lahir" name="tmpt_Lahir"
                            placeholder="Masukkan Tempat Lahir" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_Lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control w-50" id="tgl_Lahir" name="tgl_Lahir" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jekel" id="Laki-Laki" value="Laki-Laki"
                                required>
                            <label class="form-check-label" for="Laki-Laki">Laki-Laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jekel" id="Perempuan" value="Perempuan">
                            <label class="form-check-label" for="Perempuan">Perempuan</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Mail</label>
                        <input type="email" class="form-control w-50" id="email" name="email" placeholder="Masukkan Email"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control w-50" id="telepon" name="telepon"
                            placeholder="Masukkan No. Telepon" required>
                    </div>
                    <div class="mb-3">
                        <label for="vaksin" class="form-label">Jenis Vaksin</label>
                        <select class="form-select w-50" id="vaksin" name="vaksin" required>
                            <option disabled selected value="">Pilih Jenis Vaksin</option>
                            <option value="Sinovac">Sinovac</option>
                            <option value="AstraZeneca">AstraZeneca</option>
                            <option value="Moderna">Moderna</option>
                            <option value="Pfizer">Pfizer</option>
                            <option value="Sinopharm">Sinopharm</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control w-50" id="alamat" name="alamat" rows="5"
                            placeholder="Masukkan Alamat" required></textarea>
                    </div>
                    <hr>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Main Content -->

    <!-- Footer -->
    <footer class="text-center text-white bg-dark py-3">
        <p>© 2025 Sistem Admin Data Pasien</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
