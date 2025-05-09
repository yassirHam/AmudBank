<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Application')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Ajouter d'autres fichiers CSS si besoin -->
</head>
<body>
    <header>
        <nav>
            <!-- Menu de navigation -->
            <a href="/">Accueil</a>
            <a href="/about">À propos</a>
        </nav>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Mon Application</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
