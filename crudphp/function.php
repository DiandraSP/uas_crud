<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "divaksin2");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Fungsi untuk query data
function query($sql) {
    global $koneksi;

    echo "Running query: $sql<br>"; // Untuk memastikan query yang dijalankan
    $result = mysqli_query($koneksi, $sql);

    if (!$result) {
        die("Query error: " . mysqli_error($koneksi));
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


// Fungsi untuk mendapatkan semua data dari tabel `user`
function getUsers() {
    return query("SELECT * FROM user");
}

// Fungsi untuk menambahkan user baru
function tambahUser($data) {
    global $koneksi;

    $username = htmlspecialchars($data['username']);
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $role = htmlspecialchars($data['role']);

    $sql = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')";
    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

// Fungsi untuk menghapus user berdasarkan ID
function hapusUser($id) {
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM user WHERE id = '$id'");
    return mysqli_affected_rows($koneksi);
}

// Fungsi untuk memperbarui data user
function ubahUser($data) {
    global $koneksi;

    $id = $data['id'];
    $username = htmlspecialchars($data['username']);
    $role = htmlspecialchars($data['role']);
    $password = $data['password'] ? password_hash($data['password'], PASSWORD_DEFAULT) : null;

    if ($password) {
        $sql = "UPDATE user SET username = '$username', password = '$password', role = '$role' WHERE id = '$id'";
    } else {
        $sql = "UPDATE user SET username = '$username', role = '$role' WHERE id = '$id'";
    }

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

// Fungsi untuk mendapatkan semua data dari tabel `pasien`
function getPasiens() {
    return query("SELECT * FROM pasien"); // Pastikan nama tabel sesuai
}

// Fungsi untuk menambahkan pasien baru
function tambahPasien($data) {
    global $koneksi;

    $nik = htmlspecialchars($data['nik']);
    $nama = htmlspecialchars($data['nama']);
    $tanggal_lahir = $data['tanggal_lahir'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $alamat = htmlspecialchars($data['alamat']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $status_vaksin = $data['status_vaksin'];
    $tanggal_vaksin = $data['tanggal_vaksin'] ? $data['tanggal_vaksin'] : null;
    $jenis_vaksin = htmlspecialchars($data['jenis_vaksin']);

    // Memasukkan data pasien ke dalam database
    $sql = "INSERT INTO pasien (nik, nama, tanggal_lahir, jenis_kelamin, alamat, no_hp, status_vaksin, tanggal_vaksin, jenis_vaksin) 
            VALUES ('$nik', '$nama', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$no_hp', '$status_vaksin', '$tanggal_vaksin', '$jenis_vaksin')";

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

// Fungsi untuk menghapus pasien berdasarkan ID
function hapusPasien($id) {
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM pasien WHERE id = '$id'");
    return mysqli_affected_rows($koneksi);
}

// Fungsi untuk memperbarui data pasien
function ubahPasien($data) {
    global $koneksi;

    $id = $data['id'];
    $nik = htmlspecialchars($data['nik']);
    $nama = htmlspecialchars($data['nama']);
    $tanggal_lahir = $data['tanggal_lahir'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $alamat = htmlspecialchars($data['alamat']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $status_vaksin = $data['status_vaksin'];
    $tanggal_vaksin = $data['tanggal_vaksin'] ? $data['tanggal_vaksin'] : null;
    $jenis_vaksin = htmlspecialchars($data['jenis_vaksin']);

    // Memperbarui data pasien di database
    $sql = "UPDATE pasien 
            SET nik = '$nik', nama = '$nama', tanggal_lahir = '$tanggal_lahir', jenis_kelamin = '$jenis_kelamin', 
                alamat = '$alamat', no_hp = '$no_hp', status_vaksin = '$status_vaksin', 
                tanggal_vaksin = '$tanggal_vaksin', jenis_vaksin = '$jenis_vaksin'
            WHERE id = '$id'";

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}
?>
