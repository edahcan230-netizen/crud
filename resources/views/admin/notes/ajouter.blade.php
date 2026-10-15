@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Nouvelle note</h2>
        <a href="{{ route('admin.notes.index') }}" class="btn btn-outline-secondary">&larr; Retour</a>
    </div>

    <div style="max-width: 500px;">
        <div class="form-group mb-3">
            <label for="select-classe">Classe</label>
            <select id="select-classe" class="form-control">
                <option value="">-- Choisir une classe --</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="select-etudiant">Sélection</label>
            <select id="select-etudiant" class="form-control" disabled>
                <option value="">-- Choisir d'abord une classe --</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="select-matiere">Matière</label>
            <select id="select-matiere" class="form-control" disabled>
                <option value="">-- Choisir d'abord un étudiant --</option>
            </select>
        </div>
    </div>

    <!-- Modal Note -->
    <div class="modal fade" id="modal-note" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.notes.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="etudiant_id" id="input-etudiant-id">
                    <input type="hidden" name="matiere_id" id="input-matiere-id">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter la note</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="resetMatiereSelect()"></button>
                    </div>
                    <div class="modal-body">
                        <p id="modal-recap" class="text-muted"></p>
                        <div class="form-group mb-3">
                            <label for="n1">Note 1 (sur 20)</label>
                            <input type="number" step="0.01" min="0" max="20" class="form-control" id="n1" name="n1">
                        </div>
                        <div class="form-group mb-3">
                            <label for="n2">Note 2 (sur 20)</label>
                            <input type="number" step="0.01" min="0" max="20" class="form-control" id="n2" name="n2">
                        </div>
                        <div class="form-group mb-3">
                            <label for="n3">Note 3 (sur 20)</label>
                            <input type="number" step="0.01" min="0" max="20" class="form-control" id="n3" name="n3">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="resetMatiereSelect()">Annuler</button>
                        <button type="submit" class="btn btn-dark">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const data = @json($data);
        const existingNotes = @json($existingNotes);

        const selectClasse = document.getElementById('select-classe');
        const selectEtudiant = document.getElementById('select-etudiant');
        const selectMatiere = document.getElementById('select-matiere');

        data.forEach(classe => {
            const opt = document.createElement('option');
            opt.value = classe.id;
            opt.textContent = classe.nom;
            selectClasse.appendChild(opt);
        });

        selectClasse.addEventListener('change', function () {
            const classe = data.find(c => c.id == this.value);
            selectEtudiant.innerHTML = '<option value="">-- Choisir un étudiant --</option>';
            selectMatiere.innerHTML = '<option value="">-- Choisir d\'abord un étudiant --</option>';
            selectMatiere.disabled = true;

            if (classe) {
                classe.etudiants.forEach(e => {
                    const opt = document.createElement('option');
                    opt.value = e.id;
                    opt.textContent = e.Nom + ' ' + e.Prenom;
                    selectEtudiant.appendChild(opt);
                });
                selectEtudiant.disabled = false;
            } else {
                selectEtudiant.disabled = true;
            }
        });

        selectEtudiant.addEventListener('change', function () {
    const classe = data.find(c => c.id == selectClasse.value);
    selectMatiere.innerHTML = '<option value="">-- Choisir une matière --</option>';

    if (classe && this.value) {
        const disponibles = classe.matieres.filter(m => !existingNotes.includes(this.value + '-' + m.id));

        if (disponibles.length === 0) {
            selectMatiere.innerHTML = '<option value="">Toutes les matières sont déjà notées</option>';
        } else {
            disponibles.forEach(m => {
                const opt = document.createElement('option');
                opt.value = m.id;
                opt.textContent = m.nom;
                selectMatiere.appendChild(opt);
            });
        }
        selectMatiere.disabled = false;
    } else {
        selectMatiere.disabled = true;
    }
});

        selectMatiere.addEventListener('change', function () {
            if (!this.value) return;

            const etudiantOption = selectEtudiant.options[selectEtudiant.selectedIndex];
            const matiereOption = this.options[this.selectedIndex];

            document.getElementById('input-etudiant-id').value = selectEtudiant.value;
            document.getElementById('input-matiere-id').value = this.value;
            document.getElementById('modal-recap').textContent = etudiantOption.textContent + ' — ' + matiereOption.textContent;

            const modal = new bootstrap.Modal(document.getElementById('modal-note'));
            modal.show();
        });

        function resetMatiereSelect() {
            selectMatiere.value = '';
        }
    </script>
@endsection