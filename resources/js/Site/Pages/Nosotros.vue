
<template>
    <div class="relative w-full h-96 sm:h-[400px] overflow-hidden">
        <div class="relative w-full h-full">
            <div 
                class="absolute inset-0 w-full h-full flex items-center justify-center">
                <div class="relative w-full h-full">
                    <img v-if="nosotros?.banner_principal" :src="`/img/${nosotros?.banner_principal}`" alt="nosotros Image" class="w-full object-contain" />
                </div>
            </div>
        </div>
    </div>

    <div class="w-full px-20 my-10">
        <div class="mb-4">
            <div class="w-12 border-t-2 bg-neutral-800 mb-4"></div>
            <h2 class="text-3xl font-semibold">{{ nosotros?.titulo }}</h2>
        </div>
        <div class="hidden sm:flex">
            <div class="w-1/2 pr-4">
                <div v-html="firstHalf" class=""></div>
            </div>
            
            <div class="w-1/2 pl-4">
                <div v-html="secondHalf" class=""></div>
            </div>
        </div>
        <div v-html="nosotros?.descripcion" class="block sm:hidden"></div>
    </div>

    <div class="relative w-full h-[600px] overflow-hidden mb-10">
        <div class="relative w-full h-full">
            <div 
                class="absolute inset-0 w-full h-full flex items-center justify-center">
                <div class="relative w-full h-full">
                    <video 
                            :ref="`video-${nosotros?.banner_secundario}`" 
                            :src="`/img/${nosotros?.banner_secundario}`" 
                            autoplay muted loop 
                            class="w-full h-full object-cover"
                        >
                            Tu navegador no soporta el video.
                        </video>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full px-2 sm:px-20 mb-10">
        <div class="mb-10">
            <div class="w-12 border-t-2 bg-neutral-800 mb-4"></div>
            <h2 class="text-4xl font-semibold">¿Por qué elegirnos?</h2>
        </div>
        <div  class="grid grid-cols-1 sm:grid-cols-4">
            <div v-for="elg in nosotros_elegirnos" class="flex flex-col justify-center items-center gap-10">
                <img v-if="elg.path" :src="`/img/${elg.path}`" alt="Slider Image" class="w-20 h-20 object-contain">
                <p class="text-center">{{ elg.descripcion }}</p>
            </div>
            
        </div>
    </div>

</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
    data() {
        return {
            firstHalf: '',
            secondHalf: ''
        };
    },
    async created() {
        await this.get_nosotros();
        await this.get_nosotros_elegirnos();
        this.splitDescription();
    },
    methods: {
        ...mapActions([
            'get_nosotros',
            'get_nosotros_elegirnos',
        ]),
        splitDescription() {
            const desc = this.nosotros?.descripcion;
            const mid = Math.floor(desc?.length / 2);

            this.firstHalf = desc?.slice(0, mid);
            this.secondHalf = desc?.slice(mid);
        }
    },
    computed: {
        ...mapGetters([
            'nosotros',
            'nosotros_elegirnos',
        ]),
    },
};
</script>
     