<template>
    <!-- Modal -->
    <div  class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 modal-animation">
            <h2 class="text-2xl font-semibold mb-4">Editar capacitacion</h2>

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

                <div class="mb-4 border-b border-neutral-200">
                    <div class="flex justify-between items-center mb-4">
                        <label for="youtube_iframe" class="block text-sm font-medium text-gray-700">Youtube iframe *</label>
                        <switch-input
                            id="show_youtube_iframe"
                            :default_value="show_youtube_iframe"
                            v-on:turn_on="show_youtube_iframe = true"
                            v-on:turn_off="show_youtube_iframe = false"/>
                    </div>
                    <input v-if="show_youtube_iframe" type="text" id="youtube_iframe" v-model="youtube_iframe" class="mt-1 mb-4 p-2 w-full border border-gray-300 rounded-md" placeholder="<iframe></iframe>">
                </div>

                <div class="mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <label for="path" class="block text-sm font-medium text-gray-700">Imagen *</label>
                        <switch-input
                            id="show_imagen"
                            :default_value="show_imagen"
                            v-on:turn_on="show_imagen = true"
                            v-on:turn_off="show_imagen = false"/>
                    </div>
                    <div v-if="show_imagen">
                        <span class="text-xs text-neutral-400">Resolucion sugerida 1,304 x 1,116</span>
                        <input type="file" id="path" @change="handleImageUpload" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                    </div>
                </div>

                <div class="flex justify-end space-x-2">
                    <button @click="emit_event('close_modal')" type="button" class="px-4 py-2 bg-gray-300 duration-300 hover:bg-gray-400 text-black rounded-md cursor-pointer">Cancelar</button>
                    <button @click="edit_capacitacion" class="px-4 py-2 bg-theme-400 text-white rounded-md duration-300 hover:bg-theme-600 cursor-pointer">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: [
      'capacitacion_edit',
    ],
    data() {
        return {
            orden: '',
            titulo: '',
            descripcion: '',
            youtube_iframe: '',
            path: '',

            show_youtube_iframe: false,
            show_imagen: false,
        };
    },
    methods: {
        handleImageUpload(event) {
            if (event.target.files[0]) {
                this.path = event.target.files[0]; 
            }
        },
        edit_capacitacion() {
            const data = {
                'capacitacion_id': this.capacitacion_edit.id,
                'orden': this.orden,
                'titulo': this.titulo,
                'descripcion': this.descripcion,
            }

            if(this.youtube_iframe) data.youtube_iframe = this.youtube_iframe;
            if(this.path) data.path = this.path;
            
            this.emit_event('edit_capacitacion', data);
        },
    },
    created(){
        this.titulo = this.capacitacion_edit.titulo;
        this.orden = this.capacitacion_edit.orden;
        this.descripcion = this.capacitacion_edit.descripcion;
        this.youtube_iframe = this.capacitacion_edit.youtube_iframe;
        if(this.capacitacion_edit.youtube_iframe) this.show_youtube_iframe = true;
    },
    watch:{
        show_youtube_iframe(value){
            if(value){
                this.show_imagen = false;
                this.path = '';
            }
        },
        show_imagen(value){
            if(value){
                this.show_youtube_iframe = false;
                this.youtube_iframe = '';
            }
        }
    },
};
</script>
