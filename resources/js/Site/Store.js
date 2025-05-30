import { createStore } from 'vuex'

// Import Modules
import HomeModule from '@site/Store/HomeModule'
import MarcasModule from '@site/Store/MarcasModule';
import CategoriasModule from '@site/Store/CategoriasModule';
import ProductosModule from '@site/Store/ProductosModule';
import NovedadesModule from '@site/Store/NovedadesModules';
import NosotrosModule from '@site/Store/NosotrosModule';
import CapacitacionesModule from '@site/Store/CapacitacionesModule';
import ContactoModule from '@site/Store/ContactoModule';
import MetadatosModule from '@site/Store/MetadatosModule';
import PopUpModule from '@site/Store/PopUpModule';
// Create a new Store instance.
const store = createStore({
    modules: {
        HomeModule,
        MarcasModule,
        CategoriasModule,
        ProductosModule,
        NovedadesModule,
        NosotrosModule,
        CapacitacionesModule,
        ContactoModule,
        MetadatosModule,
        PopUpModule,
    }
});

export default store;
