<template>
    <div v-if="render_contacto">
        
        <div class="w-full border-b border-neutral-200">
            <h1 class="text-4xl font-semibold text-neutral-800 mb-4">CONTACTO</h1>
        </div>
    
        <div class="mt-5 w-full">
            <div class="w-full">
                <label for="google_maps_iframe" class="block text-sm font-medium text-gray-700">Google maps iframe *</label>
                <input type="text" id="google_maps_iframe" v-model="google_maps_iframe" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="<iframe></iframe>">
            </div>
            <div class="mt-4 flex items-center gap-5">
                <div class="w-1/2">
                    <label for="direccion" class="block text-sm font-medium text-gray-700">Direccion *</label>
                    <input type="text" id="direccion" v-model="direccion" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Direccion">
                </div>
                <div class="w-1/2">
                    <label for="telefono" class="block text-sm font-medium text-gray-700">Telefono *</label>
                    <input type="text" id="telefono" v-model="telefono" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="xxxxxxxx">
                </div>
            </div>
            <div class="mt-4 flex w-full gap-5">
                <div class="w-1/2">
                    <label for="correo" class="block text-sm font-medium text-gray-700">Correo *</label>
                    <input type="text" id="correo" v-model="correo" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Correo">
                </div>
                <div class="w-1/2">
                    <label for="whatsapp" class="block text-sm font-medium text-gray-700">Whatsapp *</label>
                    <input type="text" id="whatsapp" v-model="whatsapp" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="xxxxxxxx">
                </div>
            </div>
            <div class="mt-4 flex w-full gap-5">
                <div class="w-1/2">
                    <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram *</label>
                    <input type="text" id="instagram" v-model="instagram" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Instagram">
                </div>
                <div class="w-1/2">
                    <label for="facebook" class="block text-sm font-medium text-gray-700">Facebook *</label>
                    <input type="text" id="facebook" v-model="facebook" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="facebook">
                </div>
            </div>
            <div class="w-full flex justify-end">
                <button @click="set_contacto" class="px-6 py-2 mt-5 bg-theme-400 text-white rounded-md hover:bg-theme-500 duration-300 focus:outline-none focus:ring-2 cursor-pointer">
                    Guardar
                </button>
            </div>
    
        </div>
    
        <!-- Spinner de carga -->
        <div v-if="isLoading" class="fixed inset-0 bg-opacity-50 bg-gray-600 flex justify-center items-center" style="z-index: 1000;">
            <div class="spinner-border animate-spin inline-block w-16 h-16 border-4 rounded-full border-t-transparent border-theme-400"></div>
        </div>
    </div>

</template>

<script>
import API_ADMIN from '@admin/API';
import { mapGetters, mapActions } from "vuex";

export default {
    data() {
        return {
            isLoading: false,
            google_maps_iframe: '',
            direccion: '',
            telefono: '',
            correo: '',
            whatsapp: '',
            instagram: '',
            facebook: '',
            render_contacto: false,
        };
    },
    methods: {
        ...mapActions([
            'get_contacto',
        ]),
        async set_contacto() {
            this.isLoading = true; 

            let data = {
                'contacto_id': this.contacto?.id ?? null,
                'google_maps_iframe': this.google_maps_iframe,
                'direccion': this.direccion,
                'telefono': this.telefono,
                'correo': this.correo,
                'whatsapp': this.whatsapp,
                'instagram': this.instagram,
                'facebook': this.facebook,
            };

            const response = await this.send_http_request(
                API_ADMIN.set_contacto, 
                'POST',
                {}, 
                {}, 
                data
            );


            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                await this.get_contacto();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },
    },
    async created(){
        this.isLoading = true;
        await this.get_contacto();
        this.google_maps_iframe = this.contacto?.google_maps_iframe
        this.direccion = this.contacto?.direccion
        this.telefono = this.contacto?.telefono
        this.correo = this.contacto?.correo
        this.whatsapp = this.contacto?.whatsapp
        this.instagram = this.contacto?.instagram
        this.facebook = this.contacto?.facebook

        this.render_contacto = true;
        this.isLoading = false;
    },
    computed:{
        ...mapGetters([
            'contacto',
        ]),
    }
};
</script>