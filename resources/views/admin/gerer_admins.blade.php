@extends('layouts.admin')

@section('content')

    <h2 class="mb-4">Gérer les administrateurs</h2>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li class="alert alert-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

   <div class="mb-5" style="max-width: 500px;">
    <h4>Créer un nouvel administrateur</h4>
    <form action="{{ route('admin.creer-admin') }}" method="POST">
        @csrf

       <div class="form-group mb-3">
    <label for="name">Nom <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
    @error('name')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

        <div class="form-group mb-3">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
    <label for="password">Mot de passe <span class="text-danger">*</span></label>
    <div class="input-group">
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
        <span class="input-group-text" style="cursor:pointer" onclick="togglePassword('password','icon-password')">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" id="icon-password">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/>
            </svg>
        </span>
    </div>
    @error('password')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

        <div class="form-group mb-3">
    <label for="password_confirmation">Confirmer le mot de passe <span class="text-danger">*</span></label>
    <div class="input-group">
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        <span class="input-group-text" style="cursor:pointer" onclick="togglePassword('password_confirmation','icon-password-confirmation')">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" id="icon-password-confirmation">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/>
            </svg>
        </span>
    </div>
</div>

        <button type="submit" class="btn btn-primary">Créer l'administrateur</button>
    </form>
</div>

<div>
    <h4>Administrateurs existants</h4>
    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        @if ($admin->is_super_admin)
                            <span class="badge bg-primary">Super-administrateur</span>
                        @else
                            <span class="badge bg-secondary">Administrateur</span>
                            <form action="{{ route('admin.supprimer-admin', $admin->id) }}" method="POST" class="d-inline">
                         @csrf
                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer définitivement le compte de {{ $admin->name }} ? Cette action est irréversible.')">Supprimer</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    </div>

@endsection