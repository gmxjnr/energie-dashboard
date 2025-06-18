<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard - Gebruikerslijst</h1>
    <ul>
        @foreach ($users as $user)
            <li>{{ $user->name ?? 'Naam onbekend' }} - {{ $user->email ?? 'Geen email' }}</li>
        @endforeach
    </ul>
</body>
</html>
