import { createRouter, createWebHistory } from 'vue-router';

// HOME PAGE
import Main from '@admin/Main.vue'
import Dashboard from '@admin/Pages/Dashboard.vue'

import Sliders from '@admin/Pages/Home/Sliders/Sliders.vue'
import HomeNosotros from '@admin/Pages/Home/Nosotros/HomeNosotros.vue';
import Nosotros from '@admin/Pages/Nosotros/Nosotros.vue';
import Elegirnos from '@admin/Pages/Nosotros/Elegirnos.vue';
import Categorias from '@admin/Pages/Categorias/Categorias.vue';
import Subcategorias from '@admin/Pages/Subcategorias/Subcategorias.vue';
import Productos from '@admin/Pages/Productos/Productos.vue';
import Marcas from '@admin/Pages/Marcas/Marcas.vue';
import Novedades from '@admin/Pages/Novedades/Novedades.vue';
import Capacitaciones from '@admin/Pages/Capacitaciones/Capacitaciones.vue';
import Contacto from '@admin/Pages/Contacto/Contacto.vue';
import Admins from '@admin/Pages/Admins/Admins.vue';
import Metadatos from '@admin/Pages/Metadatos/Metadatos.vue';
import PopUp from '@admin/Pages/PopUp/PopUp.vue';
const Routes = [
    // {
    //     path: "/",
    //     component: Main,
    //     children: [
            {
                path: "/",
                name: "dashboard",
                component: Dashboard,
            },
            {
                path: "/admin/sliders",
                name: "sliders",
                component: Sliders,
            },
            {
                path: "/admin/home-nosotros",
                name: "home-nosotros",
                component: HomeNosotros,
            },
            {
                path: "/admin/nosotros",
                name: "nosotros",
                component: Nosotros,
            },
            {
                path: "/admin/elegirnos",
                name: "elegirnos",
                component: Elegirnos,
            },
            {
                path: "/admin/categorias",
                name: "categorias",
                component: Categorias,
            },
            {
                path: "/admin/subcategorias",
                name: "subcategorias",
                component: Subcategorias,
            },
            {
                path: "/admin/productos",
                name: "productos",
                component: Productos,
            },
            {
                path: "/admin/marcas",
                name: "marcas",
                component: Marcas,
            },
            {
                path: "/admin/novedades",
                name: "novedades",
                component: Novedades,
            },
            {
                path: "/admin/capacitaciones",
                name: "capacitaciones",
                component: Capacitaciones,
            },
            {
                path: "/admin/contacto",
                name: "contacto",
                component: Contacto,
            },
            {
                path: "/admin/admins",
                name: "admins",
                component: Admins,
            },
            {
                path: "/admin/metadatos",
                name: "metadatos",
                component: Metadatos,
            },
            {
                path: "/admin/popup",
                name: "popup",
                component: PopUp,
            },
    //     ]
    // },
];

const router = createRouter({
    history: createWebHistory(),
    routes: Routes,
});

export default router
