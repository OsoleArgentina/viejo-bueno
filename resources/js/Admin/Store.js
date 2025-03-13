import { createStore } from 'vuex'

// Import Modules
import AuthModule from '@admin/Store/AuthModule';
import HomeModule from '@admin/Store/HomeModule';
import NosotrosModule from '@admin/Store/NosotrosModule';
import CategoriaModule from '@admin/Store/CategoriaModule';

// Create a new Store instance.
const store = createStore({
    modules: {
        AuthModule,
        HomeModule,
        NosotrosModule,
        CategoriaModule,
    }
});

export default store;
