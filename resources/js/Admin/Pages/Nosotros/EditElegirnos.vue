<template>
    <!-- Modal -->
    <div  class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 modal-animation">
            <h2 class="text-2xl font-semibold mb-4">Crear tarjeta</h2>

            <!-- Formulario de carga del Slider -->
            <div>
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripcion *</label>
                    <input type="text" id="descripcion" v-model="elegirnos_edit.descripcion" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Descripcion">
                </div>
                <div class="mb-4">
                    <label for="orden" class="block text-sm font-medium text-gray-700">Orden *</label>
                    <input type="text" id="orden" v-model="elegirnos_edit.orden" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Orden">
                </div>
                <div class="mb-4">
                    <label for="path" class="block text-sm font-medium text-gray-700">Imagen *</label>
                    <input type="file" id="path" @change="handleImageUpload" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                </div>

                <div class="flex justify-end space-x-2">
                    <button @click="emit_event('close_modal')" type="button" class="px-4 py-2 bg-gray-300 duration-300 hover:bg-gray-400 text-black rounded-md cursor-pointer">Cancelar</button>
                    <button @click="edit_elegirnos" class="px-4 py-2 bg-theme-400 text-white rounded-md duration-300 hover:bg-theme-600 cursor-pointer">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: [
      'elegirnos_edit',
    ],
    data() {
        return {
            descripcion: '',
            orden: '',
            path: '',
        };
    },
    methods: {
        handleImageUpload(event) {
            if (event.target.files[0]) {
                this.path = event.target.files[0]; 
            }
        },
        edit_elegirnos() {
            const data = {
                'elegirnos_id': this.elegirnos_edit.id,
                'descripcion': this.elegirnos_edit.descripcion,
                'orden': this.elegirnos_edit.orden,
            }

            if(this.path){
                data.path = this.path;
            }

            this.emit_event('edit_elegirnos', data);
        },
    },
};
</script>
