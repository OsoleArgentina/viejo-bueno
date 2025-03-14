import API_ADMIN from '@admin/API';

const MarcasModule = {
    state: {
        marcas: [],
    },

    getters: {
        marcas(state) {
            return state.marcas
        },
    },

    mutations: {
        set_marcas(state, marcas) {
            state.marcas = marcas
        },
    },

    actions: {
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
