<template>
    <div class="w-full container mx-auto px-2 sm:px-0 mt-20">
        <div class="w-full mt-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
                <div v-for="(categoria, index) in categorias" :key="index" class="relative flex justify-center cursor-pointer hover:shadow-xl duration-300" @click="go_to_producto(categoria.id)">
                    <div class="absolute inset-0 bg-black opacity-20 rounded-md"></div>
                    <img :src="`/img/${categoria.path}`" alt="categoria Image" class="w-full h-96 object-cover rounded-md" />
                    
                    <div class="absolute bottom-20 left-1/2 transform -translate-x-1/2 text-white text-2xl flex text-center font-bold z-10">
                        <p class="w-full">{{ categoria.nombre }}</p>
                    </div>
                    
                    <div class="absolute inset-0 flex items-center justify-center z-10">
                        <img v-if="categoria.icono" :src="`/img/${categoria.icono}`" alt="Icono" class="w-20 h-20 object-contain" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

    export default{
        data() {
            return {
                render_app: false
            }
        },
        methods:{
            go_to_producto(producto_id){
                this.go_to_route(
                    'producto',
                    { 'producto_id': producto_id }
                )
            }
        },
        computed: {
            ...mapGetters([
                'categorias',
                // 'marcas',
            ]),
        },
    }
</script>