import { createRouter, createWebHashHistory } from 'vue-router';

// HOME PAGE
import Main from '@admin/Main.vue'
import Dashboard from '@admin/Pages/Dashboard.vue'
import Slider from '@admin/Pages/Home/Sliders/Slider.vue'
import HomeNosotros from '@admin/Pages/Home/Nosotros/HomeNosotros.vue';
import Nosotros from '@admin/Pages/Nosotros/Nosotros.vue';
import Elegirnos from '@admin/Pages/Nosotros/Elegirnos.vue';
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
        ]
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes: Routes,
})

export default router
