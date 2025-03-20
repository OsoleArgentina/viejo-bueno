<template>
    <div class="w-full flex justify-between items-center border-b border-neutral-200 mb-4">
        <div class="flex items-center gap-2">
            <h1 class="text-4xl font-semibold text-neutral-800">CATEGORIAS</h1>
            <span class="text-sm text-white bg-theme-400 rounded-full px-2 py-1">{{ categorias.length }}</span>
        </div>
    
        <div class="mb-4">
            <button @click="categoria_modal = true" class="px-6 py-2 bg-theme-400 text-white rounded-md hover:bg-theme-500 duration-300 focus:outline-none focus:ring-2 cursor-pointer">
                Crear categoria
            </button>
        </div>
    </div>

    <!-- DataTable -->
    <div v-if="categorias.length > 0" class="overflow-x-auto mt-6">
        <table class="min-w-full table-auto">
            <thead class="border-b border-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2">Orden</th>
                    <th class="px-4 py-2">Imagen</th>
                    <th class="px-4 py-2">Icono</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Destacado</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(categoria, index) in categorias" :key="categoria.id" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                    <td class="px-4 py-2">{{ categoria.orden }}</td>
                    <td class="px-4 py-2">
                        <img v-if="categoria.path" :src="`/img/${categoria.path}`" alt="categoria Image" class="w-20 h-20 object-cover">
                    </td>
                    <td class="px-4 py-2">
                        <img v-if="categoria.icono" :src="`/img/${categoria.icono}`" alt="categoria Image" class="w-20 h-20 object-cover bg-neutral-100">
                    </td>
                    <td class="px-4 py-2">{{ categoria.nombre }}</td>
                    <td class="px-4 py-2">
                        <switch-input
                            :id="categoria.id"
                            :default_value="!!categoria.destacado"
                            v-on:turn_on="toggle_switch_destacado(true, categoria.id)"
                            v-on:turn_off="toggle_switch_destacado(false, categoria.id)"/>
                    </td>
                    <td class="px-4 py-2">
                        <button @click="edit_categoria_modal = !edit_categoria_modal; categoria_selected=categoria" class="text-theme-500 px-2 py-1 border border-theme-400 rounded-lg hover:text-white hover:bg-theme-400 duration-300 cursor-pointer"><i class="fa-regular fa-pen-to-square"></i></button>
                        <button @click="delete_categoria_modal = !delete_categoria_modal; categoria_selected=categoria" class="text-red-500 px-2 py-1 border border-red-500 rounded-lg hover:text-white hover:bg-red-500 duration-300 cursor-pointer ml-4"><i class="fa-solid fa-trash"></i></button>
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
    
    <create-categoria v-if="categoria_modal" @close_modal="categoria_modal = !categoria_modal" @crear_categoria="crear_categoria" />
    <edit-categoria v-if="edit_categoria_modal"  :categoria_edit="categoria_selected" @close_modal="edit_categoria_modal = !edit_categoria_modal" @edit_categoria="edit_categoria"/>
    <confirmation-modal v-if="delete_categoria_modal" :message="'Estas seguro de eliminar la categoria? ' + categoria_selected.nombre" @cancel="delete_categoria_modal = !delete_categoria_modal" @confirm="delete_categoria(categoria_selected.id)"/>
</template>

<script>
import API_ADMIN from '@admin/API';
import { mapGetters, mapActions } from "vuex";
import CreateCategoria from './CreateCategoria.vue';
import EditCategorias from './EditCategorias.vue';
export default {
    components:{
        'create-categoria': CreateCategoria,
        'edit-categoria': EditCategorias,
    },
    data() {
        return {
            categoria_modal: false, 
            edit_categoria_modal: false,
            delete_categoria_modal: false, 
            categoria_selected: null,
            isLoading: false,
        };
    },
    methods: {
        ...mapActions([
            'get_categorias',
        ]),
        async crear_categoria(data) {
            this.isLoading = true; 
            const headers = {
                'Content-Type': 'multipart/form-data',
            };

            const response = await this.send_http_request(
                API_ADMIN.create_categoria, 
                'POST', 
                headers, 
                {}, 
                data
            );


            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.categoria_modal = false;
                await this.get_categorias();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async toggle_switch_destacado(value, categoria_id){
            this.isLoading = true; 
        
            const data = {
                'categoria_id': categoria_id,
                'destacado': value,
            };

            const response = await this.send_http_request(
                API_ADMIN.edit_categoria_destacado, 
                'POST', 
                {}, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                await this.get_categorias();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async edit_categoria(data) {
            this.isLoading = true; 

            let formData = new FormData();
            formData.append('categoria_id', data.categoria_id);
            formData.append('nombre', data.nombre);
            formData.append('orden', data.orden);
            
            if (data.path) formData.append('path', data.path);
            if (data.icono) formData.append('icono', data.icono);

            let response = await this.send_http_request(
                API_ADMIN.edit_categoria,
                "POST",
                {},
                {},
                formData
            );


            if (response.data.error) {
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            } else {
                this.edit_categoria_modal = !this.edit_categoria_modal;
                await this.get_categorias();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async delete_categoria(categoria_id) {
            this.isLoading = true; 

            const data = {categoria_id: categoria_id};
            const response = await this.send_http_request(
                API_ADMIN.delete_categoria,
                'DELETE', 
                {}, 
                {}, 
                data
            );


            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.delete_categoria_modal = !this.delete_categoria_modal;
                await this.get_categorias();
                this.isLoading = false;
                this.toast_notification({ message: response.data.message })
            }
        }

    },
    async created(){
        this.isLoading = true;
        await this.get_categorias();
        this.isLoading = false;
    },
    computed:{
        ...mapGetters([
            'categorias',
        ]),
    }
};
</script>