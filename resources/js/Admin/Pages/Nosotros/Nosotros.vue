<template>
    <div v-if="render_nosotros">
        
        <div class="w-full border-b border-neutral-200">
            <h1 class="text-4xl font-semibold text-neutral-800 mb-4">NOSOTROS</h1>
        </div>
    
        <div class="mt-5 w-full">
            <div class="flex items-center gap-5">
                <div class="w-1/2">
                    <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" id="titulo" v-model="titulo" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Título">
                </div>
                <div class="w-1/2">
                    <label for="banner_principal" class="block text-sm font-medium text-gray-700">Imagen banner principal *</label>
                    <span class="text-xs text-neutral-400">Resolucion sugerida 1,600 x 637</span>
                    <input type="file" id="banner_principal" @change="handleImageUpload" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                </div>
            </div>
            <div class="mt-4 flex w-full gap-5">
                <div class="w-1/2">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripcion</label>

                    <text-editor unique_ref="descripcion" placeholder="Descripcion"
                        :initial_content="descripcion" v-on:text_changed="descripcion = $event">
                    </text-editor>
                </div>
                <div class="w-1/2">
                    <label for="banner_secundario" class="block text-sm font-medium text-gray-700">Imagen banner secundario *</label>
                    <span class="text-xs text-neutral-400">Resolucion sugerida 2,718 x 1,812</span>
                    <input type="file" id="banner_secundario" @change="handleImageUpload" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                </div>
            </div>
            <div class="w-full text-end">
                <button @click="set_nosotros" class="px-6 py-2 mt-5 bg-theme-400 text-white rounded-md hover:bg-theme-500 duration-300 focus:outline-none focus:ring-2 cursor-pointer">
                    Guardar
                </button>
            </div>
    
        </div>
    
        <div v-if="nosotros" class="w-full flex gap-5 mt-10">
            <div class="w-1/2">
                <h2 class="font-semibold mb-2 text-xl text-neutral-700">Banner principal</h2>
                <div class="w-full rounded-lg shadow-md border border-gray-200 p-2">
                    <div class="flex justify-center mb-6">
                        <img v-if="nosotros.banner_principal" :src="`/img/${nosotros.banner_principal}`" alt="Imagen de Nosotros" class="w-full h-auto object-cover rounded-lg shadow-lg">
                    </div>
            
                    <div class="mb-6">
                        <h1 class="text-3xl font-semibold text-neutral-800">{{ nosotros.titulo}}</h1>
                    </div>
                    <div v-if="nosotros.descripcion" class="text-lg text-gray-700 leading-relaxed">
                        <div v-html="nosotros.descripcion"></div>
                    </div>
                </div>
            </div>
            <div class="w-1/2">
                <h2 class="font-semibold mb-2 text-xl text-neutral-700">Banner secundario</h2>

                <div v-if="nosotros.banner_secundario" class="w-full flex justify-center mb-6 rounded-lg shadow-md border border-gray-200 p-2">
                    <div class="w-full h-auto">
                        <video :src="`/img/${nosotros.banner_secundario}`" autoplay muted controls  class="w-full h-auto rounded-lg shadow-lg">
                            Tu navegador no soporta el video.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Spinner de carga -->
        <div v-if="isLoading" class="fixed inset-0 bg-opacity-50 bg-gray-600 flex justify-center items-center" style="z-index: 1000;">
            <div class="spinner-border animate-spin inline-block w-16 h-16 border-4 rounded-full border-t-transparent border-theme-400"></div>
        </div>
    </div>

</template>

<script>
import API_ADMIN from '@admin/API';
import { mapGetters, mapActions } from "vuex";

export default {
    data() {
        return {
            isLoading: false,
            titulo: '',
            descripcion: '',
            banner_principal: '',
            banner_secundario: '',
            render_nosotros: false,
        };
    },
    methods: {
        handleImageUpload(event) {
            if (event.target.files[0]) {
                if(event.target.id == 'banner_principal'){
                    this.banner_principal = event.target.files[0]; 
                }
                if(event.target.id == 'banner_secundario'){
                    this.banner_secundario = event.target.files[0]; 
                }
            }
        },
        ...mapActions([
            'get_nosotros',
        ]),
        async set_nosotros() {
            this.isLoading = true; 
            const headers = {
                'Content-Type': 'multipart/form-data',
            };

            let data = {
                'titulo': this.titulo,
                'descripcion': this.descripcion,
            };

            if(this.banner_principal) data.banner_principal = this.banner_principal;
            if(this.banner_secundario) data.banner_secundario = this.banner_secundario;

            const response = await this.send_http_request(
                API_ADMIN.set_nosotros, 
                'POST',
                headers, 
                {}, 
                data
            );


            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                await this.get_nosotros();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },
    },
    async created(){
        this.isLoading = true;
        await this.get_nosotros();
        this.descripcion = this.nosotros?.descripcion
        this.titulo = this.nosotros?.titulo

        this.render_nosotros = true;
        this.isLoading = false;
    },
    computed:{
        ...mapGetters([
            'nosotros',
        ]),
    }
};
</script>