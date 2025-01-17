<?php
include('config.php');

// Ambil data dari tabel produk
$query = "SELECT * FROM produk";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 50px auto;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            margin: 0 5px;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-add {
            background-color:rgb(200, 216, 51);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Order Polis Asuransi</h2>
        <!-- Tombol Add untuk menuju ke add.php -->
        <a href="add.php" class="btn btn-add">Add Polis</a>
        <table>
            <thead>
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Polis</th>
                    <th>Harga Premi</th>
                    <th>Jumlah Asuransi</th>
                    <th>Premi</th>
                    <th>Metode Pembayaran</th>
                    <th>Alamat Nasabah</th>
                    <th>Nomor Telepon</th>
                    <th>Waktu Dibuat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan data produk dalam tabel
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['product_id']}</td>
                                <td>{$row['nama_polis']}</td>
                                <td>Rp " . number_format($row['price'], 2, ',', '.') . "</td>
                                <td>{$row['jumlah_asuransi']}</td>
                                <td>{$row['premi']}</td>
                                <td>{$row['metode_pembayaran']}</td>
                                <td>{$row['alamat_nasabah']}</td>
                                <td>{$row['nomor_telepon']}</td>
                                <td>{$row['created_at']}</td>
                                <td>
                                    <a href='edit.php?id={$row['product_id']}' class='btn'>Edit</a>
                                    <a href='delete.php?id={$row['product_id']}' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus produk ini?\")'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10' style='text-align: center;'>Belum ada data produk</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard - Your Application</title>

  <!-- Link to Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Link to Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    /* Sidebar */
    .sidebar {
      height: 100vh;
      width: 250px;
      background-color: #08005e;
      position: fixed;
      top: 0;
      left: 0;
      padding-top: 10px;
      transition: width 0.3s;
      padding-left: 20px;
    }

    .sidebar.closed {
      width: 80px; /* Narrow sidebar when closed */
    }

    .sidebar a {
      color: white;
      padding: 15px;
      text-decoration: none;
      display: block;
      transition: padding-left 0.3s;
    }

    .sidebar.closed a {
      padding-left: 10px; /* Reduce padding in closed sidebar */
    }

    .sidebar a:hover {
      background-color: #495057;
    }

    .sidebar .nav-item {
      list-style: none;
    }

    .content {
      margin-left: 250px;
      padding: 20px;
      transition: margin-left 0.3s;
    }

    .content.shifted {
      margin-left: 80px; /* Adjust content when sidebar is closed */
    }

    .sidebar .toggle-btn {
      position: absolute;
      top: 5px;
      left: 35px;
      background-color: #08005e;
      border: none;
      color: white;
      font-size: 20px;
      cursor: pointer;
      z-index: 1000;
    }

    .sidebar.closed .nav-link span {
      display: none;
    }

    .sidebar.closed .nav-link i {
      font-size: 24px;
      margin-left: 10px;
    }

    /* Styling for the logo */
    .sidebar .logo {
      font-size: 30px;
      color: white;
      padding-left: 10px;
      padding-top: 20px;
    }

    /* Pricing Section */
    .pricing-item {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .pricing-item h3 {
      font-size: 24px;
    }

    .cta-btn {
      background-color: #08005e;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
    }

    .pricing-item ul {
      list-style-type: none;
      padding: 0;
    }

    .pricing-item ul li {
      font-size: 14px;
      margin: 5px 0;
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <button class="toggle-btn" id="sidebarToggle"><i class="bi bi-list"></i></button>
    <div class="logo">
      <i class=""></i>
    </div>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
          <i class="bi bi-house-door"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="klaim.php">
          <i class="bi bi-file-earmark"></i> <span>Klaim</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="order.php">
          <i class="bi bi-cart"></i> <span>Orders</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="setting.php">
          <i class="bi bi-gear"></i> <span>Settings</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
        </a>
      </li>
    </ul>
  </div>





  </section><!-- End Pricing Section -->
    </div><!-- End Main Content Area -->

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

<script>
  const toggleBtn = document.getElementById('sidebarToggle');
  const sidebar = document.querySelector('.sidebar');
  const content = document.querySelector('.content');

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('closed');
    content.classList.toggle('shifted');
  });
</script>

</body>

</html>