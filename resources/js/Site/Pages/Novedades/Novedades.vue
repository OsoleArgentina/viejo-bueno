<template>
    <router-view></router-view>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import { useHead } from '@vueuse/head'

export default {

    data(){
        return{
        }
    },
    async created() {
        useHead({
            meta: [
                { name: 'description', content: this.metadatos[3].descripcion },
                { name: 'keywords', content: this.metadatos[3].keyword },
            ],
        })
        await this.get_novedades();
    },

    methods: {
        ...mapActions([
            'get_novedades',
        ])
    },
    computed: {
        ...mapGetters([
            'metadatos',
        ]),
    },
}

</script>
