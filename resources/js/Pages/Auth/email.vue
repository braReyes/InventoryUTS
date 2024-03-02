<template>
    <Head title="Inicie sesion" />

    <div class="background-container">
    

      <mi-boton><a :href="route('connect')">Ingresar con correo institucional</a></mi-boton> 
    </div>
  </template>

<style>
.background-container {
  background-image: url("https://www.uts.edu.co/sitio/wp-content/uploads/2021/08/MG_6737.jpg"); 
  background-size: cover;
  background-position: center;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
</style>
  
  <script>
  import botonemail from '@/Components/botonemail.vue'; 
  
  export default {
    components: {
      'mi-boton': botonemail, 
    },
    
  };
  </script>
  