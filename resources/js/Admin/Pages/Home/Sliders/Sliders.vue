<template>
    <div class="w-full border-b border-neutral-200">
        <h1 class="text-4xl font-semibold text-neutral-800 mb-4">SLIDER</h1>
    </div>

    <div class="mb-4">
        <button @click="slider_modal = true" class="px-6 py-2 mt-5 bg-theme-400 text-white rounded-md hover:bg-theme-500 duration-300 focus:outline-none focus:ring-2 cursor-pointer">
            Cargar Slider
        </button>
    </div>

    <!-- DataTable -->
    <div v-if="sliders.length > 0" class="overflow-x-auto mt-6">
        <table class="min-w-full table-auto">
            <thead class="border-b border-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2">Imagen</th>
                    <th class="px-4 py-2">Título</th>
                    <th class="px-4 py-2">Subtítulo</th>
                    <th class="px-4 py-2">Orden</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(slider, index) in sliders" :key="slider.id" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                    <td class="px-4 py-2">
                        <template v-if="isVideo(slider.path)">
                            <video :src="`/img/${slider.path}`" autoplay muted controls class="w-20 h-20 object-cover
                            ">
                                Tu navegador no soporta el video.
                            </video>
                        </template>
                        <template v-else>
                            <img v-if="slider.path" :src="`/img/${slider.path}`" alt="Slider Image" class="w-20 h-20 object-cover">
                        </template>
                    </td>
                    <td class="px-4 py-2">{{ slider.titulo }}</td>
                    <td class="px-4 py-2">{{ slider.subtitulo }}</td>
                    <td class="px-4 py-2">{{ slider.orden }}</td>
                    <td class="px-4 py-2">
                        <button @click="edit_slider_modal = !edit_slider_modal; slider_selected=slider" class="text-theme-500 px-2 py-1 border border-theme-400 rounded-lg hover:text-white hover:bg-theme-400 duration-300 cursor-pointer"><i class="fa-regular fa-pen-to-square"></i></button>
                        <button @click="delete_slider_modal = !delete_slider_modal; slider_selected=slider" class="text-red-500 px-2 py-1 border border-red-500 rounded-lg hover:text-white hover:bg-red-500 duration-300 cursor-pointer ml-4"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else class="flex justify-center">
        <h1 class="text-xl font-semibold text-neutral-500">No hay registros</h1>
    </div>

    <!-- Spinner de carga -->
    <div v-if="isLoading" class="fixed inset-0 bg-opacity-50 bg-gray-600 flex justify-center items-center" style="z-index: 1000;">
        <div class="spinner-border animate-spin inline-block w-16 h-16 border-4 rounded-full border-t-transparent border-blue-500"></div>
    </div>


    <create_slider v-if="slider_modal" @close_modal="slider_modal = !slider_modal" @cargar_slider="cargar_slider" />
    <confirmation-modal v-if="delete_slider_modal" :message="'Estas seguro de eliminar el slider? ' + slider_selected.titulo" :data_id="slider_selected.id" @cancel="delete_slider_modal = !delete_slider_modal" @confirm="delete_slider(slider_selected.id)"/>
    <edit-slider v-if="edit_slider_modal"  :slider_edit="slider_selected" @close_modal="edit_slider_modal = !edit_slider_modal" @editar_slider="editar_slider"/>
</template> 

<script>
import API_ADMIN from '@admin/API';
import { mapGetters, mapActions } from "vuex";
import CreateSlider from './CreateSlider.vue';
import EditSlider from './EditSlider.vue';

export default {
    components:{
        'create_slider': CreateSlider,
        'edit-slider': EditSlider
    },
    data() {
        return {
            slider_modal: false, 
            edit_slider_modal: false,
            delete_slider_modal: false, 
            slider_selected: null,
            isLoading: false,
            descripcion: '',

        };
    },
    methods: {
        ...mapActions([
            'get_sliders',
        ]),
        isVideo(path) {
            const videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'webm'];
            const fileExtension = path.split('.').pop().toLowerCase();
            return videoExtensions.includes(fileExtension);
        },
        async cargar_slider(data) {
            this.isLoading = true; 
            const method = 'POST';
            const headers = {
                'Content-Type': 'multipart/form-data',
            };

            const response = await this.send_http_request(API_ADMIN.set_slider, method, headers, {}, data);

            this.isLoading = false; 

            if(response.data.error){
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.slider_modal = false;
                await this.get_sliders();
                this.toast_notification({ message: response.data.message })
            }
        },

        async editar_slider(data) {
            this.isLoading = true; 

            let formData = new FormData();
            formData.append('slider_id', data.slider_id);
            formData.append('titulo', data.titulo);
            formData.append('subtitulo', data.subtitulo);
            formData.append('orden', data.orden);
            
            if (data.path) {
                formData.append('path', data.path);
            }

            let response = await this.send_http_request(
                API_ADMIN.edit_slider,
                "POST",
                {},
                {},
                formData
            );

            this.isLoading = false; 

            if (response.data.error) {
                this.toast_notification({ message: response.data.error, type: 'error' })
            } else {
                this.edit_slider_modal = !this.edit_slider_modal;
                await this.get_sliders();
                this.toast_notification({ message: response.data.message })
            }
        },

        async delete_slider(slider_id) {
            this.isLoading = true; 

            const method = 'DELETE';
            const data = {slider_id: slider_id};
            const response = await this.send_http_request(API_ADMIN.delete_slider, method, {}, {}, data);

            this.isLoading = false;

            if(response.data.error){
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.delete_slider_modal = !this.delete_slider_modal;
                await this.get_sliders();
                this.toast_notification({ message: response.data.message })
            }
        }

    },
    async created(){
        await this.get_sliders();
    },
    computed:{
        ...mapGetters([
            'sliders',
        ]),
    }
};
</script>
