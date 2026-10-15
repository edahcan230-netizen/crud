<template>
  <div class="student-card" style="border: 2px solid #0d6efd; padding: 15px; border-radius: 8px; margin: 15px 0; background-color: #f0f8ff;">
    <h3>{{ student.Nom }} {{ student.Prenom }}</h3>
    <p>Classe : {{ student.Classe }}</p>
    <button @click="$emit('delete', student.id)" style="background-color: #dc3545; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">
      Supprimer (Vue)
    </button>
  </div>
</template>

<script>
export default {
  props: ['student'],
  emits: ['delete']
}
</script>