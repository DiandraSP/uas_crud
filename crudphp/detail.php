<?php
// Memanggil atau membutuhkan file function.php
require 'function.php';

// Jika dataPasien diklik maka
if (isset($_POST['dataPasien'])) {
    $output = '';

    // Mengambil data pasien berdasarkan NIK yang dikirimkan melalui POST
    $nik = htmlspecialchars($_POST['dataPasien']); // Melindungi dari serangan XSS
    $sql = "SELECT * FROM pasien WHERE nik = '$nik'";
    $result = query($sql); // Menggunakan fungsi query() dari function.php

    // Cek apakah data ditemukan
    if (count($result) > 0) {
        $output .= '<div class="table-responsive">
                        <table class="table table-bordered">';

        foreach ($result as $row) {
            $output .= '<tr align="center">
                            <td colspan="2"><img src="img/' . htmlspecialchars($row['gambar']) . '" width="50%"></td>
                        </tr>
                        <tr>
                            <th width="40%">NIK</th>
                            <td width="60%">' . htmlspecialchars($row['nik']) . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Nama</th>
                            <td width="60%">' . htmlspecialchars($row['nama']) . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Tanggal Lahir</th>
                            <td width="60%">' . date("d M Y", strtotime($row['tanggal_lahir'])) . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Jenis Kelamin</th>
                            <td width="60%">' . htmlspecialchars($row['jenis_kelamin']) . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Alamat</th>
                            <td width="60%">' . htmlspecialchars($row['alamat']) . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Nomor HP</th>
                            <td width="60%">' . htmlspecialchars($row['no_hp']) . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Status Vaksin</th>
                            <td width="60%">' . htmlspecialchars($row['status_vaksin']) . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Tanggal Vaksin</th>
                            <td width="60%">' . (!empty($row['tanggal_vaksin']) ? date("d M Y", strtotime($row['tanggal_vaksin'])) : 'Belum divaksin') . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Jenis Vaksin</th>
                            <td width="60%">' . htmlspecialchars($row['jenis_vaksin']) . '</td>
                        </tr>';
        }

        $output .= '</table></div>';
    } else {
        // Jika data tidak ditemukan
        $output = '<div class="alert alert-danger" role="alert">
                        Data pasien dengan NIK <strong>' . htmlspecialchars($nik) . '</strong> tidak ditemukan.
                   </div>';
    }

    // Tampilkan output
    echo $output;
}
