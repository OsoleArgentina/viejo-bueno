<template>
    <div class="w-full px-20 mt-40">
        <div class="mb-10">
            <div class="w-12 border-t-2 bg-neutral-800 mb-4"></div>
            <h2 class="text-3xl font-semibold">Capacitaciones</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 mb-10">
            <div v-for="(capacitacion, index) in capacitaciones" 
            :key="index" class="flex flex-col justify-center">
                <div class="mb-2">
                    <template v-if="isVideo(capacitacion.path)">
                            <video :src="`/img/${capacitacion.path}`" muted controls class="w-full h-96 object-cover rounded-md
                        ">
                            Tu navegador no soporta el video.
                        </video>
                    </template>
                    <template v-else>
                        <img v-if="capacitacion.path" :src="`/img/${capacitacion.path}`" alt="capacitacion Image" class="w-full h-96 object-cover rounded-md">
                    </template>
                </div>
                <div class="w-full flex flex-col gap-y-2">
                    <span class="font-semibold text-xl">{{ capacitacion.titulo }}</span>
                    <div v-html="capacitacion.descripcion" class="text-lg"></div>
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
            ...mapActions([
                'get_capacitaciones',
            ]),
            isVideo(path) {
                const videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'webm'];
                const fileExtension = path.split('.').pop().toLowerCase();
                return videoExtensions.includes(fileExtension);
            },
        },
        computed: {
            ...mapGetters([
                'capacitaciones',
            ]),
        },
        async created(){
            await this.get_capacitaciones();
        }
    }
</script>