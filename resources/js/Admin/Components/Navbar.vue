<template>
    <nav class="bg-white shadow-md fixed w-full z-10 top-0 left-0 py-3 px-4">
        <div class="flex justify-between items-center max-w-7xl mx-auto">
            <h1 class="text-xl font-semibold text-neutral-800">Panel de Administración</h1>

            <div class="flex items-center space-x-4">
                <span class="text-lg font-semibold text-neutral-700">{{ admin.username }}</span>
                <!-- hacerlo dropdown -->
                <a
                href="/" target="_blank"
                class="px-4 py-2 text-sm bg-blue-500 text-white rounded-md hover:bg-blue-600"
                >
                Ir al sitio
                </a>
                
                <button
                @click="logout()"
                class="px-4 py-2 text-sm bg-red-500 text-white rounded-md hover:bg-red-600"
                >
                Cerrar sesión
                </button>
            </div>
        </div>
    </nav>
</template>

<script>
import API_ADMIN from '@admin/API';
import { mapGetters } from "vuex";

    export default {
        methods:{
            logout(){
                const method = 'POST';
                const headers = {
                    'Content-Type': 'application/json',
                };

                const response = this.send_http_request(API_ADMIN.logout, method, {}, {});

                if(!response){
                    console.error('Error al hacer logout:', response);

                }else{
                    window.location.href = 'login/admin';
                }
            }
        },
        computed:{
            ...mapGetters([
                'admin',
            ])
        }
    };
</script>