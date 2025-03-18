<template>
    <div class="w-full px-20 mt-40 mb-20">
        
        <!-- DataTable -->
        <div class="mb-20">
            <div class="w-12 border-t-2 bg-neutral-800 mb-4"></div>
            <h2 class="text-4xl font-semibold mb-2">Carrito</h2>
            <div v-if="carrito.length > 0" class="overflow-x-auto my-6">
                <table class="min-w-full table-auto">
                    <thead class="bg-neutral-100">
                        <tr class="text-left">
                            <th class="px-4 py-2"></th>
                            <th class="px-4 py-2">Producto</th>
                            <th class="px-4 py-2">Precio</th>
                            <th class="px-4 py-2">Cantidad</th>
                            <th class="px-4 py-2">Subtotal</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody class="text-neutral-600">
                        <tr v-for="(producto, index) in carrito" :key="producto.id" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'" class="border-b border-neutral-200">
                            <td class="px-4 py-2">
                                <img v-if="producto?.imagenes[0].path" :src="`/img/${producto?.imagenes[0].path}`" alt="producto Image" class="w-20 h-20 object-contain border border-neutral-200 rounded-lg">
                            </td>
                            <td class="px-4 py-2">{{ producto.nombre }}</td>
                            <td class="px-4 py-2">${{ format_price(producto.precio) }}</td>
                            <td class="px-4 py-2">
                                <div class="w-24 py-1 rounded-full border border-neutral-200 flex justify-center items-center gap-8 cursor-pointer">
                                    <span class="text-lg">
                                        {{ producto.cantidad }}
                                    </span>
                                    <span class="flex flex-col">
                                        <i @click="incrementar_cantidad(producto)" class="fa-solid fa-angle-up hover:text-theme-400 duration-200"></i>
                                        <i @click="decrementar_cantidad(producto)" class="fa-solid fa-angle-down hover:text-theme-400 duration-200"></i>
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-2">${{ format_price(producto.cantidad * producto.precio) }}</td>
          
            
                            <td class="px-4 py-2">
                                <button @click="eliminar_producto(producto)" class="text-theme-400 px-2 py-1 rounded-lg  hover:bg-site-theme duration-300 cursor-pointer text-xl"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-else class="flex justify-center">
                <h1 class="text-xl font-semibold text-neutral-500">No hay productos en el carrito.</h1>
            </div>
    
            <a href="#/productos" class="w-56 border border-theme-600 text-theme-400 px-4 py-2 rounded-4xl bg-white duration-300 hover:text-white hover:bg-theme-400 cursor-pointer">
                + Agregar productos
            </a>
        </div>
        
        <!-- Form compra -->
        <div>
            <div class="w-12 border-t-2 bg-neutral-800 mb-4"></div>
            <h2 class="text-4xl font-semibold mb-4">Finalizar compra</h2>

            <div class="flex gap-24">
                <div class="w-1/2">
                    <h3 class="text-theme-400 font-semibold text-xl mb-4">Datos de facturación</h3>
                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium">Nombre y Apellido*</label>
                            <input type="text" id="nombre" v-model="nombre" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="pais" class="block text-sm font-medium">País / Región*</label>
                            <input type="text" id="pais" v-model="pais" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="direccion" class="block text-sm font-medium">Dirección de la calle*</label>
                            <input type="text" id="direccion" v-model="direccion" class="mt-1 p-2 w-full border border-gray-300 rounded-md mb-3">
                            <input type="text" id="direccion_detalle" v-model="direccion_detalle" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Apartamento, habitación, unidad, etc.">
                        </div>
                        <div class="mb-4">
                            <label for="localidad" class="block text-sm font-medium">Localidad / Ciudad*</label>
                            <input type="text" id="localidad" v-model="localidad" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="codigo_postal" class="block text-sm font-medium">Código postal*</label>
                            <input type="text" id="codigo_postal" v-model="codigo_postal" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="telefono" class="block text-sm font-medium">Teléfono*</label>
                            <input type="text" id="telefono" v-model="telefono" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="correo" class="block text-sm font-medium">Correo electrónico*</label>
                            <input type="text" id="correo" v-model="correo" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="informacion_adicional" class="block text-sm font-medium">Información adicional</label>
                            <input type="text" id="informacion_adicional" v-model="informacion_adicional" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Notas sobre su pedido, etc.">
                        </div>
    
                        <div class="w-full text-end">
                            <span >* campos obligatorios</span>
                        </div>
                </div>

                <div class="w-1/2 flex flex-col justify-between">
                    <div class="">
                        <h3 class="text-theme-400 font-semibold text-xl mb-4">Tu pedido</h3>
                        <div v-if="carrito.length > 0" class="border border-neutral-200 p-5">
                            <div v-for="(producto, index) in carrito" :key="index" class="text-neutral-600 flex justify-between mb-1">
                                <span>{{ producto.nombre }}</span>
                                <span>${{ format_price(producto.subtotal) }}</span>
                            </div>
                            <div class="flex justify-between text-2xl mt-10 font-medium">
                                <span>Total</span>
                                <span>${{ format_price(total) }}</span>
                            </div>
                        </div>
                        <div v-else class="border text-neutral-600 p-2">
                            <span class="text-md font-medium text-neutral-500">No hay productos en el carrito.</span>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-theme-400 font-semibold text-xl mb-4">Formas de pago</h3>
                        <div class="border border-neutral-200 p-5">
                            <div>
                                <input type="radio" id="mercado_pago" name="payment_method" value="mercado_pago" v-model="selected_payment_method" class="mr-2" />
                                <label for="mercado_pago" class="text-lg">Mercado Pago</label>
                            </div>
                            <div>
                                <input type="radio" id="transferencia" name="payment_method" value="transferencia" v-model="selected_payment_method" class="mr-2" />
                                <label for="transferencia" class="text-lg">Transferencia</label>
                            </div>
                            <div>
                                <input type="radio" id="efectivo" name="payment_method" value="efectivo" v-model="selected_payment_method" class="mr-2" />
                                <label for="efectivo" class="text-lg">Efectivo</label>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <h3 class="text-theme-400 font-semibold text-xl mb-4">Formas de entrega</h3>
                        <div class="border border-neutral-200 p-5">
                            <div>
                                <input type="radio" id="retiro" name="delivery_method" value="retiro" v-model="selected_delivery" class="mr-2" />
                                <label for="retiro" class="text-lg">Retiro (sin costo)</label>
                            </div>
                            <div>
                                <input type="radio" id="envio" name="delivery_method" value="envio" v-model="selected_delivery" class="mr-2" />
                                <label for="envio" class="text-lg">Envío a todo el país</label>
                            </div>
                        </div>
                    </div>

                    <div class="w-full flex justify-end items-center gap-10">
                        <button class="w-1/3 border border-theme-600 text-theme-400 px-4 py-2 rounded-4xl bg-white duration-300 hover:text-white hover:bg-theme-400 cursor-pointer">
                            Cancelar pedido
                        </button>
                        <button @click="selected_payment_method == 'mercado_pago' ? crear_preference_mp() : crear_pedido()" class="w-1/3 border border-theme-600 text-theme-400 px-4 py-2 rounded-4xl bg-site-theme duration-300 hover:text-white hover:bg-theme-400 cursor-pointer">
                            Realizar pedido
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Spinner de carga -->
    <div v-if="isLoading" class="fixed inset-0 bg-opacity-50 bg-gray-600 flex justify-center items-center" style="z-index: 1000;">
        <div class="spinner-border animate-spin inline-block w-16 h-16 border-4 rounded-full border-t-transparent border-theme-400"></div> 
    </div>

    <!-- <div id="wallet_container"></div> -->

</template>

<script>
import { mapGetters, mapActions } from "vuex";
import API_ADMIN from '@admin/API';

export default{
    data() {
        return {
            carrito: [],
            isLoading: false,
            selected_payment_method: 'mercado_pago',
            selected_delivery: 'retiro',

            //form de info
            nombre: '',
            pais: '',
            direccion: '',
            direccion_detalle: '',
            localidad: '',
            codigo_postal: '',
            telefono: '',
            correo: '',
            informacion_adicional: '',
        }
    },
    methods:{
        incrementar_cantidad(producto){
            let producto_carrito = this.carrito.find(item => item.id === producto.id);
            producto_carrito.cantidad++;
            producto_carrito.subtotal = producto_carrito.cantidad * producto_carrito.precio;

            localStorage.setItem('carrito', JSON.stringify(this.carrito));
        },
        decrementar_cantidad(producto){
            let producto_carrito = this.carrito.find(item => item.id === producto.id);
            if(producto_carrito.cantidad == 1){
                return;
            }
            producto_carrito.cantidad--;
            producto_carrito.subtotal = producto_carrito.cantidad * producto_carrito.precio;
            localStorage.setItem('carrito', JSON.stringify(this.carrito));
        },
        eliminar_producto(producto){
            const index = this.carrito.findIndex(item => item.id === producto.id);
        
            if (index !== -1) {
                this.carrito.splice(index, 1);
                
                localStorage.setItem('carrito', JSON.stringify(this.carrito));
            }
        },
        async crear_preference_mp(){
            this.isLoading = true; 
            const data = {
                'pedido': this.carrito,
            }
            const response = await this.send_http_request(
                API_ADMIN.createPreference, 
                'POST', 
                {}, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                // const mp = new MercadoPago('APP_USR-7f31f608-9608-461e-af7f-badd836f375f');

                // mp.bricks().create("wallet", "wallet_container", {
                //     initialization: {
                //         preferenceId: response.data.preference.id,
                //     },
                //     customization: {
                //     texts: {
                //         valueProp: 'smart_option',
                //     },
                //     },
                // });
                
                const preferenceId = response.data.preference.id;
                const mpUrl = `https://www.mercadopago.com.ar/checkout/v1/redirect?pref_id=${preferenceId}`;
                window.location.href = mpUrl;
                this.isLoading = false; 
            }
        },
        async crear_pedido(){
            this.isLoading = true; 
            const data = {
                'nombre': this.nombre,
                'pais': this.pais,
                'direccion': this.direccion,
                'direccion_detalle': this.direccion_detalle,
                'localidad': this.localidad,
                'codigo_postal': this.codigo_postal,
                'telefono': this.telefono,
                'correo': this.correo,
                'informacion_adicional': this.informacion_adicional,
                'pedido': this.carrito,
            }
    
            const response = await this.send_http_request(
                API_ADMIN.create_pedido, 
                'POST', 
                {}, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.isLoading = false;
                this.pais = '';
                this.direccion = '';
                this.direccion_detalle = '';
                this.localidad = '';
                this.codigo_postal = '';
                this.telefono = '';
                this.correo = '';
                this.informacion_adicional = '';
                localStorage.removeItem('carrito');
                this.toast_notification({ message: response.data.message })
            }
        }
    },
    created(){
        this.carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    },
    computed:{
        total(){
            return this.carrito.reduce((acc, producto) => {
                return acc + parseFloat(producto.subtotal) ;
            }, 0);
        }
    }
}

</script>