import API_ADMIN from '@admin/API';

const CategoriasModule = {
    state: {
        categorias_destacadas: [],
        categorias: [],
    },

    getters: {
        categorias_destacadas(state) {
            return state.categorias_destacadas
        },
        categorias(state) {
            return state.categorias
        },
    },

    mutations: {
        set_categorias_destacadas(state, categorias_destacadas) {
            state.categorias_destacadas = categorias_destacadas
        },
        set_categorias(state, categorias) {
            state.categorias = categorias
        },
    },

    actions: {
        get_categorias_destacadas({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_categorias_destacadas)
                    .then((res) => {
                        commit('set_categorias_destacadas', res.data.records)
                        resolve(res);
                    })
                    .catch((error) => {
                        console.log(error)
                        reject(error);
                    });
            });
        },
        get_categorias({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_categorias)
                    .then((res) => {
                        commit('set_categorias', res.data.records)
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

export default CategoriasModule;
