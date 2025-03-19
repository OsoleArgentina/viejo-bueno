<template>
    <div v-if="render_novedad" class="w-full px-20 mt-20">
        <div class="flex gap-16">
            <div class="w-1/2">
                <img :src="`/img/${novedad.path}`" alt="novedad Image" class="w-full h-[700px] object-cover rounded-lg" />
            </div>
            <div class="w-1/2">
                <div class="text-xl text-neutral-800" v-html="novedad.descripcion_larga"></div>
            </div>
        </div>

    </div>
</template>
  
<script>
import { mapGetters, mapActions } from "vuex";

  export default {
        data() {
        return {
            render_novedad: false,
            id: null, 
            novedad: null,
        };
        },
        created() {
            this.id = this.$route.params.novedad_id;
            this.novedad = this.novedades.find(novedad => novedad.id == this.id);
            console.log(this.novedad);
            this.render_novedad = true;
        },
        computed: {
            ...mapGetters([
                'novedades',
            ]),
        },
        methods: {
            ...mapActions([
            ]),
        },
    };
</script>
  
  