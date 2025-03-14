import { createStore } from 'vuex'

// Import Modules
import AuthModule from '@admin/Store/AuthModule';
import HomeModule from '@admin/Store/HomeModule';
import NosotrosModule from '@admin/Store/NosotrosModule';
import CategoriaModule from '@admin/Store/CategoriaModule';
import SubcategoriaModule from '@admin/Store/SubcategoriaModule';
import ProductosModule from '@admin/Store/ProductosModule';
import MarcasModule from '@admin/Store/MarcasModule';
import NovedadesModule from '@admin/Store/NovedadesModule';
import CapacitacionesModule from '@admin/Store/CapacitacionesModule';
import ContactoModule from '@admin/Store/ContactoModule';
import MetadatosModule from './Store/MetadatosModule';

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
        NovedadesModule,
        CapacitacionesModule,
        ContactoModule,
        MetadatosModule,
    }
});

export default store;
