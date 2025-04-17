<template>
    <div class="">
      <!-- Mobile overlay -->
      <div 
        v-if="isOpen" 
        class="fixed inset-0 bg-black/50 z-20 lg:hidden"
        @click="toggleSidebar"
      ></div>
  
      <!-- Sidebar -->
      <aside 
        class="fixed top-0 left-0 z-30 h-screen transition-all duration-300 ease-in-out bg-theme-400 text-white shadow-lg"
        :class="[isOpen ? 'w-[5%]' : 'w-16', 'lg:w-60 lg:translate-x-0', !isOpen && '-translate-x-full lg:translate-x-0 lg:w-[5%]']"
      >
        <!-- Toggle button (visible on mobile) -->
        <!-- <button 
          @click="toggleSidebar" 
          class="absolute -right-10 top-4 bg-theme-400 text-white p-2 rounded-r-md lg:hidden"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path v-if="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button> -->
  
        <!-- Logo -->
        <div class="border-b border-white">
            <div class="flex justify-center items-center h-20 my-6">
            <router-link  :to="{ name: 'dashboard' }">
                <img 
                  :src="isOpen || window.innerWidth >= 1024 ? 'img/logo-viejo-bueno.png' : ''" 
                  alt="Logo" 
                  class="transition-all duration-300"
                />
            </router-link>
            </div>
        </div>
  
        <!-- Navigation -->
        <nav class="mt-5 px-2">
          <!-- Collapsible sections -->
          <div v-for="(section, sectionIndex) in secciones" :key="`section-${sectionIndex}`" class="mt-2">
                <button 
                  @click="toggleSection(sectionIndex)"
                  class="w-full flex items-center justify-between px-4 py-3 text-gray-300 hover:bg-theme-300 rounded-md transition-colors cursor-pointer"
                >
                  <div class="flex items-center">
                    <i :class="section.icon"></i>
                    <span v-if="section.items"
                      class="ml-3 transition-opacity duration-300"
                    >
                      {{ section.name }}
                    </span>
                    <span class="ml-3" v-else>
                      <router-link :to="{ name: section.path }">
                        {{ section.name }}
                      </router-link>
                    </span>
                  </div>
                  <svg v-if="section.items"
                    xmlns="http://www.w3.org/2000/svg" 
                    class="h-4 w-4 transition-transform duration-200"
                    :class="[section.isOpen ? 'rotate-180' : '', isOpen || window.innerWidth >= 1024 ? 'opacity-100' : 'opacity-0 hidden lg:inline-block lg:opacity-0']"
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor"
                  >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </button>
  
            <!-- Submenu -->
            <div 
              v-if="section.items && section.isOpen && (isOpen || window.innerWidth >= 1024)" 
              class="mt-1 ml-6 pl-4 border-l border-white space-y-1 transition-all duration-300 ease-in-out"
            >
                <div 
                    v-for="(subItem, subIndex) in section.items" 
                    :key="`sub-${sectionIndex}-${subIndex}`"
                    class=""
                >
                <router-link  :to="{ name: subItem.path }" class="flex items-center text-sm text-gray-400">
                  <span class="px-4 py-2 w-full hover:text-white hover:bg-theme-300 rounded-md cursor-pointer duration-300">

                    {{ subItem.name }}
                  </span>
                  </router-link>
                </div>
            </div>
          </div>
        </nav>
      </aside>
    </div>
  </template>
  
<script>
import { mapGetters, mapActions } from "vuex";

export default {
    data() {
      return {
        isOpen: true,
        window: {
          innerWidth: 0
        },
        secciones: [
          { 
            name: 'Home', 
            icon: 'fa-solid fa-house', 
            isOpen: false,
            items: [
              { name: 'Slider', path: 'sliders' },
              { name: 'Nosotros', path: 'home-nosotros' },
            ]
          },
          { 
            name: 'Nosotros', 
            icon: 'fa-solid fa-users', 
            isOpen: false,
            items: [
              { name: 'Contenido', path: 'nosotros' },
              { name: '¿Por qué elegirnos?', path: 'elegirnos' },
            ]
          },
          { 
            name: 'Productos', 
            icon: 'fa-solid fa-layer-group',
            isOpen: false,
            items: [
              { name: 'Categorias', path: 'categorias' },
              // { name: 'Subcategorias', path: 'subcategorias' },
              // { name: 'Productos', path: 'productos' },
              { name: 'Productos', path: 'marcas' },
            ]
          },
          // { name: 'Marcas', icon: 'fa-solid fa-list', path: 'marcas' },
          { name: 'Novedades', icon: 'fa-solid fa-newspaper', path: 'novedades' },
          { name: 'Capacitaciones', icon: 'fa-solid fa-book', path: 'capacitaciones' },
          { name: 'Contacto', icon: 'fa-solid fa-address-book', path: 'contacto' },
          { name: 'Administradores', icon: 'fa-solid fa-users', path: 'admins' },
          { name: 'Metadatos', icon: 'fa-solid fa-database', path: 'metadatos' },
          { name: 'Pop-up', icon: 'fa-solid fa-database', path: 'popup' },
        ]
      };
    },
    methods: {
      // Toggle sidebar
      toggleSidebar() {
        this.isOpen = !this.isOpen;
      },
      // Toggle section open/closed
      toggleSection(index) {
        this.secciones[index].isOpen = !this.secciones[index].isOpen;
      }
    },
    mounted() {
      // Update window width on resize
      this.window.innerWidth = window.innerWidth;
  
      // Set initial state based on screen size
      if (this.window.innerWidth < 1024) {
        this.isOpen = false;
      }
  
      window.addEventListener('resize', () => {
        this.window.innerWidth = window.innerWidth;
      });
    },
  };
</script>
 
  