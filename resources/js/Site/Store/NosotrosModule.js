import API_ADMIN from '@admin/API';

const NosotrosModule = {
    state: {
        nosotros: [],
        nosotros_elegirnos: [],
    },

    getters: {
        nosotros(state) {
            return state.nosotros
        },
        nosotros_elegirnos(state) {
            return state.nosotros_elegirnos
        },
    },

    mutations: {
        set_nosotros(state, nosotros) {
            state.nosotros = nosotros
        },
        set_nosotros_elegirnos(state, nosotros_elegirnos) {
            state.nosotros_elegirnos = nosotros_elegirnos
        },
    },

    actions: {
        get_nosotros({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_nosotros)
                    .then((res) => {
                        commit('set_nosotros', res.data.records)
                        resolve(res);
                    })
                    .catch((error) => {
                        console.log(error)
                        reject(error);
                    });
            });
        },
        get_nosotros_elegirnos({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_nosotros_elegirnos)
                    .then((res) => {
                        commit('set_nosotros_elegirnos', res.data.records)
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

export default NosotrosModule;
