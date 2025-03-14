<template>
    <div class="w-full flex justify-between items-center border-b border-neutral-200 mb-4">
        <div class="flex items-center gap-2">
            <h1 class="text-4xl font-semibold text-neutral-800">METADATOS</h1>
        </div>
    </div>

    <!-- DataTable -->
    <div v-if="metadatos.length > 0" class="overflow-x-auto mt-6">
        <table class="min-w-full table-auto">
            <thead class="border-b border-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2">Seccion</th>
                    <th class="px-4 py-2">Keyword</th>
                    <th class="px-4 py-2">Descripcion</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(metadato, index) in metadatos" :key="metadato.id" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                    <td class="px-4 py-2">{{ metadato.seccion }}</td>
                    <td class="px-4 py-2">{{ metadato.keyword }}</td>
                    <td class="px-4 py-2">{{ metadato.descripcion }}</td>
                    <td class="px-4 py-2">
                        <button @click="edit_metadato_modal = !edit_metadato_modal; metadato_selected=metadato" class="text-theme-500 px-2 py-1 border border-theme-400 rounded-lg hover:text-white hover:bg-theme-400 duration-300 cursor-pointer"><i class="fa-regular fa-pen-to-square"></i></button>
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
    
    <edit-metadato v-if="edit_metadato_modal"  :metadato_edit="metadato_selected" @close_modal="edit_metadato_modal = !edit_metadato_modal" @edit_metadato="edit_metadato"/>
</template>

<script>
import API_ADMIN from '@admin/API';
import { mapGetters, mapActions } from "vuex";
import EditMetadato from './EditMetadato.vue';
export default {
    components:{
        'edit-metadato': EditMetadato,
    },
    data() {
        return {
            edit_metadato_modal: false,
            metadato_selected: null,
            isLoading: false,
        };
    },
    methods: {
        ...mapActions([
            'get_metadatos',
        ]),
       
        async edit_metadato(data) {
            this.isLoading = true; 

            const response = await this.send_http_request(
                API_ADMIN.edit_metadato, 
                'POST', 
                {}, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.edit_metadato_modal = !this.edit_metadato_modal;
                await this.get_metadatos();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },
    },
    async created(){
        this.isLoading = true; 
        await this.get_metadatos();
        this.isLoading = false; 
    },
    computed:{
        ...mapGetters([
            'metadatos',
        ]),
    }
};
</script>