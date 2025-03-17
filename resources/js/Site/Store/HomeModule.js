import API_ADMIN from '@admin/API';

const HomeModule = {
    state: {
        sliders: [],
        home_nosotros: [],
    },

    getters: {
        sliders(state) {
            return state.sliders
        },
        home_nosotros(state) {
            return state.home_nosotros
        },
    },

    mutations: {
        set_sliders(state, sliders) {
            state.sliders = sliders
        },
        set_home_nosotros(state, home_nosotros) {
            state.home_nosotros = home_nosotros
        },
    },

    actions: {
        get_sliders({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_sliders)
                    .then((res) => {
                        commit('set_sliders', res.data.records)
                        resolve(res);
                    })
                    .catch((error) => {
                        console.log(error)
                        reject(error);
                    });
            });
        },
        get_home_nosotros({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_home_nosotros)
                    .then((res) => {
                        commit('set_home_nosotros', res.data.records)
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

export default HomeModule;
