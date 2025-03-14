import { createRouter, createWebHashHistory } from 'vue-router';

// HOME PAGE
import Home from '@site/Pages/Home/Home.vue'
import Nosotros from '@site/Pages/Nosotros.vue'
import Main from '@site/Main.vue'

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
        ]
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes: Routes,
})

export default router
