<template>
  <nav class="bg-white shadow-md fixed w-full z-30 top-0">
      <div class="container mx-auto px-2 sm:px-2 py-4 flex justify-between items-center">
          <div class="flex items-center space-x-4">
              <router-link :to="{ name: 'home' }">
                <img :src="'img/logo-viejo-bueno.png'" alt="Logo" class="h-20 w-20 object-contain" />
              </router-link>
              
          </div>
          <div class="flex flex-col gap-y-3">
              <div class="flex justify-end">
                  <router-link :to="{ name: 'presupuesto' }">
                      <button class="hidden md:block border border-theme-600 text-theme-400 px-4 py-2 rounded-4xl bg-site-theme duration-300 hover:text-white hover:bg-theme-400 cursor-pointer">
                          Solicitud de presupuesto
                      </button>
                  </router-link>

                  <button @click="toggleMenu" class="md:hidden text-gray-600">
                    <i class="fa-solid fa-bars"></i>
                  </button>
              </div>
              
              <div class="flex gap-5">
                  <ul class="hidden md:flex space-x-6">
                    <li v-for="link in navLinks" :key="link.text" class="hover:text-theme-600">
                        <router-link  :to="{ name: link.path}" :class="{ 'font-semibold': isActiveLink(link.path) }">
                            {{link.text}}
                        </router-link>
                    </li>
                  </ul>
                  <!-- <span>|</span>
                  <router-link  :to="{ name: 'carrito'}">
                    <div class="relative inline-block cursor-pointer">
                      <img :src="'img/carrito.svg'" class="object-contain" alt="carrito">
                      <span class="absolute bottom-0 left-3 text-xs text-center h-4 px-1 bg-site-theme border border-theme-400 text-theme-400 rounded-full">
                        {{ cartCount }}
                      </span>
                    </div>
                  </router-link> -->
              </div>
          </div>
          <!-- Mobile Menu con transición -->
          <transition name="slide-down">
              <div v-if="menuOpen" class="absolute top-28 left-0 w-full bg-white shadow-md md:hidden">
                  <ul class="flex flex-col p-4 space-y-4">
                      <li v-for="link in navLinks" :key="link.text" class="hover:text-theme-600">
                          <router-link :to="{ name: link.path}" @click="menuOpen = !menuOpen" :class="{ 'font-semibold': isActiveLink(link.path) }">
                              {{link.text}}
                          </router-link>
                      </li>
                  </ul>
              </div>
          </transition>
      </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      menuOpen: false,
      navLinks: [
        { text: "Nosotros", path: "nosotros" },
        { text: "Productos", path: "productos" },
        { text: "Marcas", path: "marcas" },
        { text: "Novedades", path: "novedades" },
        { text: "Capacitaciones", path: "capacitaciones" },
        { text: "Contacto", path: "contacto" },
      ],
      cartCount: 0,
    };
  },
  methods: {
    toggleMenu() {
      this.menuOpen = !this.menuOpen;
    },
    isActiveLink(path) {
        return this.$route.name === path;
      },
  },
  created(){
    // const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    // this.cartCount = carrito.length;
  }
  };
  </script>

  <style scoped>
    /* Estilos para la transición del menú */
    .slide-down-enter-active,
    .slide-down-leave-active {
    transition: all 0.3s ease;
    max-height: 400px;
    overflow: hidden;
    }

    .slide-down-enter-from,
    .slide-down-leave-to {
    max-height: 0;
    opacity: 0;
    transform: translateY(-10px);
    }

    .slide-down-enter-to,
    .slide-down-leave-from {
    max-height: 400px;
    opacity: 1;
    transform: translateY(0);
  }
</style>