@extends('layouts.admin')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="row mb-4">
    <div class="col-md-3">
       <div class="card shadow-sm">
    <div class="card-body text-center">
        <h6 class="card-title text-primary">Total inscrits</h6>
        <h2 class="fw-bold text-primary">{{ $totalInscrits }}</h2>
    </div>
</div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
    <div class="card-body text-center">
        <h6 class="card-title text-primary">Total validés</h6>
        <h2 class="fw-bold text-primary">{{ $totalValides }}</h2>
    </div>
</div>
    </div>
    <div class="col-md-3">
       <div class="card shadow-sm">
    <div class="card-body text-center">
        <h6 class="card-title text-primary">Total rejetés</h6>
        <h2 class="fw-bold text-primary">{{ $totalRejetes }}</h2>
    </div>
</div>
    </div>
    <div class="col-md-3">
       <div class="card shadow-sm">
    <div class="card-body text-center">
        <h6 class="card-title text-primary">Total en attente</h6>
        <h2 class="fw-bold text-primary">{{ $totalEnAttente }}</h2>
    </div>
</div>
    </div>
</div>

    <h2 class="mb-4">Liste des étudiants</h2>

    <table class="table table-bordered table-hover bg-white">
       <thead class="table-dark">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Statut</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    @foreach ($etudiants as $etudiant)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $etudiant->Nom }}</td>
        <td>{{ $etudiant->Prenom }}</td>
        <td>
            @if ($etudiant->statut === 'valide')
                <span class="badge bg-success">Validé</span>
            @elseif ($etudiant->statut === 'rejete')
                <span class="badge bg-danger">Rejeté</span>
            @else
                <span class="badge bg-warning text-dark">En attente</span>
            @endif
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-{{ $etudiant->id }}" title="Voir les informations">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
</svg>
            </button>

            <form action="{{ route('admin.etudiant.supprimer', $etudiant->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="return confirm('Voulez-vous supprimer cet étudiant ?')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg>
                </button>
            </form>
        </td>
    </tr>

    <!-- Modal pour cet étudiant -->
    <div class="modal fade" id="modal-{{ $etudiant->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informations de l'étudiant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nom :</strong> {{ $etudiant->Nom }}</p>
                    <p><strong>Prénom :</strong> {{ $etudiant->Prenom }}</p>
                    <p><strong>Classe :</strong> {{ $etudiant->Classe }}</p>
                    <p><strong>Téléphone :</strong> {{ $etudiant->Telephone }}</p>
                    <p><strong>Statut :</strong>
                        @if ($etudiant->statut === 'valide')
                            <span class="badge bg-success">Validé</span>
                        @elseif ($etudiant->statut === 'rejete')
                            <span class="badge bg-danger">Rejeté</span>
                        @else
                            <span class="badge bg-warning text-dark">En attente</span>
                        @endif
                    </p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.valider', $etudiant->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Valider</button>
                    </form>
                    <form action="{{ route('admin.rejeter', $etudiant->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Rejeter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

                            <script>
                document.querySelectorAll('.card h2.fw-bold').forEach(el => {
                    const target = parseInt(el.textContent);
                    let current = 0;
                    const step = Math.max(1, Math.ceil(target / 30));
                    const interval = setInterval(() => {
                        current += step;
                        if (current >= target) {
                            current = target;
                            clearInterval(interval);
                        }
                        el.textContent = current;
                    }, 30);
                });
                </script>
        </tbody>
    </table>

@endsection