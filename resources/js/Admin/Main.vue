<template>
    <div class="relative min-h-screen">
      <!-- Sidebar -->
      <sidebar v-if="isOpen"></sidebar>

      <navbar></navbar>
      <!-- Main content -->
      <div class="transition-all duration-300 min-h-screen mt-20 p-2" :class="[isOpen ? 'lg:ml-36' : 'lg:ml-16']">
        <!-- Toggle button (visible on desktop) -->
        <!-- <button @click="toggleSidebar" class="fixed top-4 left-4 z-10 bg-gray-800 text-white p-2 rounded-md hidden lg:block">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8M4 18h16" />
          </svg>
        </button> -->
  
        <router-view />
      </div>
    </div>
</template>
  
<script>
import { mapGetters, mapActions } from "vuex";
  
export default {

    data() {
      return {
        isOpen: true,  // Sidebar abierto por defecto
        window: {
          innerWidth: 0
        }
      };
    },
    methods: {
      ...mapActions([
          'load_user_data',
      ]),
      // Toggle sidebar
      toggleSidebar() {
        this.isOpen = !this.isOpen;
      }
    },
    mounted() {
      this.load_user_data();

      // Establece el tamaño inicial de la ventana
      this.window.innerWidth = window.innerWidth;
  
      // Comporta el sidebar en base al tamaño de la ventana
      if (this.window.innerWidth < 1024) {
        this.isOpen = false;
      }
  
      // Escucha el cambio de tamaño de la ventana
      window.addEventListener('resize', () => {
        this.window.innerWidth = window.innerWidth;
      });
    },
    computed:{
        ...mapGetters([
            'admin',
        ])
    }
  };
</script>
  
  