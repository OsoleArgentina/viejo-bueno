<template>
    <!-- Modal -->
    <div  class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 modal-animation">
            <h2 class="text-2xl font-semibold mb-4">Crear marca</h2>

            <div>
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre *</label>
                    <input type="text" id="nombre" v-model="nombre" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Nombre">
                </div>
                <div class="mb-4">
                    <label for="orden" class="block text-sm font-medium text-gray-700">Orden *</label>
                    <input type="text" id="orden" v-model="orden" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Orden">
                </div>
                <div class="mb-4 flex justify-between">
                    <label for="destacado" class="block text-sm font-medium text-gray-700">Destacado</label>
                    <switch-input
                        id="destacado"
                        :default_value="destacado"
                        v-on:turn_on="destacado = true"
                        v-on:turn_off="destacado = false"/>
                </div>
                <div class="mb-4">
                    <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría *</label>
                    <select v-model="categoria_id" id="categoria_id" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        <option value="" disabled selected>Selecciona una categoría</option>
                        <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                            {{ categoria.nombre }}
                        </option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="path" class="block text-sm font-medium text-gray-700">Imagen *</label>
                    <span class="text-xs text-neutral-400">Resolucion sugerida 500 x 241</span>
                    <input type="file" id="path" @change="handleImageUpload" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                </div>

                <div class="flex justify-end space-x-2">
                    <button @click="emit_event('close_modal')" type="button" class="px-4 py-2 bg-gray-300 duration-300 hover:bg-gray-400 text-black rounded-md cursor-pointer">Cancelar</button>
                    <button @click="crear_marca" class="px-4 py-2 bg-theme-400 text-white rounded-md duration-300 hover:bg-theme-600 cursor-pointer">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    data() {
        return {
            nombre: '',
            orden: '',
            path: '',
            destacado: false,
            categoria_id: '',
        };
    },
    methods: {
        handleImageUpload(event) {
            if (event.target.files[0]) {
                this.path = event.target.files[0]; 
            }
        },
        crear_marca() {
            const data = {
                'nombre': this.nombre,
                'orden': this.orden,
                'path': this.path,
                'destacado': this.destacado ? 1 : 0,
                'categoria_id': this.categoria_id,
            }

            this.emit_event('crear_marca', data);
        },
    },
    computed:{
        ...mapGetters([
            'categorias',
        ]),
    }
};
</script>
