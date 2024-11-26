<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .sidebar {
      width: 250px;
      background-color: #000000;
      color: #fff;
      padding: 20px;
      height: 100vh;
      display: flex;
      flex-direction: column;
      transform: translateX(-250px);
      transition: transform 0.3s ease;
      position: fixed;
      left: 0;
      top: 0;
      z-index: 1; /* Ensure sidebar is above content */
    }

    .sidebar.active {
      transform: translateX(0);
    }

    .sidebar-brand {
      font-size: 1.5rem;
      font-weight: bold;
      text-transform: uppercase;
      margin-bottom: 20px;
    }

    .sidebar-menu {
      list-style-type: none;
      padding: 0;
      margin-bottom: auto;
    }

    .sidebar-menu-item {
      padding: 10px;
      cursor: pointer;
    }

    .sidebar-menu-item:hover {
      background-color: #444;
    }

    /* Add icon styles */
    .sidebar-menu-item i {
      margin-right: 10px;
    }

    /* Add smooth transition */
    .sidebar-footer {
      margin-top: auto;
      padding-top: 20px;
    }

    .sidebar-footer .btn {
      width: 100%;
    }

    /* Media query for responsive design */
    @media(max-width: 768px) {
      .sidebar {
        display: none;
      }
    }
  </style>
</head>
<body>
  <nav class="sidebar">
    <div class="sidebar-brand">Menu</div>
    <ul class="sidebar-menu">
      <li class="sidebar-menu-item"><i class="fas fa-newspaper"></i><a href="{{ route('articles.index') }}" style="color:#fff;">Gestion Article</a></li>
      <li class="sidebar-menu-item"><i class="fas fa-users"></i><a href="{{ route('clients.index') }}" style="color:#fff;">Gestion Clients</a></li>
      <li class="sidebar-menu-item"><i class="fas fa-shopping-cart"></i><a href="{{ route('commandes.index') }}" style="color:#fff;">Gestion Commandes</a></li>
    </ul>
    <div class="sidebar-footer">
      <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
    </div>
  </nav>

  <button id="sidebar-toggle" class="btn btn-dark"><i class="fas fa-bars"></i>Menu</button>

  <script>
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');

    sidebarToggle.addEventListener('click', function() {
      sidebar.classList.toggle('active');
    });

    // Close sidebar when clicking anywhere outside of it
    document.addEventListener('click', function(event) {
      if (!sidebar.contains(event.target) && event.target !== sidebarToggle) {
        sidebar.classList.remove('active');
      }
    });
  </script>
</body>
</html>
