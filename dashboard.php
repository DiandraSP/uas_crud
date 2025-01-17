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

  <!-- Main Content Area -->
  <div class="content">
    <section id="pricing" class="pricing section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Produk Asuransi</h2>
        <div><span>Jelajahi</span> <span class="description-title">Produk Asuransi Kami</span></div>
      </div><!-- End Section Title -->

      <div class="container">
    <div class="row gy-4">
        <?php
        // Sample array of insurance products (this could come from a database)
        $products = [
            [
                'id' => 1, // Tambahkan id untuk setiap produk
                'title' => 'Asuransi Kesehatan',
                'description' => 'Perlindungan untuk biaya rawat inap, obat-obatan, dan layanan kesehatan lainnya.',
                'price' => '500.000',
                'features' => [
                    'Perawatan Rawat Inap',
                    'Obat-obatan Ditanggung',
                    'Proteksi Hingga Rp1 Miliar/Tahun',
                    'Perlindungan Keluarga'
                ]
            ],
            [
                'id' => 2, // Tambahkan id untuk setiap produk
                'title' => 'Asuransi Jiwa',
                'description' => 'Memberikan jaminan finansial kepada keluarga Anda dalam kondisi darurat.',
                'price' => '750.000',
                'features' => [
                    'Santunan Jiwa Hingga Rp2 Miliar',
                    'Proteksi Seluruh Dunia',
                    'Pengelolaan Warisan Keluarga',
                    'Perlindungan Keluarga'
                ],
            ],
            [
                'id' => 3, // Tambahkan id untuk setiap produk
                'title' => 'Asuransi Kecelakaan',
                'description' => 'Proteksi finansial dari risiko kecelakaan yang tidak terduga.',
                'price' => '300.000',
                'features' => [
                    'Biaya Pengobatan Ditanggung',
                    'Santunan Kematian Akibat Kecelakaan',
                    'Proteksi Hingga Rp500 Juta',
                    'Rawat Inap'
                ]
            ],
            [
                'id' => 4, // Tambahkan id untuk setiap produk
                'title' => 'Asuransi Ibu Hamil',
                'description' => 'Perlindungan khusus untuk ibu hamil dan bayi dalam kandungan.',
                'price' => '600.000',
                'features' => [
                    'Perawatan Kehamilan',
                    'Proteksi Kelahiran Prematur',
                    'Pengawasan Kesehatan Ibu dan Bayi',
                    'Biaya Persalinan Ditanggung'
                ]
            ],
            [
                'id' => 5, // Tambahkan id untuk setiap produk
                'title' => 'Asuransi Pendidikan',
                'description' => 'Perlindungan biaya pendidikan anak hingga jenjang universitas.',
                'price' => '1.000.000',
                'features' => [
                    'Biaya Sekolah hingga Universitas',
                    'Santunan Pendidikan hingga Rp500 Juta',
                    'Pembayaran Lumpsum untuk Masa Depan',
                    'Proteksi Keluarga'
                ]
            ],
            [
                'id' => 6, // Tambahkan id untuk setiap produk
                'title' => 'Asuransi Mobil',
                'description' => 'Perlindungan untuk kendaraan pribadi Anda dari risiko kecelakaan dan pencurian.',
                'price' => '400.000',
                'features' => [
                    'Perlindungan Kerusakan Mobil',
                    'Biaya Penggantian Kendaraan',
                    'Proteksi hingga Rp1 Miliar',
                    'Pencurian Mobil'
                ]
            ]
        ];

        // Loop through the products and display them
        foreach ($products as $product) {
            echo '<div class="col-lg-4" data-aos="zoom-in">';
            echo '<div class="pricing-item">';
            echo '<h3>' . $product['title'] . '</h3>';
            echo '<p class="description">' . $product['description'] . '</p>';
            echo '<h4><sup>Rp</sup>' . $product['price'] . '<span> / bulan</span></h4>';

            // Tombol Pilih Paket yang mengarahkan ke halaman order.php
            echo '<a href="add.php?product_id=' . $product['id'] . '&title=' . urlencode($product['title']) . '&price=' . $product['price'] . '" class="cta-btn">Pilih Paket</a>';

            echo '<ul>';
            foreach ($product['features'] as $feature) {
                echo '<li><i class="bi bi-check"></i> <span>' . $feature . '</span></li>';
            }
            echo '</ul>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
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

