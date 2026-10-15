@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Modifier la classe</h2>

    <form action="{{ route('admin.classes.update', $classe->id) }}" method="POST" style="max-width: 500px;">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="nom_classe">Nom de la classe <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nom_classe') is-invalid @enderror" id="nom_classe" name="nom_classe" value="{{ old('nom_classe', $classe->nom_classe) }}">
            @error('nom_classe')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-dark">Enregistrer</button>
        <a href="{{ route('admin.classes.index') }}" class="btn btn-outline-secondary">Annuler</a>
    </form>
@endsection