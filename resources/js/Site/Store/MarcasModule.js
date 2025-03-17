import API_ADMIN from '@admin/API';

const MarcasModule = {
    state: {
        marcas_destacadas: [],
        marcas: [],
    },

    getters: {
        marcas_destacadas(state) {
            return state.marcas_destacadas
        },
        marcas(state) {
            return state.marcas
        },
    },

    mutations: {
        set_marcas_destacadas(state, marcas_destacadas) {
            state.marcas_destacadas = marcas_destacadas
        },
        set_marcas(state, marcas) {
            state.marcas = marcas
        },
    },

    actions: {
        get_marcas_destacadas({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_marcas_destacadas)
                    .then((res) => {
                        commit('set_marcas_destacadas', res.data.records)
                        resolve(res);
                    })
                    .catch((error) => {
                        console.log(error)
                        reject(error);
                    });
            });
        },
        get_marcas({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_marcas)
                    .then((res) => {
                        commit('set_marcas', res.data.records)
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

export default MarcasModule;
