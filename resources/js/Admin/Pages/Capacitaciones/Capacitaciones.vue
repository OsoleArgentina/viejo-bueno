<template>
    <div class="w-full flex justify-between items-center border-b border-neutral-200 mb-4">
        <div class="flex items-center gap-2">
            <h1 class="text-4xl font-semibold text-neutral-800">CAPACITACIONES</h1>
            <span class="text-sm text-white bg-theme-400 rounded-full px-2 py-1">{{ capacitaciones.length }}</span>
        </div>
    
        <div class="mb-4">
            <button @click="capacitacion_modal = !capacitacion_modal" class="px-6 py-2 bg-theme-400 text-white rounded-md hover:bg-theme-500 duration-300 focus:outline-none focus:ring-2 cursor-pointer">
                Crear capacitacion
            </button>
        </div>
    </div>

    <!-- DataTable -->
    <div v-if="capacitaciones.length > 0" class="overflow-x-auto mt-6">
        <table class="min-w-full table-auto">
            <thead class="border-b border-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2">Orden</th>
                    <th class="px-4 py-2">Imagen</th>
                    <th class="px-4 py-2">Título</th>
                    <th class="px-4 py-2">Descripcion</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(capacitacion, index) in capacitaciones" :key="capacitacion.id" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                    <td class="px-4 py-2">{{ capacitacion.orden }}</td>
                    <td class="px-4 py-2">
                        <template v-if="isVideo(capacitacion.path)">
                            <video :src="`/img/${capacitacion.path}`" autoplay muted controls class="w-20 h-20 object-cover
                            ">
                                Tu navegador no soporta el video.
                            </video>
                        </template>
                        <template v-else>
                            <img v-if="capacitacion.path" :src="`/img/${capacitacion.path}`" alt="capacitacion Image" class="w-20 h-20 object-cover">
                        </template>
                    </td>
                    <td class="px-4 py-2">{{ capacitacion.titulo }}</td>
                    <td v-html="capacitacion.descripcion" class="px-4 py-2"></td>
                    <td class="px-4 py-2">
                        <button @click="edit_capacitacion_modal = !edit_capacitacion_modal; capacitacion_selected=capacitacion" class="text-theme-500 px-2 py-1 border border-theme-400 rounded-lg hover:text-white hover:bg-theme-400 duration-300 cursor-pointer"><i class="fa-regular fa-pen-to-square"></i></button>
                        <button @click="delete_capacitacion_modal = !delete_capacitacion_modal; capacitacion_selected=capacitacion" class="text-red-500 px-2 py-1 border border-red-500 rounded-lg hover:text-white hover:bg-red-500 duration-300 cursor-pointer ml-4"><i class="fa-solid fa-trash"></i></button>
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
        <div class="spinner-border animate-spin inline-block w-16 h-16 border-4 rounded-full border-t-transparent border-theme-400"></div>
    </div>


    <create-capacitacion v-if="capacitacion_modal" @close_modal="capacitacion_modal = !capacitacion_modal" @create_capacitacion="create_capacitacion" />
    <confirmation-modal v-if="delete_capacitacion_modal" :message="'Estas seguro de eliminar la capacitacion? ' + capacitacion_selected.titulo" @cancel="delete_capacitacion_modal = !delete_capacitacion_modal" @confirm="delete_capacitacion(capacitacion_selected.id)"/>
    <edit-capacitacion v-if="edit_capacitacion_modal"  :capacitacion_edit="capacitacion_selected" @close_modal="edit_capacitacion_modal = !edit_capacitacion_modal" @edit_capacitacion="edit_capacitacion"/>
</template> 

<script>
import API_ADMIN from '@admin/API';
import { mapGetters, mapActions } from "vuex";
import CreateCapacitacion from './CreateCapacitacion.vue';
import EditCapacitacion from './EditCapacitacion.vue';

export default {
    components:{
        'create-capacitacion': CreateCapacitacion,
        'edit-capacitacion': EditCapacitacion
    },
    data() {
        return {
            capacitacion_modal: false, 
            edit_capacitacion_modal: false,
            delete_capacitacion_modal: false, 
            capacitacion_selected: null,
            isLoading: false,
        };
    },
    methods: {
        ...mapActions([
            'get_capacitaciones',
        ]),
        isVideo(path) {
            const videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'webm'];
            const fileExtension = path.split('.').pop().toLowerCase();
            return videoExtensions.includes(fileExtension);
        },
        async create_capacitacion(data) {
            this.isLoading = true; 
            const headers = {
                'Content-Type': 'multipart/form-data',
            };

            const response = await this.send_http_request(
                API_ADMIN.create_capacitacion,
                'POST', 
                headers, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.capacitacion_modal = false;
                await this.get_capacitaciones();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async edit_capacitacion(data) {
            this.isLoading = true; 
            const headers = {
                'Content-Type': 'multipart/form-data',
            };
            let formData = new FormData();

            let response = await this.send_http_request(
                API_ADMIN.edit_capacitacion,
                "POST",
                headers,
                {},
                data
            );


            if (response.data.error) {
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            } else {
                this.edit_capacitacion_modal = !this.edit_capacitacion_modal;
                await this.get_capacitaciones();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async delete_capacitacion(capacitacion_id) {
            this.isLoading = true; 

            const data = {capacitacion_id: capacitacion_id};
            let response = await this.send_http_request(
                API_ADMIN.delete_capacitacion,
                "DELETE",
                {},
                {},
                data
            );

            if(response.data.error){
                this.isLoading = false;
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.delete_capacitacion_modal = !this.delete_capacitacion_modal;
                await this.get_capacitaciones();
                this.isLoading = false;
                this.toast_notification({ message: response.data.message })
            }
        }

    },
    async created(){
        this.isLoading = true;
        await this.get_capacitaciones();
        this.isLoading = false;
    },
    computed:{
        ...mapGetters([
            'capacitaciones',
        ]),
    }
};
</script>
