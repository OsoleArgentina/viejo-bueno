<template>
    <!-- Modal -->
    <div  class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 modal-animation">
            <h2 class="text-2xl font-semibold mb-4">Crear capacitacion</h2>

            <div class="w-full">
                <div class="mb-4">
                    <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" id="titulo" v-model="titulo" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Título">
                </div>

                <div class="mb-4">
                    <label for="orden" class="block text-sm font-medium text-gray-700">Orden *</label>
                    <input type="text" id="orden" v-model="orden" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Orden">
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripcion</label>

                    <text-editor unique_ref="descripcion" placeholder="Descripcion"
                        :initial_content="descripcion" v-on:text_changed="descripcion = $event">
                    </text-editor>
                </div>

                <div class="mb-4">
                    <label for="path" class="block text-sm font-medium text-gray-700">Imagen *</label>
                    <span class="text-xs text-neutral-400">Resolucion sugerida 1,304 x 1,116</span>
                    <input type="file" id="path" @change="handleImageUpload" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                </div>

                <div class="flex justify-end space-x-2">
                    <button @click="emit_event('close_modal')" type="button" class="px-4 py-2 bg-gray-300 duration-300 hover:bg-gray-400 text-black rounded-md cursor-pointer">Cancelar</button>
                    <button @click="create_capacitacion" class="px-4 py-2 bg-theme-400 text-white rounded-md duration-300 hover:bg-theme-600 cursor-pointer">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            orden: '',
            titulo: '',
            descripcion: '',
            path: '',
        };
    },
    methods: {
        handleImageUpload(event) {
            if (event.target.files[0]) {
                this.path = event.target.files[0]; 
            }
        },
        create_capacitacion() {
            const data = {
                'orden': this.orden,
                'titulo': this.titulo,
                'descripcion': this.descripcion,
                'path': this.path,
            }

            this.emit_event('create_capacitacion', data);
        },
    },
};
</script>
