<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            padding-top: 20px;
        }

        .sidebar {
            background-color: #333;
            color: #fff;
            padding: 20px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 300px;
            transition: all 0.3s ease-in-out;
            overflow-y: auto;
        }

        .sidebar h1 {
            color: #ddb785;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding-left: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #555;
        }

        .sidebar ul li a .fa {
            margin-right: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar ul li a:hover .fa {
            transform: scale(1.2);
        }

        .main-content {
            padding: 20px;
            margin-left: 300px; /* Adjustment to leave space for the sidebar */
            transition: margin-left 0.3s ease-in-out;
        }

        .toggle-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            z-index: 999;
            display: none;
            background-color: #333;
            border: none;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        .toggle-btn i {
            font-size: 24px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
        }

        .logout-btn {
            background-color: #bb8656;
            color: #fff;
            font-weight: bold;
            border-radius: 5px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c49a58;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }

            .toggle-btn {
                display: block;
            }
           
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h1>Dashboard de {{ Auth::guard('admin')->user()->login }}</h1>
        <ul class="grid">
            <li>
                <p><a href="{{ route('personnes.index') }}"><i class="fas fa-users"></i> Gérer les Personnes</a></p>       
            </li>
            <li>
                <p><a href="{{ route('membres.index') }}"><i class="fas fa-user"></i> Gérer les Membres</a></p>        
            </li>
            <li>
                <p><a href="{{ route('oeuvres.index') }}"><i class="fas fa-book"></i> Gérer les Œuvres</a></p>       
            </li>
            <li>
                <p><a href="{{ route('achats.index') }}"><i class="fas fa-shopping-cart"></i> Gérer les Achats</a></p>       
            </li>
            <li>
                <p><a href="{{ route('reservations.index') }}"><i class="far fa-calendar-alt"></i> Gérer les Réservations</a></p>       
            </li>
            <li>
                <p><a href="{{ route('emprunts.index') }}"><i class="fas fa-exchange-alt"></i> Gérer les Emprunts</a></p>       
            </li>
        </ul>
        <form action="{{ route('admin.logout') }}" class=" text-center" method="POST" style="margin-top: 40%;">
            @csrf
            <button type="submit" class="logout-btn">Déconnexion</button>
        </form>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        
        <button type="button" id="toggleBtn" class="toggle-btn" style="background-color: red"><i class="fas fa-bars"></i></button>
        <div class="content">
            @yield('content')
        </div>
    </div>

    <script>
        document.getElementById('toggleBtn').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            if (sidebar.style.display === 'none' || sidebar.style.display === '') {
                sidebar.style.display = 'block';
                mainContent.style.marginLeft = '300px';
            } else {
                sidebar.style.display = 'none';
                mainContent.style.marginLeft = '0';
            }
        });

        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            if (window.innerWidth > 768) {
                sidebar.style.display = 'block';
                mainContent.style.marginLeft = '300px';
            } else {
                sidebar.style.display = 'none';
                mainContent.style.marginLeft = '0';
            }
        });
    </script>
</body>
</html>
