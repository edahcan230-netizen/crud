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

        <h2 class="mb-4">Mes informations</h2>

        <div class="card p-4">
            <p><strong>Nom :</strong> {{ $etudiant->Nom }}</p>
            <p><strong>Prénom :</strong> {{ $etudiant->Prenom }}</p>
            <p><strong>Classe :</strong> {{ $etudiant->Classe }}</p>
            <p><strong>Téléphone :</strong> {{ $etudiant->Telephone }}</p>
            <p><strong>Statut :</strong>
                @php
                    $statut = $etudiant->statut ?? 'en_attente';
                @endphp

                @if ($statut === 'valide')
                    <span class="badge bg-success">Validé</span>
                @elseif ($statut === 'rejete')
                    <span class="badge bg-danger">Rejeté</span>
                @else
                    <span class="badge bg-warning text-dark">En attente</span>
                @endif
            </p>

            <a href="{{ route('etudiant.modifier') }}" class="btn btn-dark mt-2">Modifier mes informations</a>
            <a href="{{ route('etudiant.dashboard') }}" class="btn btn-outline-secondary mt-2">Retour</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>