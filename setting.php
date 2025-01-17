<?php
// Mulai sesi
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

// Ambil ID pengguna dari session
$id = $_SESSION['id'];

// Sertakan file konfigurasi database
include('config.php');

// Query untuk mengambil data pengguna berdasarkan ID
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Cek apakah data pengguna ditemukan
if (!$user) {
    echo "Pengguna tidak ditemukan.";
    exit;
}

// Proses pembaruan data pengguna jika ada permintaan POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi data input
    $nama = htmlspecialchars(trim($_POST['nama']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? $_POST['email'] : '';
    $no_hp = htmlspecialchars(trim($_POST['no_hp']));
    $tanggal_lahir = htmlspecialchars(trim($_POST['tanggal_lahir']));
    $domisili = htmlspecialchars(trim($_POST['domisili']));
    $role = htmlspecialchars(trim($_POST['role']));
    $foto_profil = $user['foto_profil']; // Default ke foto lama

    // Validasi email
    if (!$email) {
        echo "Email tidak valid.";
        exit;
    }

    // Proses upload foto profil jika ada file baru
    if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] === 0) {
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $max_size = 2 * 1024 * 1024; // 2 MB
        $file_ext = strtolower(pathinfo($_FILES['foto_profil']['name'], PATHINFO_EXTENSION));
        $file_size = $_FILES['foto_profil']['size'];

        if (!in_array($file_ext, $allowed_extensions)) {
            echo "Ekstensi file tidak diizinkan.";
            exit;
        }

        if ($file_size > $max_size) {
            echo "Ukuran file terlalu besar.";
            exit;
        }

        $target_dir = "uploads/";

        // Pastikan folder uploads ada dan memiliki izin tulis
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0755, true)) {
                echo "Gagal membuat folder 'uploads'.";
                exit;
            }
        }

        // Menggunakan nama file unik untuk menghindari duplikasi
        $new_filename = uniqid() . '.' . $file_ext;
        $target_file = $target_dir . $new_filename;

        // Coba untuk memindahkan file yang di-upload
        if (move_uploaded_file($_FILES['foto_profil']['tmp_name'], $target_file)) {
            $foto_profil = $target_file;
        } else {
            echo "Gagal mengunggah file.";
            exit;
        }
    }

    // Query untuk memperbarui data pengguna
    $update_query = "UPDATE users SET 
                     nama = ?, 
                     email = ?, 
                     no_hp = ?, 
                     tanggal_lahir = ?, 
                     domisili = ?, 
                     role = ?, 
                     foto_profil = ? 
                     WHERE id = ?";
    $stmt = $con->prepare($update_query);
    $stmt->bind_param(
        "sssssssi",
        $nama,
        $email,
        $no_hp,
        $tanggal_lahir,
        $domisili,
        $role,
        $foto_profil,
        $id
    );

    if ($stmt->execute()) {
        // Redirect kembali ke setting.php
        header('Location: setting.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!-- HTML form di bawah ini tetap sama -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Pengaturan Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Pengaturan Akun</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No. HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($user['no_hp']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo htmlspecialchars($user['tanggal_lahir']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="domisili" class="form-label">Domisili</label>
                <textarea class="form-control" id="domisili" name="domisili" required><?php echo htmlspecialchars($user['domisili']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="foto_profil" class="form-label">Foto Profil</label>
                <input type="file" class="form-control" id="foto_profil" name="foto_profil">
                <?php if ($user['foto_profil']) : ?>
                    <img src="<?php echo $user['foto_profil']; ?>" alt="Foto Profil" class="img-thumbnail mt-3" width="150">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui Data</button>
        </form>
    </div>
</body>




!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Pengaturan Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    .container {
    max-width: 800px;
    margin-top: 50px;
    margin-left: auto;
    margin-right: auto;
}

  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <button class="toggle-btn" id="sidebarToggle"><i class="bi bi-list"></i></button>
    <div class="logo">
      <i class=""></i> <!-- Optionally, you can place your logo here -->
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

  <!-- Content Section -->
  <div class="content">
    <h2></h2>
    <!-- Your Settings Form or Content Here -->
  </div>

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
