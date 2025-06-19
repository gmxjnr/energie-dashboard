@extends('layouts.app')

@section('content')
<div style="max-width: 400px; margin: 3rem auto; padding: 2rem; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; margin-bottom: 1.5rem;">Inloggen</h2>

    @if($errors->any())
        <div style="color: red; margin-bottom: 1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf

        <div style="margin-bottom: 1rem;">
            <label for="email" style="display: block; margin-bottom: 0.3rem;">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="password" style="display: block; margin-bottom: 0.3rem;">Wachtwoord</label>
            <input type="password" name="password" id="password" required style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <button type="submit" style="width: 100%; padding: 0.7rem; background-color: #0c2d57; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Inloggen
        </button>
    </form>
</div>
@endsection
