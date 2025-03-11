import { createRouter, createWebHashHistory } from 'vue-router';

// HOME PAGE
import Dashboard from '@admin/Pages/Dashboard.vue'
import Slider from '@admin/Pages/Home/Sliders/Slider.vue'
import Main from '@admin/Main.vue'

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
        ]
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes: Routes,
})

export default router
