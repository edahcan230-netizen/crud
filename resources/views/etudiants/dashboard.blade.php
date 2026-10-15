<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mon tableau de bord - Gestion des Étudiants</title>
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

        <h2 class="mb-4">Mon tableau de bord</h2>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($etudiant)
            <div class="row g-3">
    <div class="col-md-6">
        <a href="{{ route('etudiant.dashboard.infos') }}" class="text-decoration-none">
            <div class="card p-4 text-center shadow-sm h-100">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-dark mx-auto mb-3" style="width: 60px; height: 60px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                    </svg>
                </div>
                <h5 class="text-dark">Mes informations</h5>
            </div>
        </a>
    </div>

    <div class="col-md-6">
        <div class="card p-4 text-center shadow-sm h-100" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#modal-notes">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-dark mx-auto mb-3" style="width: 60px; height: 60px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                </svg>
            </div>
            <h5 class="text-dark">Mes matières et notes</h5>
        </div>
    </div>
</div>

<!-- Modal Notes -->
<div class="modal fade" id="modal-notes" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mes matières et notes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @if ($notes->isEmpty())
                    <p class="text-muted">Aucune note enregistrée pour le moment.</p>
                @else
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Matière</th>
                                <th>N1</th>
                                <th>N2</th>
                                <th>N3</th>
                                <th>Moyenne</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notes as $note)
                                <tr>
                                    <td>{{ $note->matiere->nom_matiere }}</td>
                                    <td>{{ $note->n1 ?? '-' }}</td>
                                    <td>{{ $note->n2 ?? '-' }}</td>
                                    <td>{{ $note->n3 ?? '-' }}</td>
                                    <td><strong>{{ $note->moyenne() ?? '-' }}</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
        @else
            <p>Vous n'avez pas encore complété vos informations.</p>
            <a href="{{ route('etudiant.informations') }}" class="btn btn-primary">Compléter mes informations</a>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>