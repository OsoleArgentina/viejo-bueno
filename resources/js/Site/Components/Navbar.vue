<template>
    <nav class="bg-white shadow-md fixed w-full z-30 top-0">
        <div class="px-20 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <router-link :to="{ name: 'home' }">
                  <img :src="'img/logo-viejo-bueno.png'" alt="Logo" class="h-20 w-20 object-contain" />
                </router-link>
                
            </div>
            <div class="flex flex-col gap-y-3">
                <div class="flex justify-end">
                    <button class="hidden md:block border border-theme-600 text-theme-400 px-4 py-2 rounded-4xl bg-site-theme duration-300 hover:text-white hover:bg-theme-400 cursor-pointer">
                        Solicitud de presupuesto
                    </button>
                    <button @click="toggleMenu" class="md:hidden text-gray-600">
                        ☰
                    </button>
                </div>
                
                <div>
                    <ul class="hidden md:flex space-x-6">
                    <li v-for="link in navLinks" :key="link.text" class="hover:text-theme-600">
                        <router-link  :to="{ name: link.path}">
                            {{link.text}}
                        </router-link>
                    </li>
                </ul>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div v-if="menuOpen" class="absolute top-16 left-0 w-full bg-white shadow-md md:hidden">
              <ul class="flex flex-col p-4 space-y-4">
                <li v-for="link in navLinks" :key="link.text" class="hover:text-theme-600">
                  <a :href="link.href">{{ link.text }}</a>
                </li>
              </ul>
            </div>
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
        { text: "Productos", href: "#" },
        { text: "Marcas", href: "#" },
        { text: "Novedades", href: "#" },
        { text: "Capacitaciones", href: "#" },
        { text: "Contacto", href: "#" },
      ],
    };
  },
  methods: {
    toggleMenu() {
      this.menuOpen = !this.menuOpen;
    },
  },
};
</script>
     