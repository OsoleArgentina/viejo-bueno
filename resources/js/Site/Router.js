import { createRouter, createWebHashHistory } from 'vue-router';

// HOME PAGE
import Home from '@site/Pages/Home.vue'
import Nosotros from '@site/Pages/Nosotros.vue'
import Main from '@site/Main.vue'
import Productos from '@site/Pages/Productos/Productos.vue';
import ListProductos from '@site/Pages/Productos/ListProductos.vue';
import Producto from '@site/Pages/Productos/Producto.vue';
import Carrito from '@site/Pages/Carrito.vue';
import Marcas from '@site/Pages/Marcas.vue';
import Novedades from '@site/Pages/Novedades/Novedades.vue';
import ListNovedades from '@site/Pages/Novedades/ListNovedades.vue';
import Novedad from '@site/Pages/Novedades/Novedad.vue';
import Capacitaciones from '@site/Pages/Capacitaciones.vue';
import Contacto from '@site/Pages/Contacto.vue';
const Routes = [
    {
        path: "/",
        component: Main,
        children: [
            {
                path: "",
                name: "home",
                component: Home,
            },
            {
                path: "/nosotros",
                name: "nosotros",
                component: Nosotros,
            },
            {
                path: "/productos",
                component: Productos,
                children: [
                    {
                        path: "",
                        name: "productos",
                        component: ListProductos,
                    },
                    {
                        path: "producto/:producto_id",
                        name: "producto",
                        component: Producto,
                    },
                ]
            },
            {
                path: "/marcas",
                name: "marcas",
                component: Marcas,
            },
            {
                path: "/capacitaciones",
                name: "capacitaciones",
                component: Capacitaciones,
            },
            {
                path: "/contacto",
                name: "contacto",
                component: Contacto,
            },
            {
                path: "/carrito",
                name: "carrito",
                component: Carrito,
            },
            {
                path: "/novedades",
                component: Novedades,
                children: [
                    {
                        path: "",
                        name: "novedades",
                        component: ListNovedades,
                    },
                    {
                        path: "novedad/:novedad_id",
                        name: "novedad",
                        component: Novedad,
                    },
                ]
            },
        ]
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes: Routes,
})

export default router
