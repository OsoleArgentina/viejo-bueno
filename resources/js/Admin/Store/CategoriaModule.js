import API_ADMIN from '@admin/API';

const CategoriaModule = {
    state: {
        categorias: [],
    },

    getters: {
        categorias(state) {
            return state.categorias
        },
    },

    mutations: {
        set_categorias(state, categorias) {
            state.categorias = categorias
        },
    },

    actions: {
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

export default CategoriaModule;
