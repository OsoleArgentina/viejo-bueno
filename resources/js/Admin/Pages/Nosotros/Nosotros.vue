<template>
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
                <label for="path" class="block text-sm font-medium text-gray-700">Imagen *</label>
                <input type="file" id="path" @change="handleImageUpload" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
            </div>
        </div>
        <div class="mt-4 flex w-full gap-5">
            <div class="w-1/2">
                <text-editor unique_ref="descripcion" placeholder="Descripcion"
                    :initial_content="descripcion" v-on:text_changed="descripcion = $event">
                </text-editor>
            </div>
            <div class="w-1/2 flex items-end">
                <button @click="slider_modal = true" class="px-6 py-2 mt-5 bg-theme-400 text-white rounded-md hover:bg-theme-500 duration-300 focus:outline-none focus:ring-2 cursor-pointer">
                    Guardar
                </button>
            </div>
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
        };
    },
    methods: {
        ...mapActions([
            'get_sliders',
        ]),
        async cargar_nosostros_home(data) {
            // this.isLoading = true; 
            // const method = 'POST';
            // const headers = {
            //     'Content-Type': 'multipart/form-data',
            // };

            // const response = await this.send_http_request(API_ADMIN.set_slider, method, headers, {}, data);

            // this.isLoading = false; 

            // if(!response){
            //     this.toast_notification({ message: response.data.error, type: 'error' })
            // }else{
            //     this.slider_modal = false;
            //     await this.get_sliders();
            //     this.toast_notification({ message: response.data.message })
            // }
        },

        async delete_slider(slider_id) {
            // this.isLoading = true; 

            // const method = 'DELETE';
            // const data = {slider_id: slider_id};
            // const response = await this.send_http_request(API_ADMIN.delete_slider, method, {}, {}, data);

            // this.isLoading = false;

            // if(!response){
            //     this.toast_notification({ message: response.data.error, type: 'error' })
            // }else{
            //     this.delete_slider_modal = !this.delete_slider_modal;
            //     await this.get_sliders();
            //     this.toast_notification({ message: response.data.message })
            // }
        }

    },
    async created(){
        // await this.get_sliders();
    },
    computed:{
        ...mapGetters([
            'sliders',
        ]),
    }
};
</script>