<?php
// Mulai sesi untuk menyimpan data pengguna setelah login
session_start();

if (isset($_SESSION['id'])) {
    // Jika pengguna sudah login, arahkan ke dashboard
    header('Location: dashboard.php');
    exit;
}

// Include konfigurasi database
include 'config.php';

// Inisialisasi variabel untuk pesan error
$error = '';

// Periksa apakah form login telah dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];

    // Query untuk mengambil data pengguna berdasarkan email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $sql);

    // Periksa apakah email ditemukan
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Login berhasil, simpan data ke sesi
            $_SESSION['id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect ke halaman utama atau dashboard
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Password salah. Silakan coba lagi.';
        }
    } else {
        $error = 'Email tidak ditemukan. Silakan daftar terlebih dahulu.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login - DiandraAsuransi</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #08005e;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      overflow: hidden;
    }

    .form-box {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
    }

    .form-box header {
      font-size: 24px;
      font-weight: 700;
      color: #040677;
      text-align: center;
      margin-bottom: 20px;
    }

    .form-box .field {
      margin-bottom: 15px;
    }

    .form-box .field label {
      font-weight: 500;
      margin-bottom: 5px;
      display: block;
      color: #444444;
    }

    .form-box .field input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-box .field input:focus {
      outline: none;
      border-color: #1acc8d;
    }

    .form-box .btn {
      background-color: #040677;
      color: #ffffff;
      border: none;
      padding: 10px 20px;
      width: 100%;
      border-radius: 5px;
      font-weight: 500;
      transition: 0.3s;
    }

    .form-box .btn:hover {
      background-color: #1acc8d;
    }

    .form-box .links {
      text-align: center;
      margin-top: 15px;
    }

    .form-box .links a {
      color: #1acc8d;
      text-decoration: none;
    }

    .form-box .links a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <!-- Login Section -->
  <div class="form-box">
    <header>Login</header>
    <form action="" method="post">
      <div class="field input">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required autocomplete="off">
      </div>

      <div class="field input">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required autocomplete="off">
      </div>

      <div class="field">
        <input type="submit" class="btn" name="submit" value="Login">
      </div>
      <div class="links">
        Don't have an account? <a href="register.php">Sign Up Now</a>
      </div>
    </form>
  </div>
</body>

</html>
