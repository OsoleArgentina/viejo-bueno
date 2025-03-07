import './bootstrap';

import { createApp } from 'vue'
import Main from '@site/Main.vue'
import router from '@site/Router'
import register_site_components from "@site/Components";
import mixins from './mixins'
import store from '@site/Store'

// Crear la aplicación
const site = createApp(Main);

// Usar el router
site.use(router);
site.use(store);
site.mixin(mixins);

// Registrar componentes antes de montar
register_site_components(site);

// Montar la aplicación
site.mount('#site');
