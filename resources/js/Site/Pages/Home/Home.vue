<template>
    <h1 class="text-red-400">seccion Home</h1>
    <nav class="flex flex-col space-y-1">
        <router-link  :to="{ name: 'nosotros' }"
            id="btn_nosotros"
            class="flex items-center px-5 py-2.5 rounded-full hover:bg-white hover:text-theme-500 transition-all duration-300">
            <!-- <span class="w-5 h-5">
                <i class="fa-solid fa-gauge"></i>
            </span> -->

            <span class="mx-4 font-medium inline-block">NOSOTROS</span>
        </router-link>
    </nav>
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
     