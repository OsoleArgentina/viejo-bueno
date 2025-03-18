<template>
    <div class="w-full px-20 mt-40">
        <!-- FILTROS -->
        <div class="flex items-center gap-10">
            <select v-model="categoria_seleccionada" class="px-4 py-2 border rounded-full w-1/4">
                <option disabled value="">Seleccione una categoría</option>
                <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">{{ categoria.nombre }}</option>
            </select>

            <select v-model="marca_seleccionada" class="px-4 py-2 border rounded-full w-1/4">
                <option disabled value="">Seleccione una marca</option>
                <option v-for="marca in marcas" :key="marca.id" :value="marca.id">{{ marca.nombre }}</option>
            </select>

            <input v-model="producto_input" type="text" placeholder="Producto" class="px-4 py-2 border rounded-full w-1/4" />

            <button class="w-1/4 border border-theme-600 text-theme-400 px-4 py-2 rounded-4xl bg-site-theme duration-300 hover:text-white hover:bg-theme-400 cursor-pointer">
                Buscar
            </button>
        </div>
    </div>
    <router-view></router-view>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'

export default {

    data(){
        return{
            categoria_seleccionada: '',
            marca_seleccionada: '',
            producto_input: '',
        }
    },
    async created() {
        await this.get_categorias();
    },

    methods: {
        ...mapActions([
            'get_categorias',
            'get_marcas',
        ])
    },
    computed: {
        ...mapGetters([
            'categorias',
            'marcas',
        ]),
    },
}

</script>
