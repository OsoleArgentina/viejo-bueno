<template>
    <div class="w-full container mx-auto px-2 sm:px-0 mt-20">
        <div class="">
            <div class="w-12 border-t-2 bg-neutral-800 mb-4"></div>
            <h2 class="text-4xl font-semibold mb-10">Solicitud de presupuesto</h2>

            <div class="flex flex-col gap-16">
                <div class="w-full">
                    <h2 class="text-xl text-theme-400 font-semibold mb-5">Datos personales</h2>
                    <div class="flex gap-5 mb-4">
                        <div class="w-1/2">
                            <label for="nombre" class="block text-sm font-medium mb-1">Nombre y Apellido*</label>
                            <input type="text" id="nombre" v-model="nombre" class="mt-1 p-2 w-full border border-neutral-200 rounded-md">
                        </div>
                        <div class="w-1/2">
                            <label for="correo" class="block text-sm font-medium mb-1">E-mail *</label>
                            <input type="text" id="correo" v-model="correo" class="mt-1 p-2 w-full border border-neutral-200 rounded-md">
                        </div>
                    </div>
                    <div class="flex gap-5 mb-4">
                        <div class="w-1/2">
                            <label for="telefono" class="block text-sm font-medium mb-1">Teléfono*</label>
                            <input type="text" id="telefono" v-model="telefono" class="mt-1 p-2 w-full border border-neutral-200 rounded-md">
                        </div>
                        <div class="w-1/2">
                            <label for="empresa" class="block text-sm font-medium mb-1">Empresa*</label>
                            <input type="text" id="empresa" v-model="empresa" class="mt-1 p-2 w-full border border-neutral-200 rounded-md">
                        </div>
                    </div>
                    <div class="border-b border-neutral-200 mt-10"></div>
                </div>

                <div class="w-full">
                    <h2 class="text-xl text-theme-400 font-semibold mb-5">Datos personales</h2>
                    <div class="flex gap-5 mb-4">
                        <div class="w-1/2">
                            <label for="categoria_id" class="block text-sm font-medium mb-1">Categoría *</label>
                            <select v-model="categoria_id" id="categoria_id" class="mt-1 p-2 w-full border border-neutral-200 rounded-md">
                                <option value="" disabled selected>Seleccionar categoría</option>
                                <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                                    {{ categoria.nombre }}
                                </option>
                            </select>
                        </div>
                        <div class="w-1/2">
                            <label for="marca_id" class="block text-sm font-medium mb-1">Marca *</label>
                            <select id="marca_id" class="mt-1 p-2 w-full border border-neutral-200 rounded-md" v-model="marca_id">
                                <option value="" disabled selected>Seleccionar producto</option>
                                <option v-for="marca in filteredMarcas" :key="marca.id" :value="marca.id">
                                    {{ marca.nombre }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="border-b border-neutral-200 mt-10"></div>
                </div>

                <div class="w-full">
                    <h2 class="text-xl text-theme-400 font-semibold mb-5">Aclaraciones</h2>
                    <div class="flex flex-col sm:flex-row gap-5 mb-4">
                        <div class="w-full sm:w-1/2">
                            <label for="aclaraciones" class="block text-sm font-medium mb-1">Aclaraciones / Observaciones</label>
                            <textarea name="aclaraciones" id="aclaraciones" v-model="aclaraciones" class="w-full h-60 border border-neutral-200 rounded-md resize-none"></textarea>
                        </div>
                        <div class="flex flex-col justify-between w-full sm:w-1/2">
                            <div>
                                <label for="archivo" class="block text-sm font-medium mb-1">Adjuntar archivos</label>
                                <label for="archivo" class="w-full flex items-center justify-between px-4 py-2 bg-white border border-neutral-200 text-gray-500 cursor-pointer">
                                    <span>Adjuntar archivo</span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="lucide/upload">
                                            <path id="Vector" d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15M17 8L12 3M12 3L7 8M12 3V15" stroke="#C2C0C0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </g>
                                    </svg>
                                </label>
                                <input @change="handleImageUpload" type="file" id="archivo" name="archivo" multiple class="hidden">
                                <label for="archivo" class="w-full flex justify-end my-1">
                                    <span class="font-semibold text-theme-400 cursor-pointer hover:text-theme-500 hover:shadow-md duration-300">+ Adjuntar otro</span>
                                </label>
                                <div class="mt-2">
                                    <div v-if="archivos.length">
                                        <div class="flex flex-col w-1/2">
                                        <div v-for="(archivo, index) in archivos" :key="index" class="inline-block mr-2">
                                                <div class="bg-site-theme flex gap-5 mb-1 items-center justify-between p-2 rounded-md">
                                                    <span>{{ archivo.name }}</span>
                                                    <span @click="delete_archivo(archivo)" class="hover:text-neutral-500 duration-300 cursor-pointer">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full flex justify-end items-center gap-10 mt-20">
                                <button 
                                    @click.prevent="verificarCaptcha" 
                                    class="g-recaptcha w-full sm:w-1/3 border border-theme-600 text-theme-400 px-4 py-2 rounded-4xl bg-site-theme duration-300 hover:text-white hover:bg-theme-400 cursor-pointer"
                                    data-sitekey="6LfMDCMrAAAAAMROXVZnS2jgp5g6Uq_Vr-F-3OvV"
                                    data-callback="onCaptchaVerified"
                                    data-action="submit">
                                    Solicitar presupuesto
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>

    <!-- Spinner de carga -->
    <div v-if="isLoading" class="fixed inset-0 bg-opacity-50 bg-gray-600 flex justify-center items-center" style="z-index: 1000;">
        <div class="spinner-border animate-spin inline-block w-16 h-16 border-4 rounded-full border-t-transparent border-theme-400"></div> 
    </div>
    <div 
        class="g-recaptcha" 
        data-sitekey="6LfMDCMrAAAAAMROXVZnS2jgp5g6Uq_Vr-F-3OvV" 
        data-size="invisible"
        data-callback="onCaptchaVerified">
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import API_ADMIN from '@admin/API';

export default{
    data() {
        return {
            isLoading: false,
            // datos personales
            nombre: '',
            correo: '',
            telefono: '',
            empresa: '',

            // producto
            categoria_id: '',
            marca_id: '',

            // aclaraciones
            aclaraciones: '',
            archivo: '',
            archivos: [],
            recaptchaToken: null

        }
    },
    methods:{
        ...mapActions([
            'get_categorias',
            'get_marcas',
        ]),
        verificarCaptcha() {
            // Ejecutar el reCAPTCHA
            window.grecaptcha.execute();
        },
        
        async onCaptchaVerified(token) {
            // Esta función será llamada por el callback del reCAPTCHA
            this.recaptchaToken = token;
            await this.solicitar_presupuesto();
        },
        handleImageUpload(event) {
            const file = event.target.files[0]; 
            this.archivos.push(file);
            event.target.value = '';
        },
        delete_archivo(archivo){
            this.archivos = this.archivos.filter(arch => arch.name !== archivo.name);
        },  
        async solicitar_presupuesto(){
            this.isLoading = true; 
            const headers = {
                'Content-Type': 'multipart/form-data',
            };
            const data = {
                'nombre': this.nombre,
                'correo': this.correo,
                'telefono': this.telefono,
                'empresa': this.empresa,
                'categoria_id': this.categoria_id,
                'marca_id': this.marca_id,
                'aclaraciones': this.aclaraciones,
                'archivos': this.archivos,
                'g-recaptcha-response': this.recaptchaToken // Agregar el token
            }
    
            const response = await this.send_http_request(
                API_ADMIN.solicitar_presupuesto, 
                'POST', 
                headers, 
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
                this.categoria_id = '';
                this.marca_id = '';
                this.aclaraciones = '';
                this.archivos = [];
                this.toast_notification({ message: response.data.message })
            }

            // Resetear el reCAPTCHA para futuros envíos
            window.grecaptcha.reset();
        }
    },
    async created(){
        // Definir la función de callback en el objeto window para que sea accesible globalmente
        window.onCaptchaVerified = this.onCaptchaVerified;
        await this.get_categorias();
        await this.get_marcas();
    },
    mounted() {
        // Cargar el script de reCAPTCHA si no está ya cargado
        if (!document.querySelector('script[src="https://www.google.com/recaptcha/api.js"]')) {
            const recaptchaScript = document.createElement('script')
            recaptchaScript.setAttribute('src', 'https://www.google.com/recaptcha/api.js')
            recaptchaScript.setAttribute('async', '')
            recaptchaScript.setAttribute('defer', '')
            document.head.appendChild(recaptchaScript)
        }
    },
    updated() {
        // Cargar el script de reCAPTCHA si no está ya cargado
        // if (!document.querySelector('script[src="https://www.google.com/recaptcha/api.js"]')) {
            const recaptchaScript = document.createElement('script')
            recaptchaScript.setAttribute('src', 'https://www.google.com/recaptcha/api.js')
            recaptchaScript.setAttribute('async', '')
            recaptchaScript.setAttribute('defer', '')
            document.head.appendChild(recaptchaScript)
        // }
    },
    computed: {
        ...mapGetters([
            'categorias',
            'marcas',
        ]),
        filteredMarcas() {
            return this.marcas.filter(marca => marca.categoria_id === this.categoria_id);
        }
    },
}

</script>