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

                <div class="w-full flex gap-5 mb-4">
                    <div class="flex gap-5 w-1/2">
                        <label for="destacado" class="block text-sm font-medium text-gray-700">Destacado</label>
                        <switch-input
                            id="destacado"
                            :default_value="destacado"
                            v-on:turn_on="destacado = true"
                            v-on:turn_off="destacado = false"/>
                    </div>
                    <div class="w-1/2">
                        <label for="ficha_tecnica" class="block text-sm font-medium text-gray-700">Ficha tecnica</label>
                        <input type="file" id="ficha_tecnica" @change="handlePDFUpload" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                    </div>
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

                <div class="mb-4">
                    <label for="imagenes" class="block text-sm font-medium text-gray-700">Imágenes *</label>
                    <input type="file" id="imagenes" @change="handleImageUpload" class="mt-1 p-2 w-full border border-gray-300 rounded-md" multiple>
                    <div class="mt-2">
                        <div v-if="imagenes.length">
                            <div class="flex flex-col w-1/2">
                            <div v-for="(imagen, index) in imagenes" :key="index" class="inline-block mr-2">
                                    <div class="bg-neutral-200 flex gap-5 mb-1 items-center justify-between p-2 rounded-md">
                                        <span>{{ imagen.name }}</span>
                                        <span @click="delete_image(imagen)" class="hover:text-neutral-500 duration-300 cursor-pointer">
                                            <i class="fa-solid fa-xmark"></i>
                                        </span>
                                    </div>
                                </div>
                                </div>
                        </div>
                    </div>
                </div>

                
                <div class="flex justify-end space-x-2">
                    <button @click="emit_event('close_modal')" type="button" class="px-4 py-2 bg-gray-300 duration-300 hover:bg-gray-400 text-black rounded-md cursor-pointer">Cancelar</button>
                    <button @click="crear_producto" class="px-4 py-2 bg-theme-400 text-white rounded-md duration-300 hover:bg-theme-600 cursor-pointer">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    data() {
        return {
            nombre: '',
            marca: '',
            precio: '',
            orden: '',
            destacado: false,
            ficha_tecnica: '',
            categoria_id: '',  
            subcategoria_id: '', 
            imagenes: [],
        };
    },
    methods: {
        handleImageUpload(event) {
            const file = event.target.files[0]; 
            this.imagenes.push(file);
            event.target.value = '';
        },
        delete_image(imagen){
            this.imagenes = this.imagenes.filter(img => img.name !== imagen.name);
        },  
        handlePDFUpload(event) {
            const file = event.target.files[0]; 
            this.ficha_tecnica = file;
        },
        crear_producto() {
            const data = {
                'nombre': this.nombre,
                'marca': this.marca,
                'precio': this.precio,
                'orden': this.orden,
                'destacado': this.destacado ? 1 : 0,
                'subcategoria_id': this.subcategoria_id,
            }

            if(this.ficha_tecnica) data.ficha_tecnica = this.ficha_tecnica;
            if(this.imagenes.length > 0) data.imagenes = this.imagenes;

            this.emit_event('crear_producto', data);
        },
    },
    computed: {
        ...mapGetters([
            'categorias', // Lista de categorías
            'subcategorias', // Lista de todas las subcategorías
        ]),

        // Filtrar subcategorías según la categoría seleccionada
        filteredSubcategorias() {
            return this.subcategorias.filter(subcategoria => subcategoria.categoria_id === this.categoria_id);
        }
    },
};
</script>
