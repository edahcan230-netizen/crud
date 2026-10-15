@extends('layouts.admin')

@section('content')
    <h2 class="mb-1">Modifier la note</h2>
<p class="text-muted mb-4">{{ $note->etudiant->Nom }} {{ $note->etudiant->Prenom }} · {{ $note->matiere->nom_matiere }}</p>

    <form action="{{ route('admin.notes.update', $note->id) }}" method="POST" style="max-width: 400px;">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="n1">Note 1 (sur 20)</label>
            <input type="number" step="0.01" min="0" max="20" class="form-control @error('n1') is-invalid @enderror" id="n1" name="n1" value="{{ old('n1', $note->n1) }}">
        </div>
        <div class="form-group mb-3">
            <label for="n2">Note 2 (sur 20)</label>
            <input type="number" step="0.01" min="0" max="20" class="form-control @error('n2') is-invalid @enderror" id="n2" name="n2" value="{{ old('n2', $note->n2) }}">
        </div>
        <div class="form-group mb-3">
            <label for="n3">Note 3 (sur 20)</label>
            <input type="number" step="0.01" min="0" max="20" class="form-control @error('n3') is-invalid @enderror" id="n3" name="n3" value="{{ old('n3', $note->n3) }}">
        </div>
        <button type="submit" class="btn btn-dark">Enregistrer</button>
        <a href="{{ route('admin.notes.index') }}" class="btn btn-outline-secondary">Annuler</a>
    </form>
@endsection