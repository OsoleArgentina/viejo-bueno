import { createStore } from 'vuex'

// Import Modules
import AuthModule from '@admin/Store/AuthModule';
import HomeModule from '@admin/Store/HomeModule';

// Create a new Store instance.
const store = createStore({
    modules: {
        AuthModule,
        HomeModule,
    }
});

export default store;
