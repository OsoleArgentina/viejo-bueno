<template>
    <div class="w-full px-20 mt-20">
        <div class="mb-10">
            <div class="w-12 border-t-2 bg-neutral-800 mb-4"></div>
            <h2 class="text-3xl font-semibold">Novedades</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 mb-10">
            <div v-for="(novedad, index) in novedades" 
            :key="index" @click="go_to_novedad(novedad.id)" class="flex flex-col justify-center cursor-pointer hover:shadow-sm">
                <div class="mb-2">
                    <img :src="`/img/${novedad.path}`" alt="novedad Image" class="w-full h-96 object-cover rounded-lg" />
                </div>
                <div class="w-full flex flex-col gap-y-2">
                    <span class="text-theme-400 font-semibold text-lg">{{ novedad.titulo }}</span>
                    <h2 class="font-semibold">{{ novedad.subtitulo }}</h2>
                    <div class="text-sm" v-html="novedad.descripcion_corta"></div>
                    <div class="w-full flex justify-between text-neutral-500">
                        <span>Leer más</span>
                        <span class="text-neutral-400"><i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

    export default{
        data() {
            return {
            }
        },
        methods:{
            go_to_novedad(novedad_id){
                this.go_to_route(
                    'novedad',
                    { 'novedad_id': novedad_id }
                )
            },
            isVideo(path) {
                const videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'webm'];
                const fileExtension = path.split('.').pop().toLowerCase();
                return videoExtensions.includes(fileExtension);
            },
        },
        computed: {
            ...mapGetters([
                'novedades',
            ]),
        },
    }
</script>