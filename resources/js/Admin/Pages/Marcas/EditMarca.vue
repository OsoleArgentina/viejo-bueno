<template>
    <!-- Modal -->
    <div  class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 modal-animation">
            <h2 class="text-2xl font-semibold mb-4">Editar marca</h2>

            <div>
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre *</label>
                    <input type="text" id="nombre" v-model="nombre" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Nombre">
                </div>
                <div class="mb-4">
                    <label for="orden" class="block text-sm font-medium text-gray-700">Orden *</label>
                    <input type="text" id="orden" v-model="orden" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Orden">
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
                    <button @click="edit_marca" class="px-4 py-2 bg-theme-400 text-white rounded-md duration-300 hover:bg-theme-600 cursor-pointer">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    props: [
      'marca_edit',
    ],
    data() {
        return {
            descripcion: '',
            orden: '',
            path: '',
            categoria_id: '',
        };
    },
    methods: {
        handleImageUpload(event) {
            if (event.target.files[0]) {
                this.path = event.target.files[0]; 
            }
        },
        edit_marca() {
            const data = {
                'marca_id': this.marca_edit.id,
                'nombre': this.nombre,
                'orden': this.orden,
                'categoria_id': this.categoria_id,
            }

            if(this.path){
                data.path = this.path;
            }

            this.emit_event('edit_marca', data);
        },
    },
    created(){
        this.nombre = this.marca_edit.nombre;
        this.orden = this.marca_edit.orden;
        this.categoria_id = this.marca_edit.categoria_id;
    },
    computed:{
        ...mapGetters([
            'categorias',
        ]),
    },
};
</script>
