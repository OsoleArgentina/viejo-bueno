<template>
    <div  class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 modal-animation">
            <h2 class="text-2xl font-semibold mb-4">Editar Slider</h2>

            <div>
                <div class="mb-4">
                    <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" id="titulo" v-model="slider_edit.titulo" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Título">
                </div>
                <div class="mb-4">
                    <label for="subtitulo" class="block text-sm font-medium text-gray-700">Subtítulo</label>
                    <input type="text" id="subtitulo" v-model="slider_edit.subtitulo" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Subtítulo">
                </div>
                <div class="mb-4">
                    <label for="orden" class="block text-sm font-medium text-gray-700">Orden *</label>
                    <input type="text" id="orden" v-model="slider_edit.orden" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Orden">
                </div>
                <div class="mb-4">
                    <label for="path" class="block text-sm font-medium text-gray-700">Imagen *</label>
                    <input type="file" id="path" @change="handleImageUpload" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                </div>

                <div class="flex justify-end space-x-2">
                    <button @click="emit_event('close_modal')" type="button" class="px-4 py-2 bg-gray-300 duration-300 hover:bg-gray-400 text-black rounded-md cursor-pointer">Cancelar</button>
                    <button @click="editar_slider" class="px-4 py-2 bg-theme-400 text-white rounded-md duration-300 hover:bg-theme-600 cursor-pointer">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: [
      'slider_edit',
    ],
    data() {
        return {
            titulo: '',
            subtitulo: '',
            path: '',
            orden: ''
        };
    },
    methods: {
        handleImageUpload(event) {
            if (event.target.files[0]) {
                this.path = event.target.files[0]; 
            }
        },
        editar_slider() {
            const data = {
                'slider_id': this.slider_edit.id,
                'titulo': this.slider_edit.titulo,
                'subtitulo': this.slider_edit.subtitulo,
                'orden': this.slider_edit.orden,
            }

            if(this.path){
                data.path = this.path;
            }

            this.emit_event('editar_slider', data);
        },
    },
};
</script>
