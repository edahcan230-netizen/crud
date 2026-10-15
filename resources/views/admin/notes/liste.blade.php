@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des notes</h2>
        <a href="{{ route('admin.notes.create') }}" class="btn btn-dark">+ Nouvelle note</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <table class="table table-bordered bg-white align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width: 220px;">Étudiant</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notes as $etudiantId => $groupe)
                <tr>
                    <td class="fw-bold">{{ $groupe->first()->etudiant->Nom }} {{ $groupe->first()->etudiant->Prenom }}</td>
                    <td class="p-0">
                        <table class="table table-sm table-borderless mb-0">
                            <thead>
                                <tr class="text-muted small">
                                    <th>Matière</th>
                                    <th>N1</th>
                                    <th>N2</th>
                                    <th>N3</th>
                                    <th>Moyenne</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupe as $note)
                                    <tr class="border-top">
                                        <td>{{ $note->matiere->nom_matiere }}</td>
                                        <td>{{ $note->n1 ?? '-' }}</td>
                                        <td>{{ $note->n2 ?? '-' }}</td>
                                        <td>{{ $note->n3 ?? '-' }}</td>
                                        <td><strong>{{ $note->moyenne() }}</strong></td>
                                        <td>
                                            <a href="{{ route('admin.notes.edit', $note->id) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                                            <form action="{{ route('admin.notes.destroy', $note->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cette note ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection