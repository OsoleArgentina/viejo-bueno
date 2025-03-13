import API_ADMIN from '@admin/API';

const ProductosModule = {
    state: {
        productos: [],
        producto: null,
    },

    getters: {
        productos(state) {
            return state.productos
        },
        producto(state) {
            return state.producto
        },    
    },

    mutations: {
        set_productos(state, productos) {
            state.productos = productos
        },
        set_producto(state, producto) {
            state.producto = producto
        },
    },

    actions: {
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
        get_producto_by_id({ commit }, producto_id) {
            return new Promise((resolve, reject) => {
                axios
                    .get(`${API_ADMIN.get_producto_by_id}/${producto_id}`)
                    .then((res) => {
                        commit('set_producto', res.data.records)
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
