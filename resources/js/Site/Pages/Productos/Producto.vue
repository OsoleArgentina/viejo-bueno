<template>
    <div v-if="render_productos" class="w-full px-20 mt-10 flex">
      <!-- Sidebar -->
      <div class="w-1/4 bg-white p-4">
        <ul class="list-none p-0 m-0 border-t border-neutral-200">
          <li v-for="categoria in categorias" :key="categoria.id">
            <!-- Categoría principal -->
            <div 
              :class="{'font-bold': categoria.id == id}" 
              @click="toggle_subcategorias(categoria.id)"
              class="cursor-pointer text-black py-2 px-4 hover:bg-gray-200"
            >
              {{ categoria.nombre }}
            </div>
            
            <!-- Subcategorías -->
            <ul v-if="categoria.id === id && categoria.subcategorias.length > 0" class="pl-6 border-b border-neutral-200">
              <li v-for="subcategoria in categoria.subcategorias" :key="subcategoria.id" class="py-1">
                <div @click="select_subcategoria(subcategoria)" :class="{'font-bold': subcategoria.id == subcategoria_id}" class="text-black px-4 hover:bg-gray-100 cursor-pointer">
                  {{ subcategoria.nombre }}
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
  
      <!-- Contenido principal -->
      <div  class="w-3/4 ml-10 ">
        <div v-if="productos && !producto_seleccionado" class="grid grid-cols-1 sm:grid-cols-3">
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
        </div>

        <div v-if="producto_seleccionado" class="">
            <div class="flex gap-10 mb-2">
                <!-- Imagen Principal -->
                <div class="w-96 max-h-72 border border-neutral-200 p-2 rounded-lg">
                    <img
                        :src="`/img/${producto_seleccionado.imagenes[index_imagen].path}`"
                        class="w-full h-full object-contain"
                        alt="Imagen del producto"
                    />
                </div>
    
                <!-- Información del Producto -->
                <div>
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
                    <div>
                        
                    </div>
                </div>
            </div>
            <!-- Miniaturas -->
            <div class="flex gap-4">
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
            </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { mapGetters } from "vuex";
  
  export default {
        data() {
        return {
            render_productos: false,
            id: null, 
            subcategoria_id: null,
            productos: [],
            producto_seleccionado: null,
            index_imagen: 0,
            imagen_seleccionada_id: null,
        };
        },
        created() {
        this.id = this.$route.params.producto_id;
        let categoria = this.categorias.find(categoria => categoria.id == this.id);
        console.log(categoria);
        this.render_productos = true;
        },
        computed: {
        ...mapGetters([
            'categorias',
        ]),
        },
        methods: {
            toggle_subcategorias(categoriaId) {
                if (this.id === categoriaId) {
                this.id = null;
                } else {
                this.id = categoriaId; 
                }
            },
            select_subcategoria(subcategoria){
                this.producto_seleccionado = null;
                this.productos = subcategoria.productos;
            },
            select_producto(producto){
                this.producto_seleccionado = producto;
                this.imagen_seleccionada_id = producto.imagenes[0].id;
            },
            seleccionar_imagen(index, id) {
                this.index_imagen = index;
                this.imagen_seleccionada_id = id;
            },
        },
    };
</script>
  
  