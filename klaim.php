




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