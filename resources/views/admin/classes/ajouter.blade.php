@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Nouvelle classe</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li class="alert alert-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.classes.store') }}" method="POST" style="max-width: 500px;">
        @csrf
        <div class="form-group mb-3">
            <label for="nom_classe">Nom de la classe <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nom_classe') is-invalid @enderror" id="nom_classe" name="nom_classe" value="{{ old('nom_classe') }}" placeholder="Ex: 1ère année, Licence 2...">
        </div>
        <button type="submit" class="btn btn-dark">Ajouter</button>
        <a href="{{ route('admin.classes.index') }}" class="btn btn-outline-secondary">Annuler</a>
    </form>
@endsection