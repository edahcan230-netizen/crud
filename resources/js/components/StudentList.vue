<template>
  <div>
    <student-card
      v-for="etudiant in localStudents"
      :key="etudiant.id"
      :student="etudiant"
      @delete="supprimerEtudiant"
    ></student-card>
  </div>
</template>
<script>
import StudentCard from './StudentCard.vue';
import axios from 'axios';

export default {
  components: { StudentCard },
  props: ['students'],
  data() {
    return {
      localStudents: [...this.students]
    }
  },
  methods: {
    supprimerEtudiant(id) {
      if (!confirm('Voulez-vous vraiment supprimer cet étudiant ?')) {
        return;
      }
      axios.get(`/delete-etudiants/${id}`)
        .then(() => {
          this.localStudents = this.localStudents.filter(e => e.id !== id);
        })
        .catch(error => {
          console.error('Erreur lors de la suppression :', error);
          alert('Une erreur est survenue lors de la suppression.');
        });
    }
  }
}
</script>