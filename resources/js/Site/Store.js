import { createStore } from 'vuex'

// Import Modules
import HomeModule from '@site/Store/HomeModule'

// Create a new Store instance.
const store = createStore({
    modules: {
        HomeModule,
    }
});

export default store;
