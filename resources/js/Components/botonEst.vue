<template>
    <button @click="toggleStatus" class="btn-toggle-status">
      {{ isActive ? 'Desactivar' : 'Activar' }}
    </button>
  </template>
  
  <script>
  export default {
    props: {
      isActive: Boolean, // El estado actual del registro (1 o 0)
      recordId: Number,  // El ID del registro
    },
    methods: {
      toggleStatus() {
        // Lógica para cambiar el estado (1 a 0 o 0 a 1) y emitir un evento
        const newStatus = this.isActive ? 0 : 1;
        this.$emit('status-updated', this.recordId, newStatus);
      },
    },
  };
  </script>
  