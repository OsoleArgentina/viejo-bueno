<template>
    <!-- Modal -->
    <div  class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-1/2 modal-animation">
            <h2 class="text-2xl font-semibold mb-4">Editar novedad</h2>

            <div class="w-full">
                <div class="w-full flex gap-5 mb-4">
                    <div class="w-1/2">
                        <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                        <input type="text" id="titulo" v-model="titulo" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Título">
                    </div>
                    <div class="w-1/2">
                        <label for="subtitulo" class="block text-sm font-medium text-gray-700">Subtítulo</label>
                        <input type="text" id="subtitulo" v-model="subtitulo" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Subtítulo">
                    </div>
                </div>

                <div class="w-full flex gap-5 mb-4">
                    <div class="w-1/2">
                        <label for="orden" class="block text-sm font-medium text-gray-700">Orden *</label>
                        <input type="text" id="orden" v-model="orden" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Orden">
                    </div>
                    <div class="w-1/2">
                        <label for="path" class="block text-sm font-medium text-gray-700">Imagen *</label>
                        <span class="text-xs text-neutral-400">Resolucion sugerida 746 x 800</span>
                        <input type="file" id="path" @change="handleImageUpload" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                    </div>
                </div>

                <div class="w-full flex gap-5 mb-4">
                    <div class="w-1/2">
                        <label for="descripcion_corta" class="block text-sm font-medium text-gray-700 mb-1">Descripcion</label>

                        <text-editor unique_ref="descripcion_corta" placeholder="Descripcion"
                            :initial_content="descripcion_corta" v-on:text_changed="descripcion_corta = $event">
                        </text-editor>
                    </div>
                    <div class="w-1/2">
                        <label for="descripcion_larga" class="block text-sm font-medium text-gray-700 mb-1">Descripcion(ver mas)</label>

                        <text-editor unique_ref="descripcion_larga" placeholder="Descripcion"
                            :initial_content="descripcion_larga" v-on:text_changed="descripcion_larga = $event">
                        </text-editor>
                    </div>
                </div>

                <div class="flex justify-end space-x-2">
                    <button @click="emit_event('close_modal')" type="button" class="px-4 py-2 bg-gray-300 duration-300 hover:bg-gray-400 text-black rounded-md cursor-pointer">Cancelar</button>
                    <button @click="edit_novedad" class="px-4 py-2 bg-theme-400 text-white rounded-md duration-300 hover:bg-theme-600 cursor-pointer">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: [
      'novedad_edit',
    ],
    data() {
        return {
            orden: '',
            titulo: '',
            subtitulo: '',
            descripcion_corta: '',
            descripcion_larga: '',
            path: '',
        };
    },
    methods: {
        handleImageUpload(event) {
            if (event.target.files[0]) {
                this.path = event.target.files[0]; 
            }
        },
        edit_novedad() {
            const data = {
                'novedad_id': this.novedad_edit.id,
                'orden': this.orden,
                'titulo': this.titulo,
                'subtitulo': this.subtitulo,
                'descripcion_corta': this.descripcion_corta,
                'descripcion_larga': this.descripcion_larga,
            }

            if(this.path) data.path = this.path;

            this.emit_event('edit_novedad', data);
        },
    },
    created(){
        this.titulo = this.novedad_edit.titulo;
        this.subtitulo = this.novedad_edit.subtitulo;
        this.orden = this.novedad_edit.orden;
        this.descripcion_corta = this.novedad_edit.descripcion_corta;
        this.descripcion_larga = this.novedad_edit.descripcion_larga;
    }
};
</script>
