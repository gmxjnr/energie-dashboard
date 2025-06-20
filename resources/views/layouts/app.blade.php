<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Smart Energy Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f0f4f8;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #1e3a8a;
        color: white;
        padding: 1.5rem 0;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    nav {
        background-color: #ffffff;
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        padding: 1rem 0;
        border-bottom: 1px solid #e5e7eb;
    }

    nav a {
        text-decoration: none;
        color: #1e3a8a;
        font-weight: 600;
        transition: color 0.2s;
    }

    nav a:hover {
        color: #2563eb;
        text-decoration: underline;
    }

    main {
        max-width: 1200px;
        margin: 2rem auto;
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
</style>
</head>
<body>
    <header>
        <h1>Smart Energy Dashboard</h1>
    </header>

    <nav>
        @auth
            <a href="{{ route('dashboard.home') }}">Home</a>
            <a href="{{ route('dashboard.analyse') }}">Analyse</a>
            <a href="{{ route('dashboard.energiebespaar') }}">Energiebespaar</a>
            <a href="{{ route('dashboard.instellingen') }}">Instellingen</a>
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit">Uitloggen</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}">Inloggen</a>
            <a href="{{ route('auth.register.show') }}">Registreren</a>
        @endguest

    </nav>

    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
