import { createStore } from 'vuex'

// Import Modules
import AuthModule from '@admin/Store/AuthModule';
import HomeModule from '@admin/Store/HomeModule';
import NosotrosModule from '@admin/Store/NosotrosModule';

// Create a new Store instance.
const store = createStore({
    modules: {
        AuthModule,
        HomeModule,
        NosotrosModule,
    }
});

export default store;
