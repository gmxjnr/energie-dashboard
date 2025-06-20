@extends('layouts.app')

@section('content')
<div style="max-width: 400px; margin: 3rem auto; padding: 2rem; background: #f3f3f3; border-radius: 8px;">
    <h2 style="text-align: center; margin-bottom: 1rem;">Inloggen</h2>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 1rem;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('auth.login') }}">
        @csrf

        <div style="margin-bottom: 1rem;">
            <label>Email:</label>
            <input type="email" name="email" required value="{{ old('email') }}" style="width: 100%; padding: 0.5rem;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Wachtwoord:</label>
            <input type="password" name="password" required style="width: 100%; padding: 0.5rem;">
        </div>

        <button type="submit" style="width: 100%; padding: 0.5rem; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">
            Login
        </button>
    </form>

    <p style="text-align: center; margin-top: 1rem;">
        Nog geen account? <a href="{{ route('auth.register.show') }}">Registreren</a>
    </p>
</div>
@endsection
