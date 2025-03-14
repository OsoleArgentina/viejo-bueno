<template>
    <div class="w-full flex justify-between items-center border-b border-neutral-200 mb-4">
        <div class="flex items-center gap-2">
            <h1 class="text-4xl font-semibold text-neutral-800">SUBCATEGORIAS</h1>
            <span class="text-sm text-white bg-theme-400 rounded-full px-2 py-1">{{ subcategorias.length }}</span>
        </div>
    
        <div class="mb-4">
            <button @click="open_subcategoria_modal" class="px-6 py-2 bg-theme-400 text-white rounded-md hover:bg-theme-500 duration-300 focus:outline-none focus:ring-2 cursor-pointer">
                Crear subcategoria
            </button>
        </div>
    </div>

    <!-- DataTable -->
    <div v-if="subcategorias.length > 0" class="overflow-x-auto mt-6">
        <table class="min-w-full table-auto">
            <thead class="border-b border-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Categoria</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(subcategoria, index) in subcategorias" :key="subcategoria.id" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                    <td class="px-4 py-2">{{ subcategoria.nombre }}</td>
                    <td class="px-4 py-2">{{ subcategoria.categoria.nombre }}</td>
                    <td class="px-4 py-2">
                        <button @click="edit_subcategoria_modal = !edit_subcategoria_modal; subcategoria_selected=subcategoria" class="text-theme-500 px-2 py-1 border border-theme-400 rounded-lg hover:text-white hover:bg-theme-400 duration-300 cursor-pointer"><i class="fa-regular fa-pen-to-square"></i></button>
                        <button @click="delete_subcategoria_modal = !delete_subcategoria_modal; subcategoria_selected=subcategoria" class="text-red-500 px-2 py-1 border border-red-500 rounded-lg hover:text-white hover:bg-red-500 duration-300 cursor-pointer ml-4"><i class="fa-solid fa-trash"></i></button>
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
    
    <create-subcategoria v-if="subcategoria_modal" @close_modal="subcategoria_modal = !subcategoria_modal" @crear_subcategoria="crear_subcategoria" />
    <edit-subcategoria v-if="edit_subcategoria_modal"  :subcategoria_edit="subcategoria_selected" @close_modal="edit_subcategoria_modal = !edit_subcategoria_modal" @edit_subcategoria="edit_subcategoria"/>
    <confirmation-modal v-if="delete_subcategoria_modal" :message="'Estas seguro de eliminar la subcategoria? ' + subcategoria_selected.nombre" @cancel="delete_subcategoria_modal = !delete_subcategoria_modal" @confirm="delete_subcategoria(subcategoria_selected.id)"/>
</template>

<script>
import API_ADMIN from '@admin/API';
import { mapGetters, mapActions } from "vuex";
import CreateSubcategoria from './CreateSubcategoria.vue';
import EditSubcategoria from './EditSubcategoria.vue';

export default {
    components:{
        'create-subcategoria': CreateSubcategoria,
        'edit-subcategoria': EditSubcategoria,
    },
    data() {
        return {
            subcategoria_modal: false, 
            edit_subcategoria_modal: false,
            delete_subcategoria_modal: false, 
            subcategoria_selected: null,
            isLoading: false,
        };
    },
    methods: {
        ...mapActions([
            'get_subcategorias',
            'get_categorias',
        ]),
        open_subcategoria_modal(){
            if(this.categorias.length <= 0){
                this.toast_notification({ message: 'Primero debes crear una categoria.', type: 'error' })
                return;
            }
            this.subcategoria_modal = !this.subcategoria_modal;
        },
        async crear_subcategoria(data) {
            this.isLoading = true; 

            const response = await this.send_http_request(
                API_ADMIN.create_subcategoria, 
                'POST', 
                {}, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.subcategoria_modal = false;
                await this.get_subcategorias();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async edit_subcategoria(data) {
            this.isLoading = true; 

            const response = await this.send_http_request(
                API_ADMIN.edit_subcategoria, 
                'POST', 
                {}, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.edit_subcategoria_modal = !this.edit_subcategoria_modal;
                await this.get_subcategorias();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async delete_subcategoria(subcategoria_id) {
            this.isLoading = true; 

            const data = {subcategoria_id: subcategoria_id};
            const response = await this.send_http_request(
                API_ADMIN.delete_subcategoria,
                'DELETE', 
                {}, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.delete_subcategoria_modal = !this.delete_subcategoria_modal;
                await this.get_subcategorias();
                this.isLoading = false;
                this.toast_notification({ message: response.data.message })
            }
        }

    },
    async created(){
        this.isLoading = true; 
        await this.get_subcategorias();
        await this.get_categorias()
        this.isLoading = false; 
    },
    computed:{
        ...mapGetters([
            'subcategorias',
            'categorias',
        ]),
    }
};
</script>