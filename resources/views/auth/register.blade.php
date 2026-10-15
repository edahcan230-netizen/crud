<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="auth-form" novalidate>
        @csrf

        <!-- Nom -->
       <div>
    <x-input-label for="name" value="Nom" /> <span class="text-danger">*</span>
    <x-text-input id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" autofocus autocomplete="name" />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

        <!-- Prénom -->
<div class="mt-4">
    <x-input-label for="prenom" value="Prénom" /> <span class="text-danger">*</span>
    <x-text-input id="prenom" class="form-control form-control-lg @error('prenom') is-invalid @enderror" type="text" name="prenom" value="{{ old('prenom') }}" autocomplete="given-name" />
    <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
</div>

        <!-- Email Address -->
        <div class="mt-4">
    <x-input-label for="email" :value="__('Email')" /> <span class="text-danger">*</span>
    <x-text-input id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

        <!-- Mot de passe -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Mot de passe')" />

    <div class="input-group">
        <x-text-input id="password" class="form-control form-control-lg"
                type="password"
                name="password"
                        required autocomplete="new-password" />
        <span class="input-group-text" style="cursor:pointer" onclick="togglePassword('password','icon-mot-de-passe')">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" id="icon-mot-de-passe">
        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/>
    </svg>
</span>
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

        <!-- Confirmer Mot de passe -->
<div class="mt-4">
    <x-input-label for="password_confirmation" :value="__('Confirmer Mot de passe')" />

    <div class="input-group">
        <x-text-input id="password_confirmation" class="form-control form-control-lg"
                type="password"
                name="password_confirmation"
                required autocomplete="new-password" />
        <span class="input-group-text" style="cursor:pointer" onclick="togglePassword('password_confirmation','icon-mot-de-passe-confirmation')">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" id="icon-mot-de-passe-confirmation">
        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/>
    </svg>
</span>
    </div>
    <button type="submit" class="btn btn-dark w-100 mt-4">S'inscrire</button>

                <div class="text-center mt-3">
    <a href="{{ route('login') }}">Déjà inscrit ? Se connecter</a>
</div>
    </form>

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
</x-guest-layout>