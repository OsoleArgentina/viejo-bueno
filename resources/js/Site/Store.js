import { createStore } from 'vuex'

// Import Modules
import HomeModule from '@site/Store/HomeModule'
import MarcasModule from '@site/Store/MarcasModule';
import CategoriasModule from '@site/Store/CategoriasModule';
import ProductosModule from '@site/Store/ProductosModule';
import NovedadesModule from '@site/Store/NovedadesModules';
// Create a new Store instance.
const store = createStore({
    modules: {
        HomeModule,
        MarcasModule,
        CategoriasModule,
        ProductosModule,
        NovedadesModule,
    }
});

export default store;
