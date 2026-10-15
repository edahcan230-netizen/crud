@extends('layouts.admin')

@section('content')

    <h2 class="mb-4">Mon profil</h2>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li class="alert alert-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.profil.update') }}" method="POST" style="max-width: 500px;">
        @csrf

        <div class="form-group mb-3">
    <label for="name">Nom <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', auth()->user()->name) }}">
    @error('name')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

        <div class="form-group mb-3">
            <label for="email">Email 
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', auth()->user()->email) }}">
            @error('email')
            <span class="input-group-text" style="cursor:pointer" onclick="togglePassword('password','icon-password')">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" id="icon-password">
        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/>
    </svg>
</span>
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <hr>
        <p class="text-muted">Laisser vide pour ne pas changer le mot de passe</p>
<div class="form-group mb-3">
    <label for="password">Nouveau mot de passe</label>
    <div class="input-group">
        <input type="password" class="form-control" id="password" name="password">
        <span class="input-group-text" style="cursor:pointer" onclick="togglePassword('password','icon-password')">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" id="icon-password">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/>
            </svg>
        </span>
    </div>
</div>

        <div class="form-group mb-3">
            <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
            @error('password_confirmation')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
    </form>

    @if (auth()->user()->is_super_admin)
    <hr>
    <a href="{{ route('admin.gerer-admins') }}" class="btn btn-outline-primary">Gérer les administrateurs</a>
@endif 

<script>
function togglePassword(fieldId, iconId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);
    const lockClosed = "M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2";
    const lockOpen = "M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2";
    if (field.type === 'password') {
        field.type = 'text';
        icon.querySelector('path').setAttribute('d', lockOpen);
    } else {
        field.type = 'password';
        icon.querySelector('path').setAttribute('d', lockClosed);
    }
}
</script>

@endsection