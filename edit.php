<?php
include('config.php');

// Pastikan ID produk diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM produk WHERE product_id = '$id'";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        echo "Produk tidak ditemukan.";
        exit;
    }

    // Proses update data produk
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama_polis = $_POST['nama_polis'];
        $price = $_POST['price'];
        $jumlah_asuransi = $_POST['jumlah_asuransi'];
        $premi = $_POST['premi'];
        $metode_pembayaran = $_POST['metode_pembayaran'];
        $alamat_nasabah = $_POST['alamat_nasabah'];
        $nomor_telepon = $_POST['nomor_telepon'];

        $update_query = "UPDATE produk SET 
                         nama_polis='$nama_polis', 
                         price='$price', 
                         jumlah_asuransi='$jumlah_asuransi', 
                         premi='$premi', 
                         metode_pembayaran='$metode_pembayaran', 
                         alamat_nasabah='$alamat_nasabah', 
                         nomor_telepon='$nomor_telepon' 
                         WHERE product_id='$id'";

        if (mysqli_query($con, $update_query)) {
            header('Location: order.php');
            exit;
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
} else {
    echo "ID produk tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        input[readonly] {
            background-color: #f9f9f9;
        }
        textarea {
            resize: vertical;
        }
        button {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
    <script>
        // Data produk dari dashboard
        const produkData = {
            "Asuransi Kesehatan": 500000,
            "Asuransi Jiwa": 750000,
            "Asuransi Kecelakaan": 300000,
            "Asuransi Ibu Hamil": 600000,
            "Asuransi Pendidikan": 1000000,
            "Asuransi Mobil": 400000
        };

        // Fungsi untuk memperbarui nama polis dan harga premi
        function updateProdukInfo() {
            const selectProduk = document.getElementById('select_produk');
            const namaPolisInput = document.getElementById('nama_polis');
            const priceInput = document.getElementById('price');

            // Ambil data dari pilihan dropdown
            const selectedProduk = selectProduk.value;
            namaPolisInput.value = selectedProduk;
            priceInput.value = produkData[selectedProduk];
        }

        // Set initial values from the database
        window.onload = function() {
            updateProdukInfo();
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Edit Produk</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="select_produk">Pilih Produk</label>
                <select name="select_produk" id="select_produk" onchange="updateProdukInfo()" required>
                    <option value="" disabled>Pilih Produk</option>
                    <option value="Asuransi Kesehatan" <?= $product['nama_polis'] == 'Asuransi Kesehatan' ? 'selected' : '' ?>>Asuransi Kesehatan</option>
                    <option value="Asuransi Jiwa" <?= $product['nama_polis'] == 'Asuransi Jiwa' ? 'selected' : '' ?>>Asuransi Jiwa</option>
                    <option value="Asuransi Kecelakaan" <?= $product['nama_polis'] == 'Asuransi Kecelakaan' ? 'selected' : '' ?>>Asuransi Kecelakaan</option>
                    <option value="Asuransi Ibu Hamil" <?= $product['nama_polis'] == 'Asuransi Ibu Hamil' ? 'selected' : '' ?>>Asuransi Ibu Hamil</option>
                    <option value="Asuransi Pendidikan" <?= $product['nama_polis'] == 'Asuransi Pendidikan' ? 'selected' : '' ?>>Asuransi Pendidikan</option>
                    <option value="Asuransi Mobil" <?= $product['nama_polis'] == 'Asuransi Mobil' ? 'selected' : '' ?>>Asuransi Mobil</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_polis">Nama Polis</label>
                <input type="text" name="nama_polis" id="nama_polis" value="<?= $product['nama_polis'] ?>" readonly required>
            </div>
            <div class="form-group">
                <label for="price">Harga Premi</label>
                <input type="number" name="price" id="price" value="<?= $product['price'] ?>" readonly required>
            </div>
            <div class="form-group">
                <label for="jumlah_asuransi">Jumlah Asuransi</label>
                <input type="number" name="jumlah_asuransi" id="jumlah_asuransi" value="<?= $product['jumlah_asuransi'] ?>" min="1" required>
            </div>
            <div class="form-group">
                <label for="premi">Premi</label>
                <select name="premi" id="premi" required>
                    <option value="bulanan" <?= $product['premi'] == 'bulanan' ? 'selected' : '' ?>>Bulanan</option>
                    <option value="3bulan" <?= $product['premi'] == '3bulan' ? 'selected' : '' ?>>3 Bulan</option>
                    <option value="6bulan" <?= $product['premi'] == '6bulan' ? 'selected' : '' ?>>6 Bulan</option>
                    <option value="1tahun" <?= $product['premi'] == '1tahun' ? 'selected' : '' ?>>1 Tahun</option>
                </select>
            </div>
            <div class="form-group">
                <label for="metode_pembayaran">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" required>
                    <option value="cash" <?= $product['metode_pembayaran'] == 'cash' ? 'selected' : '' ?>>Cash</option>
                    <option value="transferbank" <?= $product['metode_pembayaran'] == 'transferbank' ? 'selected' : '' ?>>Transfer Bank</option>
                    <option value="ovo" <?= $product['metode_pembayaran'] == 'ovo' ? 'selected' : '' ?>>OVO</option>
                    <option value="gopay" <?= $product['metode_pembayaran'] == 'gopay' ? 'selected' : '' ?>>GoPay</option>
                    <option value="kartu kredit" <?= $product['metode_pembayaran'] == 'kartu kredit' ? 'selected' : '' ?>>Kartu Kredit</option>
                </select>
            </div>
            <div class="form-group">
                <label for="alamat_nasabah">Alamat Nasabah</label>
                <textarea name="alamat_nasabah" id="alamat_nasabah" rows="3" required><?= $product['alamat_nasabah'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" id="nomor_telepon" value="<?= $product['nomor_telepon'] ?>" required>
            </div>
            <button type="submit">Simpan Data</button>
        </form>
    </div>
</body>
</html>
