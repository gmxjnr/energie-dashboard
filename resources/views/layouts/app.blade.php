<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Smart Energy Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0 20px;
        }
        header {
            background-color: #0c2d57;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-bottom: 20px;
        }
        nav {
            margin-bottom: 15px;
        }
        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #0c2d57;
            font-weight: 600;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgb(0 0 0 / 0.1);
            min-height: 60vh;
        }
    </style>
</head>
<body>
    <header>
        <h1>Smart Energy Dashboard</h1>
    </header>

    <nav>
        <a href="{{ route('dashboard.home') }}">Home</a>
        <a href="{{ route('dashboard.analyse') }}">Analyse</a>
        <a href="{{ route('dashboard.energiebespaar') }}">Energiebespaar</a>
        <a href="{{ route('dashboard.instellingen') }}">Instellingen</a>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>
