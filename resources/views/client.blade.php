<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBank - User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/client1.css') }}">
    @yield('styles')
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --success-color: #2ecc71;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: var(--dark-color);
            line-height: 1.6;    
        }
        .profile-container {
            display: grid;
            grid-template-columns: 270px 1fr;
        }

        .profile-sidebar {
            background-color: white;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            padding: 25px;
            
        }

        .profile-menu {
            list-style: none;
        }

        .profile-menu li {
            margin-bottom: 10px;
        }

        .profile-menu a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: var(--dark-color);
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .profile-menu a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .profile-menu a:hover,
        .profile-menu a.active {
            background-color: var(--secondary-color);
            color: white;
        }

        .logout-form {
            margin-top: 10px;
        }

        .logout-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #D0021B;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            background: none;
            width: 100%;
            text-align: left;
            font-size: 16px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .logout-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .logout-link:hover {
            background-color:#D0021B;
            /* color:#D0021B; */
            color: white;
        }

        .profile-content {
            background-color: white;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            padding: 30px;
            min-height: 100vh;
        }

        .section-title {
            font-size: 22px;
            margin-bottom: 20px;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
        }

        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid white;
            color: white;
        }

        .btn-outline:hover {
            background-color: white;
            color: var(--secondary-color);
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            margin-bottom: 18%;
        }

        .logo img {
            margin-right: 10px;
            color: var(--secondary-color);
            height: 20px;
            width:auto;  
            font-weight: bold;
            vertical-align: middle;
        }
/* Hover style pour le lien "Credit" */
.profile-menu a.credit-link:hover {
    background-color: var(--success-color); /* fond vert */
    color: white; /* texte blanc */
}

/* Assure que l’icône aussi devient blanche au survol */
.profile-menu a.credit-link:hover i {
    color: white;
}

.profile-menu a.credit-link.active {
    background-color: var(--success-color);
    color: white;
}

.profile-menu a.credit-link.active i {
    color: white;
}
.profile-menu a.credit-link {
    color: var(--success-color);
}

.profile-menu a.credit-link i {
    color: var(--success-color);
}


    </style>
</head>
<body>
    <div class="container">
        <div class="profile-container">
            <div class="profile-sidebar">
                <ul class="profile-menu">
                    <div class="logo">
                        <img src="{{ asset('logo.png') }}" alt="Image">
                        <span>AmudBank</span>
                    </div>
                    <li><a href="{{ route('client') }}" class="{{ request()->routeIs('client') ? 'active' : '' }}"><i class="fas fa-chart-pie"></i> Overview</a></li>
                    <li><a href="{{ route('accounts') }}" class="{{ request()->routeIs('accounts') ? 'active' : '' }}"><i class="fas fa-wallet"></i> Accounts</a></li>
                    <li><a href="{{ route('transactions') }}" class="{{ request()->routeIs('transactions') ? 'active' : '' }}"><i class="fas fa-exchange-alt"></i> Transactions</a></li>
                    <li><a href="{{ route('transactionsHistory') }}" class="{{ request()->routeIs('transactionsHistory') ? 'active' : '' }}"><i class="fas fa-history"></i></i> Transaction History </a></li>
                    <li><a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}"><i class="fas fa-cog"></i> Settings</a></li>
                    <li><a href="{{ route('credit') }}" class="credit-link {{ request()->routeIs('credit') ? 'active' : '' }}"><i class="fas fa-hand-holding-dollar"></i> Credit</a></li>
                </ul>
                <form id="logout-form" class="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-link"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>

            <div class="profile-content">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
