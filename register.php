<?php
// Include koneksi database
include 'config.php';

// Periksa apakah form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Enkripsi password
    $no_hp = mysqli_real_escape_string($con, $_POST['no_hp']);
    $tanggal_lahir = mysqli_real_escape_string($con, $_POST['tanggal_lahir']);
    $domisili = mysqli_real_escape_string($con, $_POST['domisili']);
    
    // Cek apakah email sudah terdaftar
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $check_email);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email sudah terdaftar. Silakan gunakan email lain.');</script>";
    } else {
        // Simpan data ke database
        $sql = "INSERT INTO users (nama, email, password, no_hp, tanggal_lahir, domisili)
                VALUES ('$nama', '$email', '$password', '$no_hp', '$tanggal_lahir', '$domisili')";

        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href = 'login.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Register - DiandraAsuransi</title>
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
      min-height: 100vh;
    }

    .form-box {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 500px;
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

    .form-box .field input,
    .form-box .field select,
    .form-box .field textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-box .field input:focus,
    .form-box .field select:focus,
    .form-box .field textarea:focus {
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
  <!-- Register Section -->
  <div class="form-box">
    <header>Register</header>
    <form action="" method="post">
      <div class="field input">
        <label for="nama">Nama Lengkap</label>
        <input type="text" name="nama" id="nama" required>
      </div>

      <div class="field input">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
      </div>

      <div class="field input">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
      </div>

      <div class="field input">
        <label for="no_hp">Nomor HP</label>
        <input type="text" name="no_hp" id="no_hp" required>
      </div>

      <div class="field input">
        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" required>
      </div>

      <div class="field input">
        <label for="domisili">Domisili</label>
        <textarea name="domisili" id="domisili" rows="3" required></textarea>
      </div>

      <div class="field">
        <input type="submit" class="btn" name="submit" value="Register">
      </div>

      <div class="links">
        Already have an account? <a href="login.php">Login Now</a>
      </div>
    </form>
  </div>
</body>

</html>
