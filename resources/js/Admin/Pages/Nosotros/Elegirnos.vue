<template>
    <div class="w-full border-b border-neutral-200">
        <h1 class="text-4xl font-semibold text-neutral-800 mb-4">¿POR QUÉ ELEGIRNOS?</h1>
    </div>

    <div class="mb-4">
        <button @click="elegirnos_modal = true" class="px-6 py-2 mt-5 bg-theme-400 text-white rounded-md hover:bg-theme-500 duration-300 focus:outline-none focus:ring-2 cursor-pointer">
            Crear tarjeta
        </button>
    </div>

    <!-- DataTable -->
    <div v-if="nosotros_elegirnos.length > 0" class="overflow-x-auto mt-6">
        <table class="min-w-full table-auto">
            <thead class="border-b border-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2">Imagen</th>
                    <th class="px-4 py-2">Descripcion</th>
                    <th class="px-4 py-2">Orden</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(elg, index) in nosotros_elegirnos" :key="elg.id" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                    <td class="px-4 py-2">
                        <img v-if="elg.path" :src="`/img/${elg.path}`" alt="Slider Image" class="w-20 h-20 object-cover">
                    </td>
                    <td class="px-4 py-2">{{ elg.descripcion }}</td>
                    <td class="px-4 py-2">{{ elg.orden }}</td>
                    <td class="px-4 py-2">
                        <button @click="edit_elegirnos_modal = !edit_elegirnos_modal; elegirnos_selected=elg" class="text-theme-500 px-2 py-1 border border-theme-400 rounded-lg hover:text-white hover:bg-theme-400 duration-300 cursor-pointer"><i class="fa-regular fa-pen-to-square"></i></button>
                        <button @click="delete_elegirnos_modal = !delete_elegirnos_modal; elegirnos_selected=elg" class="text-red-500 px-2 py-1 border border-red-500 rounded-lg hover:text-white hover:bg-red-500 duration-300 cursor-pointer ml-4"><i class="fa-solid fa-trash"></i></button>
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
    
    <create-elegirnos v-if="elegirnos_modal" @close_modal="elegirnos_modal = !elegirnos_modal" @crear_elegirnos="crear_elegirnos" />
    <edit-elegirnos v-if="edit_elegirnos_modal"  :elegirnos_edit="elegirnos_selected" @close_modal="edit_elegirnos_modal = !edit_elegirnos_modal" @edit_elegirnos="edit_elegirnos"/>
    <confirmation-modal v-if="delete_elegirnos_modal" :message="'Estas seguro de eliminar la tarjeta?'" @cancel="delete_elegirnos_modal = !delete_elegirnos_modal" @confirm="delete_slider(elegirnos_selected.id)"/>
</template>

<script>
import API_ADMIN from '@admin/API';
import { mapGetters, mapActions } from "vuex";
import CreateElegirnos from './CreateElegirnos.vue';
import EditElegirnos from './EditElegirnos.vue';

export default {
    components:{
        'create-elegirnos': CreateElegirnos,
        'edit-elegirnos': EditElegirnos,
    },
    data() {
        return {
            elegirnos_modal: false, 
            edit_elegirnos_modal: false,
            delete_elegirnos_modal: false, 
            elegirnos_selected: null,
            isLoading: false,
        };
    },
    methods: {
        ...mapActions([
            'get_nosotros_elegirnos',
        ]),
        async crear_elegirnos(data) {
            this.isLoading = true; 
            const headers = {
                'Content-Type': 'multipart/form-data',
            };

            const response = await this.send_http_request(
                API_ADMIN.create_elegirnos, 
                'POST', 
                headers, 
                {}, 
                data);

            this.isLoading = false; 

            if(response.data.error){
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.elegirnos_modal = false;
                await this.get_nosotros_elegirnos();
                this.toast_notification({ message: response.data.message })
            }
        },

        async edit_elegirnos(data) {
            this.isLoading = true; 

            let formData = new FormData();
            formData.append('elegirnos_id', data.elegirnos_id);
            formData.append('descripcion', data.descripcion);
            formData.append('orden', data.orden);
            
            if (data.path) {
                formData.append('path', data.path);
            }

            let response = await this.send_http_request(
                API_ADMIN.edit_elegirnos,
                "POST",
                {},
                {},
                formData
            );

            this.isLoading = false; 

            if (response.data.error) {
                this.toast_notification({ message: response.data.error, type: 'error' })
            } else {
                this.edit_elegirnos_modal = !this.edit_elegirnos_modal;
                await this.get_nosotros_elegirnos();
                this.toast_notification({ message: response.data.message })
            }
        },

        async delete_slider(elegirnos_id) {
            this.isLoading = true; 

            const data = {elegirnos_id: elegirnos_id};
            const response = await this.send_http_request(
                API_ADMIN.delete_elegirnos,
                'DELETE', 
                {}, 
                {}, 
                data
            );

            this.isLoading = false;

            if(response.data.error){
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.delete_elegirnos_modal = !this.delete_elegirnos_modal;
                await this.get_nosotros_elegirnos();
                this.toast_notification({ message: response.data.message })
            }
        }

    },
    async created(){
        await this.get_nosotros_elegirnos();
    },
    computed:{
        ...mapGetters([
            'nosotros_elegirnos',
        ]),
    }
};
</script>