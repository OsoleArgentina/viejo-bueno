<template>
    <h1 class="text-red-400">seccion Home</h1>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
 
export default {
    async created() {
        await this.load_data();
        console.log(this.data);
    },
    methods:{
        ...mapActions([
            'load_data',
        ]),
    },
    computed:{
        ...mapGetters([
            'data',
        ])
    }
};
 </script>
     