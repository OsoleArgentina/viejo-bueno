<template>
    <!-- Modal -->
    <div v-if="render_productos_imagenes" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-1/2 modal-animation">
            <h2 class="text-2xl font-semibold mb-4">Imagenes del producto <span class="font-bold text-theme-400">{{ producto.nombre }}</span></h2>

            <div class="mb-4">
                <div class="mt-2">
                    <div v-if="producto.imagenes.length">
                        <div class="grid grid-cols-3 gap-4">
                            <div v-for="(imagen, index) in producto.imagenes" :key="index" class="relative">
                                <span 
                                    @click="delete_imagen_producto(imagen)"
                                    class="absolute top-2 right-2 text-red-500 hover:bg-red-500 hover:text-white duration-300 py-1 px-2 bg-white rounded-md cursor-pointer z-10">
                                    <i class="fa-solid fa-trash"></i>
                                </span>

                                <div class="flex flex-col items-center justify-center rounded-md">
                                    <img :src="`/img/${imagen.path}`" alt="Imagen del producto" class="w-full h-40 object-cover rounded-md shadow-md">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="imagenes" class="block text-sm font-medium text-gray-700">Imágenes *</label>
                <input type="file" id="imagenes" @change="handleImageUpload" class="mt-1 p-2 w-full border border-gray-300 rounded-md" multiple>
                <div class="mt-2">
                    <div v-if="imagenes.length">
                        <div class="flex flex-col w-1/2">
                        <div v-for="(imagen, index) in imagenes" :key="index" class="inline-block mr-2">
                                <div class="bg-neutral-200 flex gap-5 mb-1 items-center justify-between p-2 rounded-md">
                                    <span>{{ imagen.name }}</span>
                                    <span @click="delete_image(imagen)" class="hover:text-neutral-500 duration-300 cursor-pointer">
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-2">
                <button @click="emit_event('close_modal')" type="button" class="px-4 py-2 bg-gray-300 duration-300 hover:bg-gray-400 text-black rounded-md cursor-pointer">Cancelar</button>
                <button @click="add_imagenes_producto" class="px-4 py-2 bg-theme-400 text-white rounded-md duration-300 hover:bg-theme-600 cursor-pointer">Agregar imagenes</button>
            </div>
        </div>
    </div>
</template>

<script>
import API_ADMIN from '@admin/API';
import { mapGetters, mapActions } from "vuex";

export default {
    props: [
      'producto_id',
    ],
    data() {
        return {
            imagenes: [],
            render_productos_imagenes: false,
        };
    },
    methods: {
        ...mapActions([
            'get_producto_by_id',
        ]),
        handleImageUpload(event) {
            const file = event.target.files[0]; 
            this.imagenes.push(file);
            event.target.value = '';
        },
        delete_image(imagen){
            this.imagenes = this.imagenes.filter(img => img.name !== imagen.name);
        },  
        async delete_imagen_producto(imagen){
            this.isLoading = true; 

            const data = {
                'producto_id': this.producto.id,
                'path': imagen.path,
            };
            const response = await this.send_http_request(
                API_ADMIN.delete_imagen_producto,
                'DELETE',
                {},
                {},
                data
                );

            
            if(response.data.error){
                this.isLoading = false;
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                await this.get_producto_by_id(this.producto_id);
                this.isLoading = false;
                this.toast_notification({ message: response.data.message })
            }
        },
        async add_imagenes_producto() {
            this.isLoading = true; 
            
            const headers = {
                'Content-Type': 'multipart/form-data',
            };
            const data = {
                'producto_id': this.producto.id,
                'imagenes': this.imagenes,
            };

            const response = await this.send_http_request(
            API_ADMIN.add_imagenes_producto,
                'POST',
                headers,
                {},
                data
            );
            
            if(response.data.error){
                this.isLoading = false;
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                await this.get_producto_by_id(this.producto_id);
                this.isLoading = false;
                this.toast_notification({ message: response.data.message })
            }
        },
    },
    async created(){
        this.isLoading = true;
        await this.get_producto_by_id(this.producto_id);
        this.isLoading = false;
        this.render_productos_imagenes = true;
        console.log(this.producto);
    },
    computed: {
        ...mapGetters([
            'producto',
        ]),
    },
};
</script>
