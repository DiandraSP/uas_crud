<?php
session_start();

// Jika pengguna tidak login, arahkan ke login.php
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil file function.php
require 'function.php';

// Mengambil data dari tabel pasien secara descending berdasarkan NIK
$pasien = query("SELECT * FROM pasien ORDER BY nik DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Data Vaksinasi</title>
</head>

<body background="">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" href="index.php">Sistem Vaksinasi Covid-19</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
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
    <!-- Close Navbar -->

    <!-- Container -->
    <div class="container">
        <div class="row my-2">
            <div class="col-md">
                <h3 class="text-center fw-bold text-uppercase text-light data_siswa">Data Vaksinasi</h3>
                <hr>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md">
                <a href="addData.php" class="btn btn-primary" data-aos="fade-right" data-aos-duration="800"
                    data-aos-delay="1200"><i class="bi bi-person-plus-fill"></i> Tambah Data</a>
                <a href="export.php" target="_blank" class="btn btn-success ms-1" data-aos="fade-left"
                    data-aos-duration="1000" data-aos-delay="1600"><i class="bi bi-file-earmark-spreadsheet-fill"></i>
                    Ekspor ke Excel</a>
            </div>
        </div>
        <div class="row my-3" data-aos="fade" data-aos-duration="1000" data-aos-delay="2000">
            <div class="col-md">
                <table id="data" class="table table-striped table-responsive table-hover text-center"
                    style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>Status Vaksin</th>
                            <th>Tanggal Vaksin</th>
                            <th>Jenis Vaksin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($pasien as $row) : ?>
                            <tr class="table-secondary text-dark">
                                <td><?= $no++; ?></td>
                                <td><?= $row['nik']; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['tanggal_lahir']; ?></td>
                                <td><?= $row['jenis_kelamin']; ?></td>
                                <td><?= $row['alamat']; ?></td>
                                <td><?= $row['no_hp']; ?></td>
                                <td><?= $row['status_vaksin']; ?></td>
                                <td><?= $row['tanggal_vaksin'] ?: '-'; ?></td>
                                <td><?= $row['jenis_vaksin']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Close Container -->

    <!-- Footer -->
    <div class="container-fluid">
        <div class="row bg-dark text-white text-center">
            <div class="col my-2" id="about">
                <h4 class="fw-bold text-uppercase">About</h4>
                <p>
                <span>&copy;</span> <span>&reg;</span> 2025 by Diandra Satria Pinilih (01202205009)
                </p>
            </div>
        </div>
    </div>
    <!-- Close Footer -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/TextPlugin.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#data').DataTable();
        });

        AOS.init({ once: true });

        gsap.registerPlugin(TextPlugin);
        gsap.to('.data_siswa', { duration: 1, delay: 0.6, text: 'Data Vaksinasi' });
        gsap.from('.navbar', { duration: 1, y: '-100%', opacity: 0, ease: 'bounce' });
    </script>
</body>

</html>
