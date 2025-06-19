@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <h1>Gebruikersinstellingen</h1>

    @if(session('success'))
        <div style="background-color: #d4edda; padding: 10px; margin-bottom: 20px; border-radius: 4px; color: #155724;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST">
        @csrf

        <label for="name">Naam:</label><br>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        @error('name')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <br><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        @error('email')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <br><br>

        <label for="password">Nieuw wachtwoord (optioneel):</label><br>
        <input type="password" id="password" name="password">
        @error('password')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <br><br>

        <label for="password_confirmation">Bevestig nieuw wachtwoord:</label><br>
        <input type="password" id="password_confirmation" name="password_confirmation">

        <br><br>

        <button type="submit" style="background-color:#0c2d57; color:white; padding:10px 20px; border:none; border-radius:5px;">
            Instellingen opslaan
        </button>
    </form>
</div>
@endsection
