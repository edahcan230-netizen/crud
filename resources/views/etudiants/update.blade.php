<!DOCTYPE html>
<html>
<head>
    <title>CRUD IN LARAVEL 8</title>
</head>
<body>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"> 
  <div class="container">
            <div class="row">
                <div class="col s12 ">
                        <h1>MODIFIER UN ETUDIANT - LARAVEL 8</h1>
                    <hr>
                
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                  
                    <ul>
                        @foreach ($errors->all() as $error)
                             <li class="alert alert-danger">{{ $error }}</li>
                      @endforeach 
                    </ul>
                    
                    <form action="/etudiants/update" method="POST" class="form-group">
                        @csrf
                        <input type="hidden" name="id" value="{{ $etudiant->id }}">

                       <div class="form-group">
<label for="Nom">Nom <span class="text-danger">*</span></label>
<input type="text" class="form-control @error('Nom') is-invalid @enderror" id="Nom" name="Nom" value="{{ old('Nom', $etudiant->Nom) }}">
@error('Nom')
    <div class="text-danger small">{{ $message }}</div>
@enderror
</div>
                        <!-- ... reste inchangé ... -->

                        <div class="form-group">
                        <label for="Prenom">Prenom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('Prenom') is-invalid @enderror" id="Prenom" name="Prenom" value="{{ old('Prenom', $etudiant->Prenom) }}">
                        @error('Prenom')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="form-group">
                        <label for="Classe">Classe <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('Classe') is-invalid @enderror" id="Classe" name="Classe" value="{{ old('Classe', $etudiant->Classe) }}">
                        @error('Classe')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        </div>

                    <br>
                    <button type="submit" class="btn btn-primary mt-4">MODIFIER L'ETUDIANT</button>

                    <br>

                    <a href="/etudiants" class="btn btn-danger mt-4">Retour à la liste des étudiants</a>
                    </form>
                    
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
