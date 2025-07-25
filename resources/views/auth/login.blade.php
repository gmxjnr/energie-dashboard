@extends('layouts.app')

@section('content')
<div style="max-width: 420px; margin: 4rem auto; padding: 2rem; background: white; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.05);">
    <h2 style="text-align: center; margin-bottom: 1.5rem; font-size: 1.5rem; font-weight: bold; color: #333;">Inloggen</h2>

    @if ($errors->any())
        <div style="color: #b91c1c; background-color: #fee2e2; padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1.25rem;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('auth.login') }}">
        @csrf

        <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Emailadres</label>
            <input type="email" name="email" required value="{{ old('email') }}" style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 6px;">
        </div>

        <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Wachtwoord</label>
            <input type="password" name="password" required style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 6px;">
        </div>

        <button type="submit" style="width: 100%; padding: 0.75rem; background-color: #4CAF50; color: white; font-weight: 600; border: none; border-radius: 6px; cursor: pointer;">
            Inloggen
        </button>
    </form>

    <p style="text-align: center; margin-top: 1.5rem;">
        Nog geen account? <a href="{{ route('auth.register.show') }}" style="color: #4CAF50; text-decoration: underline;">Registreer hier</a>
    </p>
</div>
@endsection
