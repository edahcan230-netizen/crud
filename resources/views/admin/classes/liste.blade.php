@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des classes</h2>
        <a href="{{ route('admin.classes.create') }}" class="btn btn-dark">+ Nouvelle classe</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>Nom de la classe</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classes as $classe)
                <tr>
                    <td>{{ $classe->nom_classe }}</td>
                    <td>
                        <a href="{{ route('admin.classes.edit', $classe->id) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <form action="{{ route('admin.classes.destroy', $classe->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cette classe ? Les matières associées seront aussi supprimées.')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection