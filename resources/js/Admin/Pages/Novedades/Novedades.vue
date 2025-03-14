<template>
    <div class="w-full flex justify-between items-center border-b border-neutral-200 mb-4">
        <div class="flex items-center gap-2">
            <h1 class="text-4xl font-semibold text-neutral-800">NOVEDADES</h1>
            <span class="text-sm text-white bg-theme-400 rounded-full px-2 py-1">{{ novedades.length }}</span>
        </div>
    
        <div class="mb-4">
            <button @click="novedad_modal = !novedad_modal" class="px-6 py-2 bg-theme-400 text-white rounded-md hover:bg-theme-500 duration-300 focus:outline-none focus:ring-2 cursor-pointer">
                Crear novedad
            </button>
        </div>
    </div>

    <!-- DataTable -->
    <div v-if="novedades.length > 0" class="overflow-x-auto mt-6">
        <table class="min-w-full table-auto">
            <thead class="border-b border-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2">Orden</th>
                    <th class="px-4 py-2">Imagen</th>
                    <th class="px-4 py-2">Título</th>
                    <th class="px-4 py-2">Subtítulo</th>
                    <th class="px-4 py-2">Descripcion</th>
                    <th class="px-4 py-2">Descripcion(ver mas)</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(novedad, index) in novedades" :key="novedad.id" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                    <td class="px-4 py-2">{{ novedad.orden }}</td>
                    <td class="px-4 py-2">
                        <img v-if="novedad.path" :src="`/img/${novedad.path}`" alt="Novedad Image" class="w-20 h-20 object-cover">
                    </td>
                    <td class="px-4 py-2">{{ novedad.titulo }}</td>
                    <td class="px-4 py-2">{{ novedad.subtitulo }}</td>
                    <td v-html="novedad.descripcion_corta" class="px-4 py-2"></td>
                    <td v-html="novedad.descripcion_larga" class="px-4 py-2"></td>
                    <td class="px-4 py-2">
                        <button @click="edit_novedad_modal = !edit_novedad_modal; novedad_selected=novedad" class="text-theme-500 px-2 py-1 border border-theme-400 rounded-lg hover:text-white hover:bg-theme-400 duration-300 cursor-pointer"><i class="fa-regular fa-pen-to-square"></i></button>
                        <button @click="delete_novedad_modal = !delete_novedad_modal; novedad_selected=novedad" class="text-red-500 px-2 py-1 border border-red-500 rounded-lg hover:text-white hover:bg-red-500 duration-300 cursor-pointer ml-4"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else class="flex justify-center">
        <h1 class="text-xl font-semibold text-neutral-500">No hay registros</h1>
    </div>

    <!-- Spinner de carga -->
    <div v-if="isLoading" class="fixed inset-0 bg-opacity-50 bg-gray-600 flex justify-center items-center" style="z-index: 1000;">
        <div class="spinner-border animate-spin inline-block w-16 h-16 border-4 rounded-full border-t-transparent border-theme-400"></div>
    </div>


    <create-novedad v-if="novedad_modal" @close_modal="novedad_modal = !novedad_modal" @create_novedad="create_novedad" />
    <confirmation-modal v-if="delete_novedad_modal" :message="'Estas seguro de eliminar la novedad? ' + novedad_selected.titulo" :data_id="novedad_selected.id" @cancel="delete_novedad_modal = !delete_novedad_modal" @confirm="delete_novedad(novedad_selected.id)"/>
    <edit-novedad v-if="edit_novedad_modal"  :novedad_edit="novedad_selected" @close_modal="edit_novedad_modal = !edit_novedad_modal" @edit_novedad="edit_novedad"/>
</template> 

<script>
import API_ADMIN from '@admin/API';
import { mapGetters, mapActions } from "vuex";
import CreateNovedad from './CreateNovedad.vue';
import EditNovedad from './EditNovedad.vue';

export default {
    components:{
        'create-novedad': CreateNovedad,
        'edit-novedad': EditNovedad
    },
    data() {
        return {
            novedad_modal: false, 
            edit_novedad_modal: false,
            delete_novedad_modal: false, 
            novedad_selected: null,
            isLoading: false,
        };
    },
    methods: {
        ...mapActions([
            'get_novedades',
        ]),
        async create_novedad(data) {
            this.isLoading = true; 
            const headers = {
                'Content-Type': 'multipart/form-data',
            };

            const response = await this.send_http_request(
                API_ADMIN.create_novedad,
                'POST', 
                headers, 
                {}, 
                data
            );


            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.novedad_modal = false;
                await this.get_novedades();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async edit_novedad(data) {
            this.isLoading = true; 
            const headers = {
                'Content-Type': 'multipart/form-data',
            };
            let formData = new FormData();

            let response = await this.send_http_request(
                API_ADMIN.edit_novedad,
                "POST",
                headers,
                {},
                data
            );


            if (response.data.error) {
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            } else {
                this.edit_novedad_modal = !this.edit_novedad_modal;
                await this.get_novedades();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async delete_novedad(novedad_id) {
            this.isLoading = true; 

            const method = 'DELETE';
            const data = {novedad_id: novedad_id};
            const response = await this.send_http_request(API_ADMIN.delete_novedad, method, {}, {}, data);

            if(response.data.error){
                this.isLoading = false;
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.delete_novedad_modal = !this.delete_novedad_modal;
                await this.get_novedades();
                this.isLoading = false;
                this.toast_notification({ message: response.data.message })
            }
        }

    },
    async created(){
        this.isLoading = true;
        await this.get_novedades();
        this.isLoading = false;
    },
    computed:{
        ...mapGetters([
            'novedades',
        ]),
    }
};
</script>
