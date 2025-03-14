<template>
    <div v-if="render_home_nosotros">
        
        <div class="w-full border-b border-neutral-200">
            <h1 class="text-4xl font-semibold text-neutral-800 mb-4">HOME NOSOTROS</h1>
        </div>
    
        <div class="mt-5 w-full">
            <div class="flex items-center gap-5">
                <div class="w-1/2">
                    <label for="titulo" class="block text-sm font-medium text-gray-700">Título *</label>
                    <input type="text" id="titulo" v-model="titulo" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Título">
                </div>
                <div class="w-1/2">
                    <label for="path" class="block text-sm font-medium text-gray-700">Imagen <span>{{ home_nosotros ? '' : '*' }}</span></label>
                    <span class="text-xs text-neutral-400">Resolucion sugerida 1,920 x 1800</span>
                    <input type="file" id="path" @change="handleImageUpload" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                </div>
            </div>
            <div class="mt-4 flex w-full gap-5">
                <div class="w-1/2">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripcion *</label>

                    <text-editor unique_ref="descripcion" placeholder="Descripcion"
                        :initial_content="descripcion" v-on:text_changed="descripcion = $event">
                    </text-editor>
                </div>
                <div class="w-1/2 flex items-end">
                    <button @click="set_home_nosotros" class="px-6 py-2 mt-5 bg-theme-400 text-white rounded-md hover:bg-theme-500 duration-300 focus:outline-none focus:ring-2 cursor-pointer">
                        Guardar
                    </button>
                </div>
            </div>
    
        </div>
    
        <div v-if="home_nosotros" class="w-1/2 p-6 bg-white rounded-lg shadow-md border border-gray-200 mt-20">
            <div class="flex justify-center mb-6">
                <img v-if="home_nosotros.path" :src="`/img/${home_nosotros.path}`" alt="Imagen de Nosotros" class="w-full h-auto object-cover rounded-lg shadow-lg">
            </div>
    
            <div class="mb-6">
                <h1 class="text-3xl font-semibold text-neutral-800">{{ home_nosotros.titulo}}</h1>
            </div>
            <div v-if="home_nosotros.descripcion" class="text-lg text-gray-700 leading-relaxed">
                <div v-html="home_nosotros.descripcion"></div>
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
            path: '',
            render_home_nosotros: false,
        };
    },
    methods: {
        handleImageUpload(event) {
            if (event.target.files[0]) {
                this.path = event.target.files[0]; 
            }
        },
        ...mapActions([
            'get_home_nosotros',
        ]),
        async set_home_nosotros() {
            this.isLoading = true; 
            const headers = {
                'Content-Type': 'multipart/form-data',
            };

            let data = {
                'titulo': this.titulo,
                'descripcion': this.descripcion,
            };

            if(this.path) data.path = this.path;

            const response = await this.send_http_request(
                API_ADMIN.set_home_nosotros, 
                'POST',
                headers, 
                {}, 
                data
            );


            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                await this.get_home_nosotros();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },
    },
    async created(){
        this.isLoading = true;
        await this.get_home_nosotros();
        this.descripcion = this.home_nosotros?.descripcion
        this.titulo = this.home_nosotros?.titulo

        this.render_home_nosotros = true;
        this.isLoading = false;
    },
    computed:{
        ...mapGetters([
            'home_nosotros',
        ]),
    }
};
</script>