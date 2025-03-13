<template>
    <!-- Modal -->
    <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-1/2 modal-animation">
            <h2 class="text-2xl font-semibold mb-4">Crear producto</h2>

            <div class="w-full">
                <div class="w-full flex gap-5 mb-4">
                    <div class="w-1/2">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre *</label>
                        <input type="text" id="nombre" v-model="nombre" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Nombre">
                    </div>
                    <div class="w-1/2">
                        <label for="marca" class="block text-sm font-medium text-gray-700">Marca *</label>
                        <input type="text" id="marca" v-model="marca" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Marca">
                    </div>
                </div>
                <div class="w-full flex gap-5 mb-4">
                    <div class="w-1/2">
                        <label for="precio" class="block text-sm font-medium text-gray-700">Precio *</label>
                        <input type="number" id="precio" v-model="precio" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Precio">
                    </div>
                    <div class="w-1/2">
                        <label for="orden" class="block text-sm font-medium text-gray-700">Orden *</label>
                        <input type="text" id="orden" v-model="orden" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Orden">
                    </div>
                </div>

                <div class="w-full mb-4">
                    <label for="ficha_tecnica" class="block text-sm font-medium text-gray-700">Ficha tecnica</label>
                    <input type="file" id="ficha_tecnica" @change="handlePDFUpload" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                </div>

                <!-- Categoría y Subcategoría -->
                <div class="w-full flex gap-5 mb-4">
                    <div class="w-1/2">
                        <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría *</label>
                        <select id="categoria_id" class="mt-1 p-2 w-full border border-gray-300 rounded-md" v-model="categoria_id">
                            <option value="" disabled selected>Selecciona una categoría</option>
                            <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                                {{ categoria.nombre }}
                            </option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="subcategoria_id" class="block text-sm font-medium text-gray-700">Subcategoría *</label>
                        <select id="subcategoria_id" class="mt-1 p-2 w-full border border-gray-300 rounded-md" v-model="subcategoria_id">
                            <option value="" disabled selected>Selecciona una subcategoría</option>
                            <option v-for="subcategoria in filteredSubcategorias" :key="subcategoria.id" :value="subcategoria.id">
                                {{ subcategoria.nombre }}
                            </option>
                        </select>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-2">
                    <button @click="emit_event('close_modal')" type="button" class="px-4 py-2 bg-gray-300 duration-300 hover:bg-gray-400 text-black rounded-md cursor-pointer">Cancelar</button>
                    <button @click="edit_producto" class="px-4 py-2 bg-theme-400 text-white rounded-md duration-300 hover:bg-theme-600 cursor-pointer">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    props: [
      'producto_edit',
    ],
    data() {
        return {
            nombre: '',
            marca: '',
            precio: '',
            orden: '',
            ficha_tecnica: '',
            categoria_id: '',  
            subcategoria_id: '', 
        };
    },
    methods: {
        handlePDFUpload(event) {
            const file = event.target.files[0]; 
            this.ficha_tecnica = file;
        },
        edit_producto() {
            const data = {
                'producto_id': this.producto_edit.id,
                'nombre': this.nombre,
                'marca': this.marca,
                'precio': this.precio,
                'orden': this.orden,
                'subcategoria_id': this.subcategoria_id,
            }

            if(this.ficha_tecnica) data.ficha_tecnica = this.ficha_tecnica;

            this.emit_event('edit_producto', data);
        },
    },
    created(){
        this.nombre = this.producto_edit.nombre;
        this.marca = this.producto_edit.marca;
        this.precio = this.producto_edit.precio;
        this.orden = this.producto_edit.orden;
        this.subcategoria_id = this.producto_edit.subcategoria_id;
        this.categoria_id = this.producto_edit.subcategoria.categoria_id;
    },
    computed: {
        ...mapGetters([
            'categorias',
            'subcategorias',
        ]),

        filteredSubcategorias() {
            return this.subcategorias.filter(subcategoria => subcategoria.categoria_id === this.categoria_id);
        }
    },
};
</script>
