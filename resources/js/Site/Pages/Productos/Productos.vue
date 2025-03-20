<template>
    <div class="w-full container mx-auto px-2 sm:px-0 mt-20">
        <!-- FILTROS -->
        <div class="w-full px-2 sm:px-0 mt-10">
            <div class="w-full mt-10">
                <div class="flex sm:flex-row flex-col justify-between items-center gap-10">
                    <select v-model="categoria_seleccionada" class="px-4 py-2 border rounded-full w-full sm:w-1/4">
                        <option disabled value="">Seleccione una categoría</option>
                        <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">{{ categoria.nombre }}</option>
                    </select>

                    <select v-model="marca_seleccionada" class="px-4 py-2 border rounded-full w-full sm:w-1/4">
                        <option disabled value="">Seleccione una marca</option>
                        <option v-for="marca in marcas" :key="marca.id" :value="marca.id">{{ marca.nombre }}</option>
                    </select>

                    <!-- <input v-model="producto_input" type="text" placeholder="Producto" class="px-4 py-2 border rounded-full w-1/4" /> -->

                    <button class="w-full sm:w-1/4 border border-theme-600 text-theme-400 px-4 py-2 rounded-4xl bg-site-theme duration-300 hover:text-white hover:bg-theme-400 cursor-pointer">
                        Buscar
                    </button>
                </div>
            </div>
        </div>

        <div v-if="productos_filtrados.length > 0 && filtrado_modal" class="w-full ">
            <span @click="cerrar_filtrado" class="w-full flex justify-end p-4 text-xl hover:text-theme-400 duration-300 cursor-pointer">
                <i class="fa-solid fa-xmark"></i>
            </span>
            <div class="bg-white shadow-xl rounded-lg p-6  max-h-[80vh] overflow-auto">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div v-for="(producto, index) in productos_filtrados" :key="index" class="flex p-2 mb-2">
                        <div class="">
                            <img :src="`/img/${producto.path}`" alt="producto Image" class="w-full sm:w-40 h-40 object-contain" />
                        </div>
                        <!-- <div class="">
                            <div class="w-full flex justify-between items-center text-theme-400 font-semibold text-lg mb-2">
                                <span>{{ producto.marca.nombre }}</span>
                                <span>${{ this.format_price(producto.precio) }}</span>
                            </div>
                            <div>
                                <h2 class="text-lg">{{ producto.nombre }}</h2>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <router-view></router-view>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import { useHead } from '@vueuse/head'

export default {

    data(){
        return{
            categoria_seleccionada: '',
            marca_seleccionada: '',
            filtrado_modal: false,
        }
    },
    async created() {
        useHead({
            meta: [
                { name: 'description', content: this.metadatos[6].descripcion },
                { name: 'keywords', content: this.metadatos[6].keyword },
            ],
        })
        await this.get_categorias();
        await this.get_marcas();
    },

    methods: {
        ...mapActions([
            'get_categorias',
            'get_marcas',
        ]),
        cerrar_filtrado(){
            this.filtrado_modal = !this.filtrado_modal;
            this.categoria_seleccionada = '';
            this.marca_seleccionada = '';
        }
    },
    computed: {
        ...mapGetters([
            'categorias',
            'marcas',
            'metadatos',
        ]),
        productos_filtrados(){
            let productosFiltrados = this.marcas;
            // Filtrar por categoría
            if (this.categoria_seleccionada) {
                this.filtrado_modal = true;

                productosFiltrados = productosFiltrados.filter(producto =>
                    producto.categoria_id === this.categoria_seleccionada
                );
            }

            // Filtrar por marca
            if (this.marca_seleccionada) {
                this.filtrado_modal = true;

                productosFiltrados = productosFiltrados.filter(producto =>
                    producto.id === this.marca_seleccionada
                );
            }

            // Filtrar por texto de búsqueda
            // if (this.producto_input) {
            //     this.filtrado_modal = true;

            //     productosFiltrados = productosFiltrados.filter(producto =>
            //     producto.nombre.toLowerCase().includes(this.producto_input.toLowerCase())
            //     );
            // }

            return productosFiltrados;
        },
    },
}

</script>
