<template>
    <nav class="bg-white shadow-md fixed w-[88%] z-10 top-0 left-0 py-3 px-7 ml-60">
        <div class="flex justify-between items-center ">
            <h1 class="text-xl font-semibold text-neutral-800">Panel de Administración</h1>

            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button
                        @click="toggleDropdown"
                        class="px-4 py-2 text-sm bg-theme-400 text-neutral-700 rounded-md hover:bg-theme-200 cursor-pointer"
                    >
                        <span class="mr-2 text-white">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <span class="text-white">
                            {{ admin.username }}
                        </span>
                    </button>
                    <div
                        v-if="dropdownVisible"
                        class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-md z-20"
                    >
                        <a
                            href="/"
                            target="_blank"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        >
                            Ir al sitio
                        </a>
                        <button
                            @click="logout"
                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 cursor-pointer"
                        >
                            Cerrar sesión
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import API_ADMIN from '@admin/API';
import { mapGetters } from "vuex";

export default {
    data() {
        return {
            dropdownVisible: false
        };
    },
    methods: {
        toggleDropdown() {
            this.dropdownVisible = !this.dropdownVisible;
        },
        logout() {
            const method = 'POST';
            const headers = {
                'Content-Type': 'application/json',
            };

            const response = this.send_http_request(API_ADMIN.logout, method, {}, {});

            if (!response) {
                console.error('Error al hacer logout:', response);
            } else {
                window.location.href = 'login/admin';
            }
        }
    },
    computed: {
        ...mapGetters([
            'admin',
        ])
    }
};
</script>

<style scoped>
/* Puedes personalizar los estilos del dropdown aquí */
</style>
