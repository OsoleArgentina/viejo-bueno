<template>

    <div class="w-full bg-site-theme p-6 mt-10">
      <div class="container mx-auto px-2 sm:px-0 flex sm:flex-row flex-col justify-between items-center">
        <div>
          <div class="flex flex-col gap-5 justify-center items-center space-x-4">
            <img :src="'img/logo-viejo-bueno-footer.png'" alt="Logo" class=" object-contain" />
            <div class="flex gap-2">
              <a href="https://www.instagram.com/viejobuenosanitarios/?hl=es" target="_blank">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="mdi:instagram">
                <path id="Vector" d="M7.8 2H16.2C19.4 2 22 4.6 22 7.8V16.2C22 17.7383 21.3889 19.2135 20.3012 20.3012C19.2135 21.3889 17.7383 22 16.2 22H7.8C4.6 22 2 19.4 2 16.2V7.8C2 6.26174 2.61107 4.78649 3.69878 3.69878C4.78649 2.61107 6.26174 2 7.8 2ZM7.6 4C6.64522 4 5.72955 4.37928 5.05442 5.05442C4.37928 5.72955 4 6.64522 4 7.6V16.4C4 18.39 5.61 20 7.6 20H16.4C17.3548 20 18.2705 19.6207 18.9456 18.9456C19.6207 18.2705 20 17.3548 20 16.4V7.6C20 5.61 18.39 4 16.4 4H7.6ZM17.25 5.5C17.5815 5.5 17.8995 5.6317 18.1339 5.86612C18.3683 6.10054 18.5 6.41848 18.5 6.75C18.5 7.08152 18.3683 7.39946 18.1339 7.63388C17.8995 7.8683 17.5815 8 17.25 8C16.9185 8 16.6005 7.8683 16.3661 7.63388C16.1317 7.39946 16 7.08152 16 6.75C16 6.41848 16.1317 6.10054 16.3661 5.86612C16.6005 5.6317 16.9185 5.5 17.25 5.5ZM12 7C13.3261 7 14.5979 7.52678 15.5355 8.46447C16.4732 9.40215 17 10.6739 17 12C17 13.3261 16.4732 14.5979 15.5355 15.5355C14.5979 16.4732 13.3261 17 12 17C10.6739 17 9.40215 16.4732 8.46447 15.5355C7.52678 14.5979 7 13.3261 7 12C7 10.6739 7.52678 9.40215 8.46447 8.46447C9.40215 7.52678 10.6739 7 12 7ZM12 9C11.2044 9 10.4413 9.31607 9.87868 9.87868C9.31607 10.4413 9 11.2044 9 12C9 12.7956 9.31607 13.5587 9.87868 14.1213C10.4413 14.6839 11.2044 15 12 15C12.7956 15 13.5587 14.6839 14.1213 14.1213C14.6839 13.5587 15 12.7956 15 12C15 11.2044 14.6839 10.4413 14.1213 9.87868C13.5587 9.31607 12.7956 9 12 9Z" fill="#225536"></path>
                </g>
                </svg>
              </a>
              <a href="https://www.facebook.com/people/Sanitarios-Viejo-Bueno/100063935595231/?locale=pt_BR" target="_blank">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="ri:facebook-fill">
                <path id="Vector" d="M14 13.5H16.5L17.5 9.5H14V7.5C14 6.47 14 5.5 16 5.5H17.5V2.14C17.174 2.097 15.943 2 14.643 2C11.928 2 10 3.657 10 6.7V9.5H7V13.5H10V22H14V13.5Z" fill="#225536"></path>
                </g>
                </svg>
              </a>
            </div>
          </div>
        </div>
        <div class="hidden sm:block">
          <h3 class="font-medium mb-4">SECCIONES</h3>
          <ul class="flex justify-between text-neutral-600">
            <div class=" w-1/2">
              <li v-for="(link, index) in footerLinks" :key="index" class="flex flex-col" >
                <router-link :to="{ name: link.path}">
                  <div v-if="index <= 3" class="mb-4">
                    <a  class="hover:text-green-600">{{ link.text }}</a>
                  </div>
                </router-link>
              </li>
            </div>
            <div class="w-1/2">
              <li v-for="(link, index) in footerLinks" :key="index" class="" >
                <router-link :to="{ name: link.path}">
                  <div v-if="index > 3" class="mb-4">
                    <a  class="hover:text-green-600">{{ link.text }}</a>
                  </div>
                </router-link>
              </li>
            </div>
          </ul>
        </div>
        <div>
          <h3 class="font-medium mb-5">DATOS DE CONTACTO</h3>
          <div class="flex flex-col gap-5">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="21" viewBox="0 0 16 21" fill="none">
                <path d="M7.90626 0C5.81015 0.00247284 3.8006 0.836245 2.31843 2.31842C0.836253 3.80059 0.00248125 5.81014 8.41145e-06 7.90625C-0.0025021 9.61919 0.557026 11.2857 1.59276 12.65C1.59276 12.65 1.80838 12.9339 1.8436 12.9749L7.90626 20.125L13.9718 12.9713C14.0034 12.9332 14.2198 12.65 14.2198 12.65L14.2205 12.6478C15.2557 11.2841 15.815 9.61841 15.8125 7.90625C15.81 5.81014 14.9763 3.80059 13.4941 2.31842C12.0119 0.836245 10.0024 0.00247284 7.90626 0ZM7.90626 10.7812C7.33764 10.7812 6.78179 10.6126 6.30899 10.2967C5.8362 9.98082 5.46771 9.5318 5.2501 9.00646C5.0325 8.48113 4.97557 7.90306 5.0865 7.34537C5.19743 6.78767 5.47125 6.27539 5.87333 5.87332C6.2754 5.47124 6.78768 5.19742 7.34537 5.08649C7.90307 4.97556 8.48114 5.03249 9.00647 5.2501C9.53181 5.4677 9.98082 5.83619 10.2967 6.30899C10.6126 6.78178 10.7813 7.33763 10.7813 7.90625C10.7803 8.66846 10.4771 9.39917 9.93814 9.93813C9.39918 10.4771 8.66846 10.7803 7.90626 10.7812Z" fill="#225536"/>
                </svg>
                <a href="https://www.google.com.ar/maps/place/Viejo+Bueno,+B1876+Bernal+Oeste,+Provincia+de+Buenos+Aires/@-34.7182595,-58.3021325,17z/data=!3m1!4b1!4m6!3m5!1s0x95a32df384fb0579:0x3b9816caaaaee380!8m2!3d-34.7182639!4d-58.2995576!16s%2Fg%2F1tlvqq5r?entry=ttu&g_ep=EgoyMDI1MDMxNi4wIKXMDSoASAFQAw%3D%3D" target="_blank" class="hover:underline">{{ contacto?.direccion }}</a>
            </div>
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M3.11025 6.69487C4.35603 9.13102 6.33773 11.1127 8.77387 12.3585L10.6645 10.4679C10.7768 10.3554 10.9183 10.2765 11.0731 10.24C11.2278 10.2036 11.3897 10.2111 11.5404 10.2616C12.5304 10.5868 13.5659 10.7521 14.608 10.7511C14.8357 10.7519 15.0539 10.8426 15.2149 11.0036C15.3759 11.1646 15.4666 11.3828 15.4674 11.6105V14.6094C15.4666 14.8371 15.3759 15.0552 15.2149 15.2162C15.0539 15.3773 14.8357 15.468 14.608 15.4688C12.6895 15.4688 10.7899 15.0909 9.01744 14.3567C7.24503 13.6224 5.63459 12.5463 4.2781 11.1897C2.9216 9.83306 1.84561 8.22252 1.11157 6.45004C0.377533 4.67755 -0.000180514 2.77784 6.47179e-08 0.859375C0.000725221 0.631678 0.0914992 0.413513 0.252506 0.252506C0.413514 0.0914992 0.631678 0.000725156 0.859375 0H3.86788C4.09557 0.000725156 4.31374 0.0914992 4.47474 0.252506C4.63575 0.413513 4.72653 0.631678 4.72725 0.859375C4.72564 1.90149 4.8909 2.93714 5.21675 3.927C5.26561 4.07876 5.27142 4.24109 5.23356 4.39596C5.19569 4.55082 5.11562 4.69216 5.00225 4.80425L3.11025 6.69487Z" fill="#225536"/>
                </svg>
                {{ contacto?.telefono }}
            </div>
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                <path d="M16.2 0H1.8C0.81 0 0.00899999 0.7875 0.00899999 1.75L0 12.25C0 13.2125 0.81 14 1.8 14H16.2C17.19 14 18 13.2125 18 12.25V1.75C18 0.7875 17.19 0 16.2 0ZM15.84 3.71875L9.477 7.58625C9.189 7.76125 8.811 7.76125 8.523 7.58625L2.16 3.71875C2.06975 3.6695 1.99073 3.60295 1.9277 3.52315C1.86467 3.44334 1.81896 3.35193 1.79332 3.25445C1.76768 3.15697 1.76265 3.05544 1.77854 2.95602C1.79443 2.85659 1.8309 2.76134 1.88575 2.67601C1.9406 2.59069 2.01269 2.51707 2.09765 2.45962C2.18262 2.40217 2.27868 2.36207 2.38005 2.34176C2.48141 2.32145 2.58595 2.32135 2.68736 2.34145C2.78876 2.36156 2.88492 2.40147 2.97 2.45875L9 6.125L15.03 2.45875C15.1151 2.40147 15.2112 2.36156 15.3126 2.34145C15.414 2.32135 15.5186 2.32145 15.62 2.34176C15.7213 2.36207 15.8174 2.40217 15.9023 2.45962C15.9873 2.51707 16.0594 2.59069 16.1142 2.67601C16.1691 2.76134 16.2056 2.85659 16.2215 2.95602C16.2373 3.05544 16.2323 3.15697 16.2067 3.25445C16.181 3.35193 16.1353 3.44334 16.0723 3.52315C16.0093 3.60295 15.9302 3.6695 15.84 3.71875Z" fill="#225536"/>
                </svg>
                <a :href="'mailto:' + contacto?.correo" class="hover:underline">{{ contacto?.correo }}</a>
            </div>
        </div>
        </div>
      </div>
      <div class="container mx-auto px-2 sm:px-0 w-full mt-10">
        <div class="border-t border-neutral-300"></div>
        <div class="flex sm:flex-row flex-col justify-between items-center">
          <p class="text-center text-gray-600 mt-6">2024 Sanitarios Viejo Bueno. Todos los derechos reservados.</p>
          <span>by <span class="font-medium">Osole</span></span>
        </div>
      </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  data() {
    return {
      footerLinks: [
        { text: "Home", path: "home" },
        { text: "Nosotros", path: "nosotros" },
        { text: "Productos", path: "productos" },
        { text: "Marcas", path: "marcas" },
        { text: "Novedades", path: "novedades" },
        { text: "Capacitaciones", path: "capacitaciones" },
        { text: "Solicitud de presupuesto", href: "#" },
        { text: "Contacto", path: "contacto" },
      ],
    };
  },
  async created(){
        await this.get_contacto();
    },
  methods:{
    ...mapActions([
        'get_contacto',
    ]),
  },
  computed: {
    ...mapGetters([
        'contacto',
    ]),
  },
};
</script>