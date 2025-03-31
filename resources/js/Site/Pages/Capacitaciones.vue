<template>
    <div class="w-full container mx-auto px-2 sm:px-0 mt-20">
        <div class="mb-10">
            <div class="w-12 border-t-2 bg-neutral-800 mb-4"></div>
            <h2 class="text-3xl font-semibold">Capacitaciones</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 mb-10">
            <div v-for="(capacitacion, index) in capacitaciones" 
            :key="index" class="flex flex-col justify-between bg-white rounded-md overflow-hidden">
                <!-- Imagen/Video -->
                <div class="flex-shrink-0 mb-2">
                    <template v-if="isVideo(capacitacion.path)">
                        <video :src="`/img/${capacitacion.path}`" muted controls class="w-full h-96 object-cover rounded-md">
                            Tu navegador no soporta el video.
                        </video>
                    </template>
                    <template v-else>
                        <img v-if="capacitacion.path" :src="`/img/${capacitacion.path}`" alt="capacitacion Image" class="w-full h-96 object-cover rounded-md">
                    </template>
                    <div v-html="capacitacion?.youtube_iframe" v-resizeyoutube></div>
                </div>

                <!-- Texto (Título y Descripción) -->
                <div class="flex-grow py-4 flex flex-col gap-y-2">
                    <span class="font-semibold text-xl">{{ capacitacion.titulo }}</span>
                    <div v-html="capacitacion.descripcion" class="text-lg text-neutral-600 overflow-hidden max-h-40"></div> <!-- max-height para la descripción -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import { useHead } from '@vueuse/head';

const resizeyoutube = {
    mounted: (el) => {
        const iframe = el.querySelector('iframe');
        if (iframe) {
            window.screen.width < 400 ? iframe.style.width = '360px' : iframe.style.width = '480px';
            iframe.style.height = '385px';
            iframe.style.borderRadius = '10px'; 
        }
    }
}

export default {
    directives: {
        resizeyoutube
    },
    methods: {
        ...mapActions(['get_capacitaciones']),
        isVideo(path) {
            const videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'webm'];
            const fileExtension = path?.split('.').pop().toLowerCase();
            return videoExtensions.includes(fileExtension);
        },
    },
    computed: {
        ...mapGetters(['capacitaciones', 'metadatos']),
    },
    async created() {
        useHead({
            meta: [
                { name: 'description', content: this.metadatos[5].descripcion },
                { name: 'keywords', content: this.metadatos[5].keyword },
            ],
        })
        await this.get_capacitaciones();
    },
}
</script>
