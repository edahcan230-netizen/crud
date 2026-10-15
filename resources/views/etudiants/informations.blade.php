<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mes informations - Gestion des Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark px-4">
        <span class="navbar-brand mb-0 h1">Gestion des Étudiants</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm">Déconnexion</button>
        </form>
    </nav>

    <div class="container mt-4" style="max-width: 500px;">

        <h2 class="mb-4">Complétez vos informations</h2>

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

        <form action="{{ route('etudiant.informations.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
    <label for="Nom">Nom <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('Nom') is-invalid @enderror" id="Nom" name="Nom" value="{{ old('Nom', $prefillNom) }}">
    @error('Nom')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

            <div class="form-group mb-3">
                <label for="Prenom">Prénom <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('Prenom') is-invalid @enderror" id="Prenom" name="Prenom" value="{{ old('Prenom', $prefillPrenom) }}">
                @error('Prenom')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

                        <div class="form-group mb-3">
                <label for="Classe">Classe <span class="text-danger">*</span></label>
                <select class="form-control @error('Classe') is-invalid @enderror" id="Classe" name="Classe">
                    <option value="">-- Choisir une classe --</option>
                    @foreach ($classes as $classe)
                        <option value="{{ $classe->nom_classe }}" {{ old('Classe') == $classe->nom_classe ? 'selected' : '' }}>
                            {{ $classe->nom_classe }}
                        </option>
                    @endforeach
                </select>
                @error('Classe')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="Telephone">Téléphone <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('Telephone') is-invalid @enderror" id="Telephone" name="Telephone" value="{{ old('Telephone') }}" maxlength="10" pattern="[0-9]*" inputmode="numeric">
                @error('Telephone')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-2">Enregistrer mes informations</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>