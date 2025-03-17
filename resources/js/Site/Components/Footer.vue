<template>

    <div class="bg-green-100 p-6 mt-10">
      <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
          <img :src="'img/logo-viejo-bueno.png'" alt="Logo" class="h-12 mb-4" />
          <div class="flex space-x-4">
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
          </div>
        </div>
        <div>
          <h3 class="font-bold">SECCIONES</h3>
          <ul class="mt-2 space-y-2">
            <li v-for="link in footerLinks" :key="link.text">
              <a :href="link.href" class="hover:text-green-600">{{ link.text }}</a>
            </li>
          </ul>
        </div>
        <div>
          <h3 class="font-bold">DATOS DE CONTACTO</h3>
          <p>Viejo Bueno 299, Bernal, Buenos Aires, Argentina</p>
          <p>ventas@viejobueno.com.ar</p>
          <p>+54 (911) 4252 - 1195</p>
        </div>
      </div>
      <p class="text-center text-gray-600 mt-6">2024 Sanitarios Viejo Bueno. Todos los derechos reservados.</p>
    </div>
</template>

<script>
export default {
  data() {
    return {
      footerLinks: [
        { text: "Inicio", href: "#" },
        { text: "Nosotros", href: "#" },
        { text: "Productos", href: "#" },
        { text: "Marcas", href: "#" },
        { text: "Novedades", href: "#" },
        { text: "Galería", href: "#" },
        { text: "Solicitud de presupuesto", href: "#" },
        { text: "Contacto", href: "#" },
      ],
    };
  },
};
</script>