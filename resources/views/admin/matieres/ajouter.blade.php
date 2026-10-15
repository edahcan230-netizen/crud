@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Nouvelle matière</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li class="alert alert-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.matieres.store') }}" method="POST" style="max-width: 500px;">
        @csrf
        <div class="form-group mb-3">
            <label for="nom_matiere">Nom de la matière <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nom_matiere') is-invalid @enderror" id="nom_matiere" name="nom_matiere" value="{{ old('nom_matiere') }}" placeholder="Ex: Mathématiques">
        </div>

        <div class="form-group mb-3">
            <label for="classe_id">Classe <span class="text-danger">*</span></label>
            <select class="form-control @error('classe_id') is-invalid @enderror" id="classe_id" name="classe_id">
                <option value="">-- Choisir une classe --</option>
                @foreach ($classes as $classe)
                    <option value="{{ $classe->id }}" {{ old('classe_id') == $classe->id ? 'selected' : '' }}>
                        {{ $classe->nom_classe }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-dark">Ajouter</button>
        <a href="{{ route('admin.matieres.index') }}" class="btn btn-outline-secondary">Annuler</a>
    </form>
@endsection