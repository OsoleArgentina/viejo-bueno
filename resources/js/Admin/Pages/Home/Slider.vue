<template>
    <div class="w-full border-b border-neutral-200">
        <h1 class="text-4xl font-semibold text-neutral-800 mb-4">SLIDER</h1>
    </div>

    <div class="mb-4">
        <button @click="slider_modal = true" class="px-6 py-2 mt-5 bg-theme-400 text-white rounded-md hover:bg-theme-500 duration-300 focus:outline-none focus:ring-2 cursor-pointer">
            Cargar Slider
        </button>
    </div>

    <create_slider v-if="slider_modal" :closeModal="slider_modal = !slider_modal" :cargar_slider="cargar_slider" />
    <!-- Modal -->
    <!-- <div v-if="slider_modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h2 class="text-2xl font-semibold mb-4">Crear Slider</h2>

            <div>
                <div class="mb-4">
                    <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" id="titulo" v-model="titulo" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Título">
                </div>
                <div class="mb-4">
                    <label for="subtitulo" class="block text-sm font-medium text-gray-700">Subtítulo</label>
                    <input type="text" id="subtitulo" v-model="subtitulo" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Subtítulo">
                </div>
                <div class="mb-4">
                    <label for="orden" class="block text-sm font-medium text-gray-700">Orden</label>
                    <input type="text" id="orden" v-model="orden" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Orden">
                </div>
                <div class="mb-4">
                    <label for="path" class="block text-sm font-medium text-gray-700">Imagen</label>
                    <input type="file" id="path" @change="handleImageUpload" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                </div>

                <div class="flex justify-end space-x-2">
                    <button @click="slider_modal = false" type="button" class="px-4 py-2 bg-gray-300 duration-300 hover:bg-gray-400 text-black rounded-md cursor-pointer">Cancelar</button>
                    <button @click="cargar_slider" class="px-4 py-2 bg-theme-400 text-white rounded-md duration-300 hover:bg-theme-600 cursor-pointer">Guardar</button>
                </div>
            </div>
        </div>
    </div> -->
</template>

<script>
import API_ADMIN from '@admin/API';
import { mapGetters, mapActions } from "vuex";
import CreateSlider from './CreateSlider.vue';
export default {
    components:{
        'create_slider': CreateSlider
    },
    data() {
        return {
            slider_modal: false, 
            titulo: '',
            subtitulo: '',
            path: '',
            orden: ''
        };
    },
    methods: {
        ...mapActions([
            'get_sliders',
        ]),
        handleImageUpload(event) {
            if (event.target.files[0]) {
                this.path = event.target.files[0]; 
                console.log(this.path);
            }
        },
        cargar_slider() {
            const method = 'POST';
            const headers = {
                'Content-Type': 'multipart/form-data',
            };
            const data = {
                'titulo': this.titulo,
                'subtitulo': this.subtitulo,
                'path': this.path,
                'orden': this.orden,
            }

            const response = this.send_http_request(API_ADMIN.set_slider, method, headers, {}, data);

            if(!response){
                console.error('Error', response);

            }else{
                this.slider_modal = false;
                this.slider = {
                    titulo: '',
                    subtitulo: '',
                    path: '',
                    orden: ''
                };
            }
        }
    },
    async created(){
        await  this.get_sliders();
        console.log(this.sliders);
    },
    computed:{
        ...mapGetters([
            'sliders',
        ])
    }
};
</script>

<style scoped>

.bg-opacity-50 {
    background-color: rgba(0, 0, 0, 0.5);
}

</style>
