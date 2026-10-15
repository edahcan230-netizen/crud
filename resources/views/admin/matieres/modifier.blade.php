@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Modifier la matière</h2>

    <form action="{{ route('admin.matieres.update', $matiere->id) }}" method="POST" style="max-width: 500px;">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="nom_matiere">Nom de la matière <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nom_matiere') is-invalid @enderror" id="nom_matiere" name="nom_matiere" value="{{ old('nom_matiere', $matiere->nom_matiere) }}">
            @error('nom_matiere')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="classe_id">Classe <span class="text-danger">*</span></label>
            <select class="form-control" id="classe_id" name="classe_id">
                @foreach ($classes as $classe)
                    <option value="{{ $classe->id }}" {{ old('classe_id', $matiere->classe_id) == $classe->id ? 'selected' : '' }}>
                        {{ $classe->nom_classe }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-dark">Enregistrer</button>
        <a href="{{ route('admin.matieres.index') }}" class="btn btn-outline-secondary">Annuler</a>
    </form>
@endsection