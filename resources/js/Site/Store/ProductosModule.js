import API_ADMIN from '@admin/API';

const ProductosModule = {
    state: {
        productos_destacadas: [],
        productos: [],
        productos_relacionados: [],
    },

    getters: {
        productos_destacadas(state) {
            return state.productos_destacadas
        },
        productos(state) {
            return state.productos
        },
        productos_relacionados(state) {
            return state.productos_relacionados
        },
    },

    mutations: {
        set_productos_destacadas(state, productos_destacadas) {
            state.productos_destacadas = productos_destacadas
        },
        set_productos(state, productos) {
            state.productos = productos
        },
        set_productos_relacionados(state, productos_relacionados) {
            state.productos_relacionados = productos_relacionados
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
        get_productos_relacionados({ commit }, producto_id) {
            return new Promise((resolve, reject) => {
                axios
                    .get(`${API_ADMIN.get_productos_relacionados}/${producto_id}`)
                    .then((res) => {
                        commit('set_productos_relacionados', res.data.records)
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
