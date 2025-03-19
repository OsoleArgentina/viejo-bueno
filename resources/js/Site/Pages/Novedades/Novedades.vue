<template>
    <router-view></router-view>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'

export default {

    data(){
        return{
        }
    },
    async created() {
        await this.get_novedades();
    },

    methods: {
        ...mapActions([
            'get_novedades',
        ])
    },
    computed: {
        ...mapGetters([
        ]),
    },
}

</script>
