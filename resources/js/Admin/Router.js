import { createRouter, createWebHashHistory } from 'vue-router';

// HOME PAGE
import Main from '@admin/Main.vue'
import Dashboard from '@admin/Pages/Dashboard.vue'
import Slider from '@admin/Pages/Home/Sliders/Slider.vue'
import Nosotros from '@admin/Pages/Nosotros/Nosotros.vue';

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
                path: "/slider",
                name: "slider",
                component: Slider,
            },
            {
                path: "/home-nosotros",
                name: "home-nosotros",
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
