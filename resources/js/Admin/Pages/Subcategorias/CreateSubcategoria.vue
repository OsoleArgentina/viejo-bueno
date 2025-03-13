<template>
    <!-- Modal -->
    <div  class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 modal-animation">
            <h2 class="text-2xl font-semibold mb-4">Crear subcategoria</h2>

            <div>
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre *</label>
                    <input type="text" id="nombre" v-model="nombre" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Nombre">
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
                

                <div class="flex justify-end space-x-2">
                    <button @click="emit_event('close_modal')" type="button" class="px-4 py-2 bg-gray-300 duration-300 hover:bg-gray-400 text-black rounded-md cursor-pointer">Cancelar</button>
                    <button @click="crear_subcategoria" class="px-4 py-2 bg-theme-400 text-white rounded-md duration-300 hover:bg-theme-600 cursor-pointer">Guardar</button>
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
            categoria_id: '',
        };
    },
    methods: {
        crear_subcategoria() {
            const data = {
                'nombre': this.nombre,
                'categoria_id': this.categoria_id,
            }

            this.emit_event('crear_subcategoria', data);
        },
    },
    computed:{
        ...mapGetters([
            'categorias',
        ]),
    }
};
</script>
