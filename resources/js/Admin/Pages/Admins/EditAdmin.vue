<template>
    <!-- Modal -->
    <div  class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 modal-animation">
            <h2 class="text-2xl font-semibold mb-4">Editar administrador</h2>

            <div>
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Nombre de usuario *</label>
                    <input type="text" id="username" v-model="username" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Nombre de usuario">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña *</label>
                    <input type="password" id="password" v-model="password" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="xxxxxxx">
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirmar contraseña *</label>
                    <input type="password" id="confirm_password" v-model="confirm_password" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Confirmar contraseña">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo *</label>
                    <input type="text" id="email" v-model="email" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Correo">
                </div>
                <div class="flex justify-between mb-4">
                    <label for="is_admin" class="block text-sm font-medium text-gray-700">Super admin *</label>
                    <switch-input
                        id="is_admin"
                        :default_value="!!is_admin"
                        v-on:turn_on="is_admin = true"
                        v-on:turn_off="is_admin = false"/>
                </div>

                <div class="flex justify-end space-x-2">
                    <button @click="emit_event('close_modal')" type="button" class="px-4 py-2 bg-gray-300 duration-300 hover:bg-gray-400 text-black rounded-md cursor-pointer">Cancelar</button>
                    <button @click="edit_admin" class="px-4 py-2 bg-theme-400 text-white rounded-md duration-300 hover:bg-theme-600 cursor-pointer">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
      'admin_edit',
    ],
    data() {
        return {
            username: '',
            password: '',
            confirm_password: '',
            email: '',
            is_admin: '',
        };
    },
    methods: {
        edit_admin() {
            if (this.password !== this.confirm_password) {
                this.toast_notification({ message: 'Las contraseñas no coinciden.', type: 'error' })

                return;
            }
            
            const data = {
                'admin_id': this.admin_edit.id,
                'username': this.username,
                'password': this.password,
                'email': this.email,
                'is_admin': this.is_admin ? 1 : 0,
            }

            if(this.password) data.password = this.password;

            this.emit_event('edit_admin', data);
        },
    },
    created(){
        this.username = this.admin_edit.username;
        this.email = this.admin_edit.email;
        this.is_admin = this.admin_edit.is_admin;
    },
};
</script>
