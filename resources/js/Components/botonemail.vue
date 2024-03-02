<template>
    <div class="centered-button"> 
      <button class="mi-boton rounded-md bg-green-600 px-4 py-2 text-center text-sm text-white hover:bg-green-500" @click="onClick">
        <slot></slot>
      </button>
      
    </div>
  </template>
  
  
  <script>
  export default {
    methods: {
      onClick() {
        
      },
    },
  };
  </script>
  
  <style scoped>
  .centered-button {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; 
  }
  </style>
  