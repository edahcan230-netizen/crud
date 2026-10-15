@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des matières</h2>
        <a href="{{ route('admin.matieres.create') }}" class="btn btn-dark">+ Nouvelle matière</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <table class="table table-bordered bg-white align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width: 200px;">Matière</th>
                <th>Classes concernées</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matieres as $nomMatiere => $groupe)
                <tr>
                    <td class="fw-bold">{{ $nomMatiere }}</td>
                    <td>
                        @foreach ($groupe as $m)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-1">
                                <span>{{ $m->classe->nom_classe }}</span>
                                <span>
                                    <a href="{{ route('admin.matieres.edit', $m->id) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                                    <form action="{{ route('admin.matieres.destroy', $m->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer {{ $nomMatiere }} de {{ $m->classe->nom_classe }} ?')">Supprimer</button>
                                    </form>
                                </span>
                            </div>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection