
<template>
    <div class="w-full h-[200px] sm:h-[500px] mt-8">
            <img v-if="nosotros?.banner_principal" :src="`/img/${nosotros?.banner_principal}`" alt="nosotros Image" class="w-full h-full object-cover" />
    </div>

    <div class="w-full container mx-auto px-2 sm:px-0 my-10">
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

    <div class="w-full container mx-auto px-2 sm:px-0 mb-10">
    <div class="mb-10">
        <div class="w-12 border-t-2 bg-neutral-800 mb-4"></div>
        <h2 class="text-4xl font-semibold">¿Por qué elegirnos?</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-10">
        <div v-for="elg in nosotros_elegirnos" class="flex flex-col justify-start items-center h-full">
            <img v-if="elg.path" :src="`/img/${elg.path}`" alt="Slider Image" class="w-20 h-20 object-contain">
            <p class="text-center mt-6">{{ elg.descripcion }}</p>
        </div>
    </div>
</div>


</template>

<script>
import { mapGetters, mapActions } from "vuex";
import { useHead } from '@vueuse/head'

export default {
    data() {
        return {
            firstHalf: '',
            secondHalf: ''
        };
    },
    async created() {
        useHead({
            meta: [
                { name: 'description', content: this.metadatos[1].descripcion },
                { name: 'keywords', content: this.metadatos[1].keyword },
            ],
        })
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

            const cutIndex = this.findNaturalCutPoint(desc, mid);
            
            this.firstHalf = desc?.slice(0, cutIndex);
            this.secondHalf = desc?.slice(cutIndex);
        },

        findNaturalCutPoint(text, mid) {
            const delimiters = [' '];
            let cutIndex = mid;
            let found = false;

            while (!found && cutIndex > 0) {
                if (delimiters.includes(text[cutIndex])) {
                    found = true;
                } else {
                    cutIndex--;
                }
            }

            return cutIndex;
        }
    },
    computed: {
        ...mapGetters([
            'nosotros',
            'nosotros_elegirnos',
            'metadatos',
        ]),
    },
};
</script>
     