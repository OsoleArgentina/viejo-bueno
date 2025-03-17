import API_ADMIN from '@admin/API';

const ProductosModule = {
    state: {
        productos_destacadas: [],
        productos: [],
    },

    getters: {
        productos_destacadas(state) {
            return state.productos_destacadas
        },
        productos(state) {
            return state.productos
        },
    },

    mutations: {
        set_productos_destacadas(state, productos_destacadas) {
            state.productos_destacadas = productos_destacadas
        },
        set_productos(state, productos) {
            state.productos = productos
        },
    },

    actions: {
        get_productos_destacadas({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_productos_destacadas)
                    .then((res) => {
                        commit('set_productos_destacadas', res.data.records)
                        resolve(res);
                    })
                    .catch((error) => {
                        console.log(error)
                        reject(error);
                    });
            });
        },
        get_productos({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_productos)
                    .then((res) => {
                        commit('set_productos', res.data.records)
                        resolve(res);
                    })
                    .catch((error) => {
                        console.log(error)
                        reject(error);
                    });
            });
        },
    },
}

export default ProductosModule;
