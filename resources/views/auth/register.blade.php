@extends('layouts.app')

@section('content')
<div style="max-width: 400px; margin: 3rem auto; padding: 2rem; background: #f3f3f3; border-radius: 8px;">
    <h2 style="text-align: center; margin-bottom: 1rem;">Registreren</h2>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 1rem;">
            <ul style="padding-left: 1rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('auth.register') }}">
        @csrf

        <div style="margin-bottom: 1rem;">
            <label>Naam:</label>
            <input type="text" name="name" required value="{{ old('name') }}" style="width: 100%; padding: 0.5rem;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Email:</label>
            <input type="email" name="email" required value="{{ old('email') }}" style="width: 100%; padding: 0.5rem;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Wachtwoord:</label>
            <input type="password" name="password" required style="width: 100%; padding: 0.5rem;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Herhaal wachtwoord:</label>
            <input type="password" name="password_confirmation" required style="width: 100%; padding: 0.5rem;">
        </div>

        <button type="submit" style="width: 100%; padding: 0.5rem; background-color: #2196F3; color: white; border: none; border-radius: 4px;">
            Registreer
        </button>
    </form>

    <p style="text-align: center; margin-top: 1rem;">
        Al een account? <a href="{{ route('login') }}">Inloggen</a>
    </p>
</div>
@endsection
