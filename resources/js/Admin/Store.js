import { createStore } from 'vuex'

// Import Modules
import AuthModule from '@admin/Store/AuthModule';
import HomeModule from '@admin/Store/HomeModule';
import NosotrosModule from '@admin/Store/NosotrosModule';
import CategoriaModule from '@admin/Store/CategoriaModule';
import SubcategoriaModule from '@admin/Store/SubcategoriaModule';
import ProductosModule from '@admin/Store/ProductosModule';
import MarcasModule from './Store/MarcasModule';
// Create a new Store instance.
const store = createStore({
    modules: {
        AuthModule,
        HomeModule,
        NosotrosModule,
        CategoriaModule,
        SubcategoriaModule,
        ProductosModule,
        MarcasModule,
    }
});

export default store;
