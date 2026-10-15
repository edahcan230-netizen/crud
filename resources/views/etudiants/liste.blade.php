<!DOCTYPE html>
<html>
<head>
    <title>CRUD IN LARAVEL 8</title>
     @vite(['resources/js/app.js'])
</head>
<body>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"> 
  <div class="container text-center">
            <div class="row">
                <div class="col s12 ">
                        <h1>CRUD IN LARAVEL 8</h1>
                    <hr>
                    <a href="/ajouter" class="btn btn-primary">Ajouter un étudiant</a>
                    <hr>
                             @if($etudiants->count() > 0)
                                <div id="app" data-students='@json($etudiants->items())'></div>
                            @endif
                       @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                    <table class="table">
<thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Classe</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $ide=1;
                                @endphp
                              @foreach ($etudiants as $etudiant)
                              <tr>
                                <td>{{ $ide}}</td>
                                <td>{{ $etudiant->Nom }}</td>
                                <td>{{ $etudiant->Prenom }}</td>
                                <td>{{ $etudiant->Classe }}</td>
                                <td>
                                    <a href="{{ route('etudiants.modifier', ['id' => $etudiant->id]) }}" class="btn btn-info">Update</a>
                                    <a href="{{ route('etudiants.supprimer', ['id' => $etudiant->id]) }}" class="btn btn-danger">Delete</a>
                                </td>
                              </tr>
                              @php
                                $ide+=1;
                                @endphp
                             @endforeach
                            </tbody>
                    </table>

                    {{ $etudiants->links() }}
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
