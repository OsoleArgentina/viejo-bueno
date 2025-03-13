<template>
    <div v-if="render_app" class="relative min-h-screen">
      <!-- Sidebar -->
      <sidebar v-if="isOpen"></sidebar>
      <navbar></navbar>

      <!-- Main content -->
      <div class="flex mt-10 p-2">
        <div class="sm:w-[90%] ml-auto">
          <router-view />
        </div>
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
        },
        render_app: false,
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
    created() {
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

      this.render_app = true;
    },
    computed:{
        ...mapGetters([
            'admin',
        ])
    }
  };
</script>
  
  