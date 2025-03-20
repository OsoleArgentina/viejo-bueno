<template>
    <div class="bg-white flex flex-col min-h-screen">
        <navbar/>
        <div class=" flex-grow mt-20">
            <router-view v-if="render_app" />
        </div>
        
        <footer-site></footer-site>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";

export  default {
    async created() {
        await this.get_metadatos();
        this.render_app = true
    },
    data() {
        return {
            render_app: false
        }
    },
    methods:{
        ...mapActions([
            'get_metadatos',
        ]),
    }
}
</script>
    