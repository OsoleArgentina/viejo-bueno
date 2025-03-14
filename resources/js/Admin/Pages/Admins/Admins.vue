<template>
    <div class="w-full flex justify-between items-center border-b border-neutral-200 mb-4">
        <div class="flex items-center gap-2">
            <h1 class="text-4xl font-semibold text-neutral-800">ADMINISTRADORES</h1>
            <span class="text-sm text-white bg-theme-400 rounded-full px-2 py-1">{{ all_admins.length }}</span>
        </div>
    
        <div class="mb-4">
            <button @click="admin_modal = !admin_modal" class="px-6 py-2 bg-theme-400 text-white rounded-md hover:bg-theme-500 duration-300 focus:outline-none focus:ring-2 cursor-pointer">
                Crear administrador
            </button>
        </div>
    </div>

    <!-- DataTable -->
    <div v-if="all_admins.length > 0" class="overflow-x-auto mt-6">
        <table class="min-w-full table-auto">
            <thead class="border-b border-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Correo</th>
                    <th class="px-4 py-2">Super admin</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(admin, index) in all_admins" :key="admin.id" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                    <td class="px-4 py-2">{{ admin.username }}</td>
                    <td class="px-4 py-2">{{ admin.email }}</td>
                    <td class="px-4 py-2">
                        <switch-input
                            :id="admin.id"
                            :default_value="!!admin.is_admin"
                            v-on:turn_on="toggle_switch_is_admin(true, admin.id)"
                            v-on:turn_off="toggle_switch_is_admin(false, admin.id)"/>
                    </td>
                    <td class="px-4 py-2">
                        <button @click="edit_admin_modal = !edit_admin_modal; admin_selected=admin" class="text-theme-500 px-2 py-1 border border-theme-400 rounded-lg hover:text-white hover:bg-theme-400 duration-300 cursor-pointer"><i class="fa-regular fa-pen-to-square"></i></button>
                        <button @click="delete_admin_modal = !delete_admin_modal; admin_selected=admin" class="text-red-500 px-2 py-1 border border-red-500 rounded-lg hover:text-white hover:bg-red-500 duration-300 cursor-pointer ml-4"><i class="fa-solid fa-trash"></i></button>
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
    
    <create-admin v-if="admin_modal" @close_modal="admin_modal = !admin_modal" @create_admin="create_admin" />
    <edit-admin v-if="edit_admin_modal"  :admin_edit="admin_selected" @close_modal="edit_admin_modal = !edit_admin_modal" @edit_admin="edit_admin"/>
    <confirmation-modal v-if="delete_admin_modal" :message="'Estas seguro de eliminar al administrador? ' + admin_selected.username" @cancel="delete_admin_modal = !delete_admin_modal" @confirm="delete_admin(admin_selected.id)"/>
</template>

<script>
import API_ADMIN from '@admin/API';
import { mapGetters, mapActions } from "vuex";
import CreateAdmin from './CreateAdmin.vue';
import EditAdmin from './EditAdmin.vue';

export default {
    components:{
        'create-admin': CreateAdmin,
        'edit-admin': EditAdmin,
    },
    data() {
        return {
            admin_modal: false, 
            edit_admin_modal: false,
            delete_admin_modal: false, 
            admin_selected: null,
            isLoading: false,
        };
    },
    methods: {
        ...mapActions([
            'get_admins',
        ]),
        async create_admin(data) {
            this.isLoading = true; 

            const response = await this.send_http_request(
                API_ADMIN.create_admin, 
                'POST', 
                {}, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.admin_modal = false;
                await this.get_admins();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async toggle_switch_is_admin(value, admin_id){
            this.isLoading = true; 
        
            const data = {
                'admin_id': admin_id,
                'is_admin': value,
            };

            const response = await this.send_http_request(
                API_ADMIN.edit_super_admin, 
                'POST', 
                {}, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                await this.get_admins();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async edit_admin(data) {
            this.isLoading = true; 

            const response = await this.send_http_request(
                API_ADMIN.edit_admin, 
                'POST', 
                {}, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.edit_admin_modal = !this.edit_admin_modal;
                await this.get_admins();
                this.isLoading = false; 
                this.toast_notification({ message: response.data.message })
            }
        },

        async delete_admin(admin_id) {
            this.isLoading = true; 

            const data = {admin_id: admin_id};
            const response = await this.send_http_request(
                API_ADMIN.delete_admin,
                'DELETE', 
                {}, 
                {}, 
                data
            );

            if(response.data.error){
                this.isLoading = false; 
                this.toast_notification({ message: response.data.error, type: 'error' })
            }else{
                this.delete_admin_modal = !this.delete_admin_modal;
                await this.get_admins();
                this.isLoading = false;
                this.toast_notification({ message: response.data.message })
            }
        }

    },
    async created(){
        this.isLoading = true; 
        await this.get_admins();
        this.isLoading = false; 
    },
    computed:{
        ...mapGetters([
            'all_admins',
        ]),
    }
};
</script>