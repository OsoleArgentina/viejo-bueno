import API_ADMIN from '@admin/API';

const NovedadesModule = {
    state: {
        novedades: [],
    },

    getters: {
        novedades(state) {
            return state.novedades
        },
    },

    mutations: {
        set_novedades(state, novedades) {
            state.novedades = novedades
        },
    },

    actions: {
        get_novedades({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_novedades)
                    .then((res) => {
                        commit('set_novedades', res.data.records)
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

export default NovedadesModule;
