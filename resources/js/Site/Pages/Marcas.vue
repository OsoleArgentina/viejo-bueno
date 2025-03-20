<template>
    <div class="w-full container mx-auto px-2 sm:px-0 mt-20">
        <div class="mb-10">
            <div class="w-12 border-t-2 bg-neutral-800 mb-4"></div>
            <h2 class="text-3xl font-semibold">Nuestras marcas</h2>
        </div>
        <div class="w-full flex flex-wrap gap-16 justify-between">
            <div v-for="(marca, index) in marcasUnicas" :key="index">
                <img v-if="marca.path" :src="`/img/${marca.path}`" alt="marca Image" class="max-w-full max-h-16 object-contain">
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import { useHead } from '@vueuse/head'

export default {
    data() {
        return {};
    },
    async created() {
        useHead({
            meta: [
                { name: 'description', content: this.metadatos[2].descripcion },
                { name: 'keywords', content: this.metadatos[2].keyword },
            ],
        })
        await this.get_marcas();
    },
    methods: {
        ...mapActions([
            'get_marcas',
        ]),
    },
    computed: {
        ...mapGetters([
            'marcas',
            'metadatos',
        ]),
        marcasUnicas() {
            // Filtrar marcas únicas por nombre
            return this.marcas.filter((value, index, self) => 
                index === self.findIndex((t) => (
                    t.nombre === value.nombre // Cambia 'name' por el campo que identifique a las marcas
                ))
            );
        }
    },
};
</script>
