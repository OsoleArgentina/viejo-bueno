<template>
    <!-- SLIDER -->
    <div class="relative w-full h-[700px] overflow-hidden">
        <div class="relative w-full h-full">
            <div 
                v-for="(slider, index) in sliders" 
                :key="index" 
                v-show="currentSlide === index"
                class="absolute inset-0 w-full h-full flex items-center justify-center"
                >
            
                <div class="relative w-full h-full">
                    <template v-if="isVideo(slider.path)">
                        <video 
                            :ref="`video-${slider.path}`" 
                            :src="`/img/${slider.path}`" 
                            autoplay muted loop 
                            class="w-full h-full object-cover"
                        >
                            Tu navegador no soporta el video.
                        </video>
                    </template>

        
                    <template v-else>
                        <img v-if="slider.path" :src="`/img/${slider.path}`" alt="Slider Image" class="w-full h-full object-cover" />
                    </template>
        
                    <div class="absolute inset-0 bg-black opacity-40"></div>
        
                    <div class="absolute inset-0 flex items-center justify-center text-center text-white px-4 z-10">
                    <div>
                        <h2 class="text-6xl font-bold mb-10">{{ slider.titulo }}</h2>
                        <p class="text-2xl mb-14">{{ slider.subtitulo }}</p>
                        <router-link  :to="{name: 'productos'}">
                            <button class="mt-4 px-6 py-3 text-white border border-white rounded-full hover:text-black hover:bg-neutral-50 duration-300 cursor-pointer">Ver productos</button>
                        </router-link>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Puntos de Navegación -->
        <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex z-20">
            <button 
            v-for="(slider, index) in sliders" 
            :key="index" 
            :class="{'bg-white': currentSlide === index, 'bg-gray-300': currentSlide !== index}"
            @click="goToSlide(index)"
            class="w-3 h-3 mx-2 rounded-full cursor-pointer transition-all"></button>
        </div>
        
    </div>
   
    <!-- MARCAS -->
    <div class="w-full container mx-auto px-2 sm:px-0 mt-10">
        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-6 gap-6">
            <div v-for="(marca, index) in marcasUnicas" 
            :key="index" class="mx-auto border border-gray-200 rounded-full p-5">
                <img :src="`/img/${marca.path}`" alt="marca Image" class="w-40 h-40 object-contain" />
            </div>
        </div>
    </div>

    <!-- FILTROS -->
    <!-- <div class="w-full container mx-auto px-2 sm:px-0 mt-10">
        <div class="w-full mt-10">
            <div class="flex sm:flex-row flex-col justify-between items-center gap-10">
                <select v-model="categoria_seleccionada" class="px-4 py-2 border rounded-full w-full sm:w-1/4">
                    <option disabled value="">Seleccione una categoría</option>
                    <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">{{ categoria.nombre }}</option>
                </select>

                <select v-model="marca_seleccionada" class="px-4 py-2 border rounded-full w-full sm:w-1/4">
                    <option disabled value="">Seleccione una marca</option>
                    <option v-for="marca in marcas" :key="marca.id" :value="marca.id">{{ marca.nombre }}</option>
                </select> -->

                <!-- <input v-model="producto_input" type="text" placeholder="Producto" class="px-4 py-2 border rounded-full w-1/4" /> -->

                <!-- <button class="w-full sm:w-1/4 border border-theme-600 text-theme-400 px-4 py-2 rounded-4xl bg-site-theme duration-300 hover:text-white hover:bg-theme-400 cursor-pointer">
                    Buscar
                </button>
            </div>
        </div>
    </div> -->

    <!-- <div v-if="productos_filtrados.length > 0 && filtrado_modal" class="w-full container mx-auto px-2 sm:px-0">
        <span @click="cerrar_filtrado" class="w-full flex justify-end p-4 text-xl hover:text-theme-400 duration-300 cursor-pointer">
            <i class="fa-solid fa-xmark"></i>
        </span>
        <div class="bg-white shadow-xl rounded-lg p-6  max-h-[80vh] overflow-auto">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div v-for="(producto, index) in productos_filtrados" :key="index" class="flex p-2 mb-2">
                    <div class="">
                        <img :src="`/img/${producto.path}`" alt="producto Image" class="w-40 h-40 object-contain" />
                    </div> -->
                    <!-- <div class="">
                        <div class="w-full flex justify-between items-center text-theme-400 font-semibold text-lg mb-2">
                            <span>{{ producto.marca.nombre }}</span>
                            <span>${{ this.format_price(producto.precio) }}</span>
                        </div>
                        <div>
                            <h2 class="text-lg">{{ producto.nombre }}</h2>
                        </div>
                    </div> -->
                <!-- </div>
            </div>
        </div>
    </div> -->

    <!-- CATEGORIAS -->
    <div class="w-full container mx-auto px-2 sm:px-0 mt-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
            <div v-for="(categoria, index) in categorias_destacadas" :key="index" class="relative flex justify-center cursor-pointer" @click="go_to_producto(categoria.id)">
                <div class="absolute inset-0 bg-black opacity-20 rounded-md"></div>
                <img :src="`/img/${categoria.path}`" alt="categoria Image" class="w-full h-96 object-cover rounded-md" />
                
                <div class="absolute bottom-20 left-1/2 transform -translate-x-1/2 text-white text-2xl font-bold z-10">
                    {{ categoria.nombre }}
                </div>
                
                <div class="absolute inset-0 flex items-center justify-center z-10">
                    <img v-if="categoria.icono" :src="`/img/${categoria.icono}`" alt="Icono" class="w-20 h-20 object-contain" />
                </div>
            </div>
        </div>
    </div>

    <!-- NOSOTROS -->
    <div class="mt-20">
        <div class="relative w-full h-[700px]">
            <img v-if="home_nosotros?.path" :src="`/img/${home_nosotros?.path}`" alt="nosotros Image" class="w-full h-full object-cover" />


            <div class="absolute inset-0 bg-black opacity-40"></div>

            <div class="absolute inset-0 flex items-start sm:items-end justify-center text-white px-4 z-10">
            <div class="flex sm:flex-row flex-col w-full items-center sm:px-20">
                <div class="w-3/4">
                    <div class="w-16 border-t-2 border-white mb-5"></div>
                    <h2 class="text-5xl font-bold mb-10">{{ home_nosotros?.titulo }}</h2>
                    <p v-html="home_nosotros?.descripcion" class="text-xl mb-14"></p>
                </div>
                <div class="w-full sm:w-1/4 h-12 text-center sm:text-end">
                    <button class="w-1/2 py-2 text-theme-400 border border-white rounded-full hover:text-black bg-white duration-300 cursor-pointer">Más info</button>
                </div>
            </div>
            </div>
        </div>
    </div>


    <!-- PRODUCTOS -->
    <!-- <div class="w-full px-20 py-20 bg-site-theme">
         <div class="mb-5">
             <div class="border-t-3 w-12 mb-5"></div>
             <h1 class="font-semibold text-4xl">Productos destacados</h1>
         </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10">
            <div v-for="(producto, index) in productos_destacadas" 
            :key="index" class="flex flex-col  justify-center">
                <div class="bg-white rounded-lg hover:bg-neutral-200 duration-300 cursor-pointer hover:border hover:border-neutral-400 mb-2">
                    <img :src="`/img/${producto.imagenes[0].path}`" alt="producto Image" class="w-full h-96 object-contain" />
                </div>
                <div class="h-20">
                    <div class="flex justify-between items-center text-theme-400 font-semibold text-lg mb-2">
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

    <!-- NOVEDADES -->
    <div class="w-full container mx-auto px-2 sm:px-0 py-20">
         <div class="mb-5">
             <div class="border-t-3 w-12 mb-5"></div>
             <h1 class="font-semibold text-4xl">Novedades</h1>
         </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
            <div v-for="(novedad, index) in novedades" 
            :key="index" class="flex flex-col justify-center cursor-pointer hover:shadow-xs">
                <div class="mb-2">
                    <img :src="`/img/${novedad.path}`" alt="novedad Image" class="w-full h-96 object-cover rounded-lg" />
                </div>
                <div class="w-full flex flex-col gap-y-1">
                    <span class="text-theme-400 font-semibold text-lg">{{ novedad.titulo }}</span>
                    <h2 class="font-semibold">{{ novedad.subtitulo }}</h2>
                    <div class="text-sm" v-html="novedad.descripcion_corta"></div>
                    <div class="w-full flex justify-between text-neutral-500">
                        <span>Leer más</span>
                        <span class="text-neutral-400"><i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de presupuesto -->
    <div v-if="show_modal" class="fixed inset-0  bg-black bg-opacity-50 flex items-center justify-center z-50 modal-animation">
 
      <div class="shadow-xl rounded-lg w-3/4 md:w-2/3 lg:w-1/2 max-h-[80vh] overflow-auto bg-site-theme">
        <span @click="show_modal = !show_modal" class="w-full flex justify-end p-4 text-xl hover:text-theme-400 duration-300 cursor-pointer">
            <i class="fa-solid fa-xmark"></i>
        </span>
        <div class="px-20 py-10">
            
            <div class="mb-5">
              <h1 class="font-semibold text-5xl text-center">¡Pedí tu presupuesto por WhatsApp!</h1>
            </div>
            <div class="w-3/4 mx-auto flex flex-col justify-center items-center">
                <p class="text-md mb-5 text-center">Escribinos ahora y recibí tu cotización al instante.
                    Nuestro equipo está listo para asesorarte. 
                </p>
                <p class="text-md text-center mb-10">
                    Hacé clic en el botón y chateá directamente con nosotros.
                </p>
                <button  class="py-2 px-6 bg-theme-400 text-white rounded-full flex gap-2">
                    <img :src="`/img/wpp.svg`" alt="">
                    <span>Solicitar presupuesto</span>
                </button>
            </div>
        </div>
      </div>
    </div>

</template>
  
  

<script>
import { mapGetters, mapActions } from "vuex";
import { useHead } from '@vueuse/head'

export default {
  data() {
    return {
        currentSlide: 0,
        sliderInterval: null,
        duration_video: 5000,
        categoria_seleccionada: '',
        marca_seleccionada: '',
        producto_input: '',
        filtrado_modal: false,
        show_modal: false,
    };
  },
  async created() {
    useHead({
      meta: [
        { name: 'description', content: this.metadatos[0].descripcion },
        { name: 'keywords', content: this.metadatos[0].keyword },
      ],
    })
    
    const modalShown = localStorage.getItem("modalShown");
    if (!modalShown) {
      this.show_modal = true;
    }
    
    localStorage.setItem("modalShown", "false");  

    await this.get_sliders();
    await this.get_marcas_destacadas();
    await this.get_categorias_destacadas();
    await this.get_home_nosotros();
    await this.get_productos_destacadas();
    await this.get_novedades();
    await this.get_categorias();
    await this.get_marcas();
    await this.get_productos();
    const videoRefName = `video-${this.sliders[0]?.path}`;
    const videoElement = this.$refs[videoRefName];
    if(videoElement){
        this.duration_video = videoElement[0]?.duration * 1000 ?? 5000;
    }
    this.startSlider();
  },
  destroyed() {
    clearInterval(this.sliderInterval);
  },
  methods: {
    ...mapActions([
        'get_sliders',
        'get_categorias_destacadas',
        'get_marcas_destacadas',
        'get_home_nosotros',
        'get_productos_destacadas',
        'get_novedades',
        'get_categorias',
        'get_marcas',
        'get_productos',
    ]),
    isVideo(path) {
        const videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'webm'];
        const fileExtension = path.split('.').pop().toLowerCase();
        return videoExtensions.includes(fileExtension);
    },
    startSlider() {
        this.sliderInterval = setInterval(() => {
            this.nextSlide();
        }, this.duration_video); 
    },
    
    nextSlide() {
        clearInterval(this.sliderInterval);

        this.currentSlide = (this.currentSlide + 1) % this.sliders.length;
        const videoRefName = `video-${this.sliders[this.currentSlide]?.path}`;
        const videoElement = this.$refs[videoRefName];
        if(videoElement){
            
            this.duration_video = videoElement[0]?.duration * 1000 ?? 5000;
        }
        else{
            this.duration_video = 5000;
        }
        this.startSlider();
    },
    
    goToSlide(index) {
        clearInterval(this.sliderInterval);

        this.currentSlide = index;
        const videoRefName = `video-${this.sliders[this.currentSlide].path}`;
        const videoElement = this.$refs[videoRefName];
        if(videoElement){
            // this.duration_video = videoElement[0].duration * 1000 ?? 5000;
            // videoElement[0].play();
            const video = videoElement[0];
            video.currentTime = 0;  // Reinicia el video
            this.duration_video = video.duration * 1000 ?? 5000;  // Calculamos la duración
            video.play(); 
        }
        else{
            this.duration_video = 5000;
        }
        this.startSlider();

    },
    cerrar_filtrado(){
        this.filtrado_modal = !this.filtrado_modal;
        this.categoria_seleccionada = '';
        this.marca_seleccionada = '';
        this.producto_input = '';
    },
    go_to_producto(producto_id){
        this.go_to_route(
            'producto',
            { 'producto_id': producto_id }
        )
    }
  },
  computed: {
    ...mapGetters([
        'sliders',
        'categorias_destacadas',
        'marcas_destacadas',
        'home_nosotros',
        'productos_destacadas',
        'novedades',
        'categorias',
        'marcas',
        'productos',
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
    marcasUnicas() {
        return this.marcas_destacadas.filter((value, index, self) => 
            index === self.findIndex((t) => (
                t.nombre === value.nombre // Cambia 'name' por el campo que identifique a las marcas
            ))
        );
    }
  },
};
</script>

     

     