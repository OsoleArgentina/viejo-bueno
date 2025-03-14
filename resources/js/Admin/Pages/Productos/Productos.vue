<template>
    <div class="w-full flex justify-between items-center border-b border-neutral-200 mb-4">
        <div class="flex items-center gap-2">
            <h1 class="text-4xl font-semibold text-neutral-800">PRODUCTOS</h1>
            <span class="text-sm text-white bg-theme-400 rounded-full px-2 py-1">{{ productos.length }}</span>
        </div>
    
        <div class="mb-4">
            <button @click="open_producto_modal" class="px-6 py-2 bg-theme-400 text-white rounded-md hover:bg-theme-500 duration-300 focus:outline-none focus:ring-2 cursor-pointer">
                Crear producto
            </button>
        </div>
    </div>

    <!-- DataTable -->
    <div v-if="productos.length > 0" class="overflow-x-auto mt-6">
        <table class="min-w-full table-auto">
            <thead class="border-b border-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2">Orden</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Marca</th>
                    <th class="px-4 py-2">Precio</th>
                    <th class="px-4 py-2">Destacado</th>
                    <th class="px-4 py-2">Subcategoría</th>
                    <th class="px-4 py-2">Ficha tecnica</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(producto, index) in productos" :key="producto.id" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                    <td class="px-4 py-2">{{ producto.orden }}</td>
                    <td class="px-4 py-2">{{ producto.nombre }}</td>
                    <td class="px-4 py-2">{{ producto.marca.nombre }}</td>
                    <td class="px-4 py-2">${{ producto.precio }}</td>
                    <td class="px-4 py-2">
                        <switch-input
                            :id="producto.id"
                            :default_value="!!producto.destacado"
                            v-on:turn_on="toggle_switch_destacado(true, producto.id)"
                            v-on:turn_off="toggle_switch_destacado(false, producto.id)"/>
                    </td>
                    <td class="px-4 py-2">{{ producto.subcategoria.nombre }}</td>
                    <td v-if="producto.ficha_tecnica" class="px-4 py-2">
                        <span  @click="openPDF(producto.ficha_tecnica)" class="text-theme-500 px-2 py-1 border border-theme-400 rounded-lg hover:text-white hover:bg-theme-400 duration-300 cursor-pointer">
                            <i class="fa-solid fa-file-pdf"></i>
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        <button @click="edit_producto_imagenes_modal = !edit_producto_imagenes_modal; producto_selected=producto" class="text-blue-300 px-2 py-1 border border-blue-300 rounded-lg hover:text-white hover:bg-blue-300 duration-300 cursor-pointer"><i class="fa-solid fa-images"></i></button>
                        <button @click="edit_producto_modal = !edit_producto_modal; producto_selected=producto" class="text-theme-500 px-2 py-1 border border-theme-400 rounded-lg hover:text-white hover:bg-theme-400 duration-300 cursor-pointer ml-4"><i class="fa-regular fa-pen-to-square"></i></button>
                        <button @click="delete_producto_modal = !delete_producto_modal; producto_selected=producto" class="text-red-500 px-2 py-1 border border-red-500 rounded-lg hover:text-white hover:bg-red-500 duration-300 cursor-pointer ml-4"><i class="fa-solid fa-trash"></i></button>
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
    
    <create-producto v-if="producto_modal" @close_modal="producto_modal = !producto_modal" @crear_producto="crear_producto" />
    <edit-producto-imagenes v-if="edit_producto_imagenes_modal"  :producto_id="producto_selected.id" @close_modal="edit_producto_imagenes_modal = !edit_producto_imagenes_modal" @edit_subcategoria="edit_subcategoria"/>
    <edit-producto v-if="edit_producto_modal"  :producto_edit="producto_selected" @close_modal="edit_producto_modal = !edit_producto_modal" @edit_producto="edit_producto"/>
    <confirmation-modal v-if="delete_producto_modal" :message="'Estas seguro de eliminar el producto? ' + producto_selected.nombre" @cancel="delete_producto_modal = !delete_producto_modal" @confirm="delete_producto(producto_selected.id)"/>
</template>

<script>
import API_ADMIN from '@admin/API';
import { mapGetters, mapActions } from "vuex";
import CreateProducto from './CreateProducto.vue';
import EditProductosImagenes from './EditProductosImagenes.vue';
import EditProducto from './EditProducto.vue';

export default {
    components:{
        'create-producto': CreateProducto,
        'edit-producto': EditProducto,
        'edit-producto-imagenes': EditProductosImagenes,
    },
    data() {
        return {
            producto_modal: false, 
            edit_producto_modal: false,
            edit_producto_imagenes_modal: false,
            delete_producto_modal: false, 
            producto_selected: null,
            isLoading: false,
        };
    },
    methods: {
        ...mapActions([
            'get_subcategorias',
            'get_categorias',
            'get_productos',
            'get_marcas',
        ]),
        openPDF(fichaTecnicaUrl) {
            if (fichaTecnicaUrl) {
                let width = 1080;
                let height = 2048;
                let left = (window.screen.width - width) / 2;
                let top = (window.screen.height - height) / 2;

                window.open(
                    `/fichas/${fichaTecnicaUrl}`,
                    "",
                    `width=${width},height=${height},left=${left},top=${top}` 
                )
            } else {
                this.toast_notification({ message: 'No hay ficha técnica disponible', type: 'error' });
            }
        },
        open_producto_modal(){
            if(this.subcategorias.length <= 0){
                this.toast_notification({ message: 'Primero debes crear una subcategoria.', type: 'error' })
                return;
            }
            if(this.marcas.length <= 0){
                this.toast_notification({ message: 'Primero debes crear una marca.', type: 'error' })
                return;
            }
            this.producto_modal = !this.producto_modal;
        },
        async toggle_switch_destacado(value, producto_id){
            this.isLoading = true; 
        
            const data = {
                'producto_id': producto_id,
                'destacado': value,
            };

            const response = await this.send_http_request(
                API_ADMIN.edit_producto_destacado, 
                'POST', 
                {}, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                await this.get_productos();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },
        async crear_producto(data) {
            this.isLoading = true; 
            const headers = {
                'Content-Type': 'multipart/form-data',
            };
            const response = await this.send_http_request(
                API_ADMIN.create_producto, 
                'POST', 
                headers, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.producto_modal = false;
                await this.get_productos();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async edit_producto(data) {
            this.isLoading = true; 
            const headers = {
                'Content-Type': 'multipart/form-data',
            };
            const response = await this.send_http_request(
                API_ADMIN.edit_producto, 
                'POST', 
                headers, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.edit_producto_modal = false;
                await this.get_productos();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async delete_producto(producto_id) {
            this.isLoading = true; 

            const data = {producto_id: producto_id};
            const response = await this.send_http_request(
                API_ADMIN.delete_producto,
                'DELETE', 
                {}, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.delete_producto_modal = !this.delete_producto_modal;
                await this.get_productos();
                this.isLoading = false;
                this.toast_notification({ message: response.data.message })
            }
        }

    },
    async created(){
        this.isLoading = true;
        await this.get_subcategorias();
        await this.get_categorias();
        await this.get_productos();
        await this.get_marcas();
        this.isLoading = false;
    },
    computed:{
        ...mapGetters([
            'subcategorias',
            'categorias',
            'productos',
            'marcas',
        ]),
    }
};
</script>