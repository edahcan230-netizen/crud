<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tableau de bord Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
   <nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand mb-0 h1">Gestion des Étudiants — Admin</span>

    <div class="dropdown">
        <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
            {{ auth()->user()->name }}
        </button>
                <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.profil') }}">
                        @if (auth()->user()->is_super_admin)
                            Profil super admin
                        @else
                            Profil admin
                        @endif
                    </a>
                </li>
                @if (auth()->user()->is_super_admin)
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.gerer-admins') }}">Gérer les admins</a>
                    </li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Déconnexion</button>
                    </form>
                </li>
            </ul>
    </div>
</nav>

<div class="d-flex bg-white border-bottom">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-dark rounded-0 flex-fill py-3">Étudiants</a>
    <a href="{{ route('admin.classes.index') }}" class="btn btn-outline-dark rounded-0 flex-fill py-3">Classes</a>
    <a href="{{ route('admin.matieres.index') }}" class="btn btn-outline-dark rounded-0 flex-fill py-3">Matières</a>
    <a href="{{ route('admin.notes.index') }}" class="btn btn-outline-dark rounded-0 flex-fill py-3">Notes</a>
</div>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>