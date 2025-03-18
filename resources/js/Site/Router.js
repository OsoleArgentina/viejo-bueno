import { createRouter, createWebHashHistory } from 'vue-router';

// HOME PAGE
import Home from '@site/Pages/Home.vue'
import Nosotros from '@site/Pages/Nosotros.vue'
import Main from '@site/Main.vue'
import Productos from '@site/Pages/Productos/Productos.vue';
import ListProductos from '@site/Pages/Productos/ListProductos.vue';
import Producto from './Pages/Productos/Producto.vue';
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
            }
        ]
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes: Routes,
})

export default router
