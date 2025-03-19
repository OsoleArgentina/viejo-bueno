<template>
    <div v-if="render_productos" class="w-full px-20 mt-10 flex sm:flex-row flex-col">
      <!-- Sidebar -->
      <div class="w-full sm:w-1/4 bg-white p-4">
        <ul class="list-none p-0 m-0 border-t border-neutral-200">
          <li v-for="categoria in categorias" :key="categoria.id">
            <!-- Categoría principal -->
            <!-- <div 
              :class="{'font-bold': categoria.id == id}" 
              @click="toggle_subcategorias(categoria.id)"
              class="cursor-pointer text-black py-2 px-4 hover:bg-gray-200 border-b border-neutral-200"
            >
              {{ categoria.nombre }}
            </div> -->
            <div 
              :class="{'font-bold': categoria.id == id}" 
              @click="select_categoria(categoria)"
              class="cursor-pointer text-black py-2 px-4 hover:bg-gray-200 border-b border-neutral-200"
            >
              {{ categoria.nombre }}
            </div>
            
            <!-- Subcategorías -->
            <!-- <ul v-if="categoria.id === id && categoria.subcategorias.length > 0" class="pl-6 border-b border-neutral-200">
              <li v-for="subcategoria in categoria.subcategorias" :key="subcategoria.id" class="py-1">
                <div @click="select_subcategoria(subcategoria)" :class="{'font-semibold': subcategoria.id == subcategoria_id}"  class="text-black px-4 hover:bg-gray-100 cursor-pointer">
                  {{ subcategoria.nombre }}
                </div>
              </li>
            </ul> -->
            
          </li>
        </ul>
      </div>
  
      <!-- Contenido principal -->
        <div  class="w-full sm:w-3/4 sm:ml-10 ">
            <div v-if="marcas" class="grid grid-cols-1 sm:grid-cols-4">
                <div v-for="(marca, index) in marcas" :key="index">
                    <div class="">
                        <img v-if="marca.path" :src="`/img/${marca.path}`" alt="marca Image" class="max-w-full max-h-32 object-contain border border-neutral-200 p-10">
                    </div>
                </div>
            </div>
            <!-- <div v-if="productos && !producto_seleccionado" class="grid grid-cols-1 sm:grid-cols-3 gap-10">
                <div v-for="producto in productos" class="cursor-pointer" @click="select_producto(producto)">
                    <div class="border border-neutral-200 p-2 rounded-lg mb-1">
                        <img :src="`/img/${producto.imagenes[0].path}`" class="w-full h-52 object-cover"  alt="producto imagen">
                    </div>
                    <div>
                        <div class="flex justify-between items-center text-theme-400 font-semibold text-md mb-2">
                            <span>{{ producto.marca.nombre }}</span>
                            <span>${{ this.format_price(producto.precio) }}</span>
                        </div>
                        <div>
                            <h2 class="text-lg">{{ producto.nombre }}</h2>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- <div v-if="producto_seleccionado" class="mb-10"> -->
                <!-- <div class="flex flex-col sm:flex-row gap-10 mb-2">
                    <div class="w-full sm:w-96 max-h-72 border border-neutral-200 p-2 rounded-lg">
                        <img
                            :src="`/img/${producto_seleccionado.imagenes[index_imagen].path}`"
                            class="w-full h-full object-contain"
                            alt="Imagen del producto"
                        />
                    </div>
        
                    <div class="flex flex-col justify-between">
                        <div class="flex flex-col items-start text-md mb-2">
                            <div class="w-12 border-t-2 bg-neutral-800 mb-4"></div>
                            <span class="text-theme-400 font-semibold">
                            {{ producto_seleccionado.marca.nombre }}
                            </span>
                            <h2 class="text-2xl">{{ producto_seleccionado.nombre }}</h2>
                            <span class="text-lg text-theme-400 font-semibold">
                            ${{ format_price(producto_seleccionado.precio) }}
                            </span>
                        </div>
                        <div class="flex gap-10">
                            <a :href="`fichas/${producto_seleccionado.ficha_tecnica}`" download v-if="producto_seleccionado.ficha_tecnica" class="w-1/2 text-center border border-theme-600 text-theme-400 px-4 py-2 rounded-4xl bg-white duration-300 hover:text-white hover:bg-theme-400 cursor-pointer">
                                Ficha tecnica
                            </a>
                            <button @click="add_to_cart(producto_seleccionado)" :class="{'w-full': !producto_seleccionado.ficha_tecnica}" class="w-1/2 flex justify-center gap-2 items-center border border-theme-600 text-theme-400 px-4 py-2 rounded-4xl bg-site-theme duration-300 hover:text-white hover:bg-theme-100 cursor-pointer">
                                <img :src="'img/carrito.svg'" class="object-contain" alt="carrito">
                                <span>Comprar</span>
                            </button>
                        </div>
                    </div>
                </div> -->
                <!-- Miniaturas -->
                <!-- <div class="flex gap-4 mb-20">
                    <div
                    v-for="(imagen, index) in producto_seleccionado.imagenes"
                    :key="imagen.id"
                    :class="{'border-theme-400': imagen.id == imagen_seleccionada_id}"
                    class="w-20 h-20 border border-neutral-200 p-1 rounded-lg hover:border-theme-400 duration-300 cursor-pointer"
                    @click="seleccionar_imagen(index, imagen.id)"
                    >
                    <img
                        :src="`/img/${imagen.path}`"
                        class="w-full h-full object-cover"
                        alt="Miniatura de imagen"
                    />
                    </div>
                </div>   -->

                <!-- Productos relacionados -->
                <!-- <div class="">
                    <div class="w-12 border-t-2 bg-neutral-800 mb-4"></div>
                    <h2 class="text-2xl font-semibold mb-2">Productos relacionados</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-10">
                        <div v-for="producto in productos_relacionados" class="cursor-pointer" @click="select_producto(producto)">
                            <div class="border border-neutral-200 p-2 rounded-lg mb-1">
                                <img :src="`/img/${producto.imagenes[0].path}`" class="w-full h-52 object-cover"  alt="producto imagen">
                            </div>
                            <div>
                                <div class="flex justify-between items-center text-theme-400 font-semibold text-md mb-2">
                                    <span>{{ producto.marca.nombre }}</span>
                                    <span>${{ this.format_price(producto.precio) }}</span>
                                </div>
                                <div>
                                    <h2 class="text-lg">{{ producto.nombre }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            <!-- </div> -->
        </div>
    </div>
</template>
  
<script>
import { mapGetters, mapActions } from "vuex";

  export default {
        data() {
        return {
            render_productos: false,
            id: null, 
            // subcategoria_id: null,
            // productos: [],
            marcas: [],
            // producto_seleccionado: null,
            // index_imagen: 0,
            // imagen_seleccionada_id: null,
        };
        },
        created() {
            // this.id = this.$route.params.producto_id;
            this.id = this.$route.params.producto_id;
            let categoria = this.categorias.find(categoria => categoria.id == this.id);
            // this.productos = categoria?.subcategorias[0]?.productos;
            this.marcas = categoria?.marcas;
            this.render_productos = true;
        },
        computed: {
            ...mapGetters([
                'categorias',
                'productos_relacionados'
            ]),
        },
        methods: {
            ...mapActions([
                'get_productos_relacionados',
            ]),
            toggle_subcategorias(categoriaId) {
                if (this.id === categoriaId) {
                this.id = null;
                } else {
                this.id = categoriaId; 
                }
            },
            select_categoria(categoria){
                this.id = categoria.id;
                this.marcas = categoria.marcas;
            },
            select_subcategoria(subcategoria){
                this.producto_seleccionado = null;
                this.productos = subcategoria.productos;
                this.subcategoria_id = subcategoria.id;
            },
            async select_producto(producto){
                await this.get_productos_relacionados(producto.id);
                this.producto_seleccionado = producto;
                this.imagen_seleccionada_id = producto.imagenes[0].id;
            },
            seleccionar_imagen(index, id) {
                this.index_imagen = index;
                this.imagen_seleccionada_id = id;
            },
            add_to_cart(producto) {
                let carrito = JSON.parse(localStorage.getItem('carrito')) || []; 

                const productoExistente = carrito.find(item => item.id === producto.id);

                if (productoExistente) {
                    productoExistente.cantidad++;
                    productoExistente.subtotal = productoExistente.cantidad * productoExistente.precio;
                } else {
                    carrito.push({ ...producto, cantidad: 1, subtotal: producto.precio });
                }

                localStorage.setItem('carrito', JSON.stringify(carrito));
                
                this.toast_notification({ message: 'Producto agregado al carrito correctamente.' })
            },
        },
    };
</script>
  
  