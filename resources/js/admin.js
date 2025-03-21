import './bootstrap';

import { createApp } from 'vue'
import Main from '@admin/Main.vue'
import router from '@admin/Router'
import register_admin_components from "@admin/Components";
import mixins from './mixins'
import store from '@admin/Store'

// Crear la aplicación
const admin = createApp(Main);

// Usar el router
admin.use(router);
admin.use(store);
admin.mixin(mixins);
// Registrar componentes antes de montar
register_admin_components(admin);

// Montar la aplicación
admin.mount('#admin');
