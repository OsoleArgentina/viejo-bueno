import { createRouter, createWebHashHistory } from 'vue-router';

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

const Routes = [
    {
        path: "/",
        component: Main,
        children: [
            {
                path: "/",
                name: "dashboard",
                component: Dashboard,
            },
            {
                path: "/sliders",
                name: "sliders",
                component: Sliders,
            },
            {
                path: "/home-nosotros",
                name: "home-nosotros",
                component: HomeNosotros,
            },
            {
                path: "/nosotros",
                name: "nosotros",
                component: Nosotros,
            },
            {
                path: "/elegirnos",
                name: "elegirnos",
                component: Elegirnos,
            },
            {
                path: "/categorias",
                name: "categorias",
                component: Categorias,
            },
            {
                path: "/subcategorias",
                name: "subcategorias",
                component: Subcategorias,
            },
            {
                path: "/productos",
                name: "productos",
                component: Productos,
            },
        ]
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes: Routes,
})

export default router
