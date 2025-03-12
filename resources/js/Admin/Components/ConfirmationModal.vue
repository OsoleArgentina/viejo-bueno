<template>
    <div class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50">
      <div class="bg-white rounded-lg p-6 shadow-lg max-w-md w-full modal-animation">
        <h3 class="text-xl mb-4">{{ message }}</h3>
        <div class="flex justify-end gap-5">
          <!-- Botón de Cancelar -->
          <button 
            @click="emit_event('cancel')" 
            class="px-4 py-2 bg-gray-300 duration-300 hover:bg-gray-400 text-black rounded-md cursor-pointer">
            Cancelar
          </button>
          <!-- Botón de Confirmar -->
          <button 
            @click="emit_event('confirm')" 
            class="px-4 py-2 bg-theme-500 text-white rounded hover:bg-theme-700 focus:outline-none cursor-pointer duration-300">
            Confirmar
          </button>
        </div>
      </div>
    </div>
  </template>
  
<script>
  export default {
    props: [
      'message',
      'data_id',
    ],
  };
</script>
  