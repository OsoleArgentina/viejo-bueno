<template>
    <div class="w-full container mx-auto px-2 sm:px-0 mt-20 mb-20">
        <div class="mb-20">
            <div class="w-12 border-t-2 bg-neutral-800 mb-4"></div>
            <h2 class="text-4xl font-semibold mb-4">Contacto</h2>

            <div class="flex flex-col sm:flex-row gap-16">
                <div class="w-full sm:w-1/4">
                    <p class=" text-xl mb-16">Para mayor información, no dude en contactarse mediante el siguiente formulario, o a través de nuestras vías de comunicación.</p>
                    <div class="flex flex-col gap-5">
                        <div class="flex gap-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="21" viewBox="0 0 16 21" fill="none">
                            <path d="M7.90626 0C5.81015 0.00247284 3.8006 0.836245 2.31843 2.31842C0.836253 3.80059 0.00248125 5.81014 8.41145e-06 7.90625C-0.0025021 9.61919 0.557026 11.2857 1.59276 12.65C1.59276 12.65 1.80838 12.9339 1.8436 12.9749L7.90626 20.125L13.9718 12.9713C14.0034 12.9332 14.2198 12.65 14.2198 12.65L14.2205 12.6478C15.2557 11.2841 15.815 9.61841 15.8125 7.90625C15.81 5.81014 14.9763 3.80059 13.4941 2.31842C12.0119 0.836245 10.0024 0.00247284 7.90626 0ZM7.90626 10.7812C7.33764 10.7812 6.78179 10.6126 6.30899 10.2967C5.8362 9.98082 5.46771 9.5318 5.2501 9.00646C5.0325 8.48113 4.97557 7.90306 5.0865 7.34537C5.19743 6.78767 5.47125 6.27539 5.87333 5.87332C6.2754 5.47124 6.78768 5.19742 7.34537 5.08649C7.90307 4.97556 8.48114 5.03249 9.00647 5.2501C9.53181 5.4677 9.98082 5.83619 10.2967 6.30899C10.6126 6.78178 10.7813 7.33763 10.7813 7.90625C10.7803 8.66846 10.4771 9.39917 9.93814 9.93813C9.39918 10.4771 8.66846 10.7803 7.90626 10.7812Z" fill="#225536"/>
                            </svg>
                            {{ contacto?.direccion }}
                        </div>
                        <div class="flex gap-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3.11025 6.69487C4.35603 9.13102 6.33773 11.1127 8.77387 12.3585L10.6645 10.4679C10.7768 10.3554 10.9183 10.2765 11.0731 10.24C11.2278 10.2036 11.3897 10.2111 11.5404 10.2616C12.5304 10.5868 13.5659 10.7521 14.608 10.7511C14.8357 10.7519 15.0539 10.8426 15.2149 11.0036C15.3759 11.1646 15.4666 11.3828 15.4674 11.6105V14.6094C15.4666 14.8371 15.3759 15.0552 15.2149 15.2162C15.0539 15.3773 14.8357 15.468 14.608 15.4688C12.6895 15.4688 10.7899 15.0909 9.01744 14.3567C7.24503 13.6224 5.63459 12.5463 4.2781 11.1897C2.9216 9.83306 1.84561 8.22252 1.11157 6.45004C0.377533 4.67755 -0.000180514 2.77784 6.47179e-08 0.859375C0.000725221 0.631678 0.0914992 0.413513 0.252506 0.252506C0.413514 0.0914992 0.631678 0.000725156 0.859375 0H3.86788C4.09557 0.000725156 4.31374 0.0914992 4.47474 0.252506C4.63575 0.413513 4.72653 0.631678 4.72725 0.859375C4.72564 1.90149 4.8909 2.93714 5.21675 3.927C5.26561 4.07876 5.27142 4.24109 5.23356 4.39596C5.19569 4.55082 5.11562 4.69216 5.00225 4.80425L3.11025 6.69487Z" fill="#225536"/>
                            </svg>
                            {{ contacto?.telefono }}
                        </div>
                        <div class="flex gap-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                            <path d="M16.2 0H1.8C0.81 0 0.00899999 0.7875 0.00899999 1.75L0 12.25C0 13.2125 0.81 14 1.8 14H16.2C17.19 14 18 13.2125 18 12.25V1.75C18 0.7875 17.19 0 16.2 0ZM15.84 3.71875L9.477 7.58625C9.189 7.76125 8.811 7.76125 8.523 7.58625L2.16 3.71875C2.06975 3.6695 1.99073 3.60295 1.9277 3.52315C1.86467 3.44334 1.81896 3.35193 1.79332 3.25445C1.76768 3.15697 1.76265 3.05544 1.77854 2.95602C1.79443 2.85659 1.8309 2.76134 1.88575 2.67601C1.9406 2.59069 2.01269 2.51707 2.09765 2.45962C2.18262 2.40217 2.27868 2.36207 2.38005 2.34176C2.48141 2.32145 2.58595 2.32135 2.68736 2.34145C2.78876 2.36156 2.88492 2.40147 2.97 2.45875L9 6.125L15.03 2.45875C15.1151 2.40147 15.2112 2.36156 15.3126 2.34145C15.414 2.32135 15.5186 2.32145 15.62 2.34176C15.7213 2.36207 15.8174 2.40217 15.9023 2.45962C15.9873 2.51707 16.0594 2.59069 16.1142 2.67601C16.1691 2.76134 16.2056 2.85659 16.2215 2.95602C16.2373 3.05544 16.2323 3.15697 16.2067 3.25445C16.181 3.35193 16.1353 3.44334 16.0723 3.52315C16.0093 3.60295 15.9302 3.6695 15.84 3.71875Z" fill="#225536"/>
                            </svg>
                            {{ contacto?.correo }}
                        </div>
                        <div class="flex gap-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M10 0C15.523 0 20 4.477 20 10C20 15.523 15.523 20 10 20C8.23277 20.003 6.4966 19.5353 4.97002 18.645L0.00401546 20L1.35602 15.032C0.464974 13.5049 -0.00308163 11.768 1.52687e-05 10C1.52687e-05 4.477 4.47702 0 10 0ZM6.59202 5.3L6.39201 5.308C6.26271 5.31691 6.13636 5.35087 6.02002 5.408C5.91159 5.46951 5.81258 5.5463 5.72602 5.636C5.60602 5.749 5.53802 5.847 5.46502 5.942C5.09514 6.4229 4.89599 7.01331 4.89902 7.62C4.90102 8.11 5.02902 8.587 5.22902 9.033C5.63802 9.935 6.31102 10.89 7.19902 11.775C7.41302 11.988 7.62302 12.202 7.84902 12.401C8.95245 13.3724 10.2673 14.073 11.689 14.447L12.257 14.534C12.442 14.544 12.627 14.53 12.813 14.521C13.1042 14.5056 13.3885 14.4268 13.646 14.29C13.7769 14.2223 13.9047 14.1489 14.029 14.07C14.029 14.07 14.0714 14.0413 14.154 13.98C14.289 13.88 14.372 13.809 14.484 13.692C14.568 13.6053 14.638 13.5047 14.694 13.39C14.772 13.227 14.85 12.916 14.882 12.657C14.906 12.459 14.899 12.351 14.896 12.284C14.892 12.177 14.803 12.066 14.706 12.019L14.124 11.758C14.124 11.758 13.254 11.379 12.722 11.137C12.6663 11.1128 12.6067 11.0989 12.546 11.096C12.4776 11.0888 12.4084 11.0965 12.3432 11.1184C12.278 11.1403 12.2182 11.176 12.168 11.223C12.163 11.221 12.096 11.278 11.373 12.154C11.3315 12.2098 11.2744 12.2519 11.2088 12.2751C11.1433 12.2982 11.0723 12.3013 11.005 12.284C10.9398 12.2666 10.876 12.2446 10.814 12.218C10.69 12.166 10.647 12.146 10.562 12.11C9.98789 11.8599 9.45646 11.5215 8.98702 11.107C8.86102 10.997 8.74402 10.877 8.62402 10.761C8.23063 10.3842 7.88777 9.95799 7.60401 9.493L7.54501 9.398C7.50328 9.3338 7.46905 9.26501 7.44302 9.193C7.40502 9.046 7.50402 8.928 7.50402 8.928C7.50402 8.928 7.74702 8.662 7.86002 8.518C7.97002 8.378 8.06301 8.242 8.12302 8.145C8.24102 7.955 8.27802 7.76 8.21602 7.609C7.93602 6.925 7.64668 6.24467 7.34802 5.568C7.28902 5.434 7.11402 5.338 6.95502 5.319C6.90102 5.31233 6.84701 5.307 6.79302 5.303C6.65874 5.2953 6.52411 5.29664 6.39002 5.307L6.59202 5.3Z" fill="#225536"/>
                            </svg>
                            {{ contacto?.whatsapp }}
                        </div>
                    </div>

                </div>

                <div class="w-full sm:w-3/4">
                    <div class="flex flex-col sm:flex-row gap-5 mb-4">
                        <div class="w-full sm:w-1/2">
                            <label for="nombre" class="block text-sm font-medium mb-1">Nombre y Apellido*</label>
                            <input type="text" id="nombre" v-model="nombre" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        </div>
                        <div class="w-full sm:w-1/2">
                            <label for="correo" class="block text-sm font-medium mb-1">E-mail *</label>
                            <input type="text" id="correo" v-model="correo" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        </div>
                    </div>
                    <div class="flex gap-5 mb-4">
                        <div class="w-1/2">
                            <label for="telefono" class="block text-sm font-medium mb-1">Teléfono</label>
                            <input type="text" id="telefono" v-model="telefono" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        </div>
                        <div class="w-1/2">
                            <label for="empresa" class="block text-sm font-medium mb-1">Empresa</label>
                            <input type="text" id="empresa" v-model="empresa" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        </div>
                    </div>
                    <div>
                        <label for="mensaje" class="block text-sm font-medium mb-1">Mensaje</label>
                        <textarea name="mensaje" id="mensaje" class="w-full h-60 border border-gray-300 rounded-md resize-none"></textarea>
                    </div>

                    <div class="w-full flex justify-end items-center gap-10 mt-20">
                        <span>*campos obligatorios</span>
                        <button @click="enviar_informacion_contacto" class="w-full sm:w-1/3 border border-theme-600 text-theme-400 px-4 py-2 rounded-4xl bg-site-theme duration-300 hover:text-white hover:bg-theme-400 cursor-pointer">
                            Enviar mensaje
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <div v-html="contacto?.google_maps_iframe" ref="mapIframeContainer">
        </div>
    </div>

    <!-- Spinner de carga -->
    <div v-if="isLoading" class="fixed inset-0 bg-opacity-50 bg-gray-600 flex justify-center items-center" style="z-index: 1000;">
        <div class="spinner-border animate-spin inline-block w-16 h-16 border-4 rounded-full border-t-transparent border-theme-400"></div> 
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import API_ADMIN from '@admin/API';
import { useHead } from '@vueuse/head'

export default{
    data() {
        return {
            isLoading: false,
            nombre: '',
            correo: '',
            telefono: '',
            empresa: '',
            mensaje: '',
        }
    },
    methods:{
        ...mapActions([
            'get_contacto',
        ]),
        async enviar_informacion_contacto(){
            this.isLoading = true; 
            const data = {
                'nombre': this.nombre,
                'correo': this.correo,
                'telefono': this.telefono,
                'empresa': this.empresa,
                'mensaje': this.mensaje,
            }
    
            const response = await this.send_http_request(
                API_ADMIN.enviar_informacion_contacto, 
                'POST', 
                {}, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.isLoading = false;
                this.nombre = '';
                this.correo = '';
                this.telefono = '';
                this.empresa = '';
                this.mensaje = '';
                this.toast_notification({ message: response.data.message })
            }
        }
    },
    async created(){
        useHead({
            meta: [
                { name: 'description', content: this.metadatos[4].descripcion },
                { name: 'keywords', content: this.metadatos[4].keyword },
            ],
        })
        await this.get_contacto();
        const iframe = this.$refs.mapIframeContainer.querySelector('iframe');
        if (iframe) {
            iframe.style.width = '100%';
        }
    },
    computed: {
        ...mapGetters([
            'contacto',
            'metadatos',
        ]),
    },
}

</script>