
<template>
    <div class="w-full px-20 mt-40">
        <div class="mb-10">
            <div class="w-12 border-t-2 bg-neutral-800 mb-4"></div>
            <h2 class="text-3xl font-semibold">Nuestras marcas</h2>
        </div>
        <div class="w-full flex flex-wrap  gap-16 justify-between">
            <div v-for="(marca, index) in marcas" :key="index">
                <img v-if="marca.path" :src="`/img/${marca.path}`" alt="marca Image" class="max-w-full max-h-16 object-contain">
            </div>
        </div>
    </div>

</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    data() {
        return {
         
        };
    },
    async created() {
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
            // 'nosotros_elegirnos',
        ]),
    },
};
</script>
     