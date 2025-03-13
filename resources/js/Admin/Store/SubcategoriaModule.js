import API_ADMIN from '@admin/API';

const SubcategoriaModule = {
    state: {
        subcategorias: [],
    },

    getters: {
        subcategorias(state) {
            return state.subcategorias
        },
    },

    mutations: {
        set_subcategorias(state, subcategorias) {
            state.subcategorias = subcategorias
        },
    },

    actions: {
        get_subcategorias({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_subcategorias)
                    .then((res) => {
                        commit('set_subcategorias', res.data.records)
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

export default SubcategoriaModule;
