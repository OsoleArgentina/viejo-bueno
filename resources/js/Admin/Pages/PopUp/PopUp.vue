<template>
    <div v-if="render_popup">
        
        <div class="w-full border-b border-neutral-200">
            <h1 class="text-4xl font-semibold text-neutral-800 mb-4">POP-UP</h1>
        </div>
    
        <div class="mt-5 w-full">
            <div class="mb-4">
                <label for="titulo" class="block text-sm font-medium text-gray-700">Titulo *</label>
                <input type="text" id="titulo" v-model="titulo" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Titulo">
            </div>
            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripcion</label>
                <text-editor unique_ref="descripcion" placeholder="Descripcion"
                        :initial_content="descripcion" v-on:text_changed="descripcion = $event">
                </text-editor>
            </div>
            <div class="">
                <label for="desc_boton" class="block text-sm font-medium text-gray-700">Descripcion boton *</label>
                <input type="text" id="desc_boton" v-model="desc_boton" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Descripción boton">
            </div>

            <div class="w-full flex justify-end">
                <button @click="set_popup" class="px-6 py-2 mt-5 bg-theme-400 text-white rounded-md hover:bg-theme-500 duration-300 focus:outline-none focus:ring-2 cursor-pointer">
                    Guardar
                </button>
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
            desc_boton: '',
            render_popup: false,
        };
    },
    methods: {
        ...mapActions([
            'get_popup',
        ]),
        async set_popup() {
            this.isLoading = true; 

            let data = {
                'popup_id': this.popup?.id ?? null,
                'titulo': this.titulo,
                'descripcion': this.descripcion,
                'desc_boton': this.desc_boton,
            };

            const response = await this.send_http_request(
                API_ADMIN.set_popup, 
                'POST',
                {}, 
                {}, 
                data
            );


            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                await this.get_popup();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },
    },
    async created(){
        this.isLoading = true;
        await this.get_popup();
        this.titulo = this.popup?.titulo
        this.descripcion = this.popup?.descripcion
        this.desc_boton = this.popup?.desc_boton
        this.render_popup = true;
        this.isLoading = false;
    },
    computed:{
        ...mapGetters([
            'popup',
        ]),
    }
};
</script>