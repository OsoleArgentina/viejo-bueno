<template>
    <div class="w-full flex justify-between items-center border-b border-neutral-200 mb-4">
        <div class="flex items-center gap-2">
            <h1 class="text-4xl font-semibold text-neutral-800">MARCAS</h1>
            <span class="text-sm text-white bg-theme-400 rounded-full px-2 py-1">{{ marcas.length }}</span>
        </div>
    
        <div class="mb-4">
            <button @click="marca_modal = !marca_modal" class="px-6 py-2 bg-theme-400 text-white rounded-md hover:bg-theme-500 duration-300 focus:outline-none focus:ring-2 cursor-pointer">
                Crear marca
            </button>
        </div>
    </div>

    <!-- DataTable -->
    <div v-if="marcas.length > 0" class="overflow-x-auto mt-6">
        <table class="min-w-full table-auto">
            <thead class="border-b border-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2">Orden</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Imagen</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(marca, index) in marcas" :key="marca.id" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                    <td class="px-4 py-2">{{ marca.orden }}</td>
                    <td class="px-4 py-2">{{ marca.nombre }}</td><td class="px-4 py-2">
                        <img v-if="marca.path" :src="`/img/${marca.path}`" alt="Slider Image" class="w-20 h-20 object-contain">
                    </td>
                    <td class="px-4 py-2">
                        <button @click="edit_marca_modal = !edit_marca_modal; marca_selected=marca" class="text-theme-500 px-2 py-1 border border-theme-400 rounded-lg hover:text-white hover:bg-theme-400 duration-300 cursor-pointer"><i class="fa-regular fa-pen-to-square"></i></button>
                        <button @click="delete_marca_modal = !delete_marca_modal; marca_selected=marca" class="text-red-500 px-2 py-1 border border-red-500 rounded-lg hover:text-white hover:bg-red-500 duration-300 cursor-pointer ml-4"><i class="fa-solid fa-trash"></i></button>
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
    
    <create-marca v-if="marca_modal" @close_modal="marca_modal = !marca_modal" @crear_marca="crear_marca" />
    <edit-marca v-if="edit_marca_modal"  :marca_edit="marca_selected" @close_modal="edit_marca_modal = !edit_marca_modal" @edit_marca="edit_marca"/>
    <confirmation-modal v-if="delete_marca_modal" :message="'Estas seguro de eliminar la marca? ' + marca_selected.nombre" @cancel="delete_marca_modal = !delete_marca_modal" @confirm="delete_marca(marca_selected.id)"/>
</template>

<script>
import API_ADMIN from '@admin/API';
import { mapGetters, mapActions } from "vuex";
import CreateMarca from './CreateMarca.vue';
import EditMarca from './EditMarca.vue';

export default {
    components:{
        'create-marca': CreateMarca,
        'edit-marca': EditMarca,
    },
    data() {
        return {
            marca_modal: false, 
            edit_marca_modal: false,
            delete_marca_modal: false, 
            marca_selected: null,
            isLoading: false,
        };
    },
    methods: {
        ...mapActions([
            'get_marcas',
        ]),
        async crear_marca(data) {
            this.isLoading = true; 
            const headers = {
                'Content-Type': 'multipart/form-data',
            };
            const response = await this.send_http_request(
                API_ADMIN.create_marca, 
                'POST', 
                headers, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.marca_modal = false;
                await this.get_marcas();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async edit_marca(data) {
            this.isLoading = true; 
            const headers = {
                'Content-Type': 'multipart/form-data',
            };
            const response = await this.send_http_request(
                API_ADMIN.edit_marca, 
                'POST', 
                headers, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.edit_marca_modal = !this.edit_marca_modal;
                await this.get_marcas();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async delete_marca(marca_id) {
            this.isLoading = true; 

            const data = {marca_id: marca_id};
            const response = await this.send_http_request(
                API_ADMIN.delete_marca,
                'DELETE', 
                {}, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.delete_marca_modal = !this.delete_marca_modal;
                await this.get_marcas();
                this.isLoading = false;
                this.toast_notification({ message: response.data.message })
            }
        }

    },
    async created(){
        this.isLoading = true; 
        await this.get_marcas();
        this.isLoading = false; 
    },
    computed:{
        ...mapGetters([
            'marcas',
        ]),
    }
};
</script>