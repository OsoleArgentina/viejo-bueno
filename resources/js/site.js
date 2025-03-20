import './bootstrap';

import { createApp } from 'vue'
import Main from '@site/Main.vue'
import router from '@site/Router'
import register_site_components from "@site/Components";
import mixins from './mixins'
import store from '@site/Store'
import Toast from 'vue-toastification';
import { createHead } from '@vueuse/head'
// Crear la aplicación
const site = createApp(Main);
const head = createHead()

site.use(head)
site.use(router);
site.use(store);
site.mixin(mixins);
register_site_components(site);
site.use(Toast)

site.mount('#site');
