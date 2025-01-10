<?php
// Memanggil atau membutuhkan file function.php
require 'function.php';

// Menampilkan semua data dari tabel pasien berdasarkan NIK secara Descending
$pasien = query("SELECT * FROM pasien ORDER BY nik DESC");

// Membuat nama file
$filename = "data_pasien_" . date('Ymd') . ".xls";

// Header untuk export ke Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$filename");

?>
<table border="1">
    <thead>
        <tr>
            <th>No.</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Tempat dan Tanggal Lahir</th>
            <th>Umur</th>
            <th>Jenis Kelamin</th>
            <th>E-Mail</th>
            <th>No. Telepon</th>
            <th>Jenis Vaksin</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($pasien)) : ?>
            <?php $no = 1; ?>
            <?php foreach ($pasien as $row) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= isset($row['nik']) ? "'" . $row['nik'] : ''; ?></td>
                    <td><?= isset($row['nama']) ? $row['nama'] : ''; ?></td>
                    <td>
                        <?= isset($row['tmpt_Lahir']) ? $row['tmpt_Lahir'] : ''; ?>, 
                        <?= isset($row['tgl_Lahir']) ? $row['tgl_Lahir'] : ''; ?>
                    </td>
                    <td>
                        <?php
                        if (isset($row['tgl_Lahir'])) {
                            $now = time();
                            $timeTahun = strtotime($row['tgl_Lahir']);
                            $setahun = 31536000; // 1 tahun dalam detik
                            $umur = ($now - $timeTahun) / $setahun;
                            echo floor($umur) . ' Tahun';
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                    <td><?= isset($row['jekel']) ? $row['jekel'] : ''; ?></td>
                    <td><?= isset($row['email']) ? $row['email'] : ''; ?></td>
                    <td><?= isset($row['telepon']) ? $row['telepon'] : ''; ?></td>
                    <td><?= isset($row['vaksin']) ? $row['vaksin'] : ''; ?></td>
                    <td><?= isset($row['alamat']) ? $row['alamat'] : ''; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="10" style="text-align:center;">Tidak ada data tersedia</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
