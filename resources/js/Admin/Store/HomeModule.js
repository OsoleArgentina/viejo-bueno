import API_ADMIN from '@admin/API';

const HomeModule = {
    state: {
        sliders: [],
    },

    getters: {
        sliders(state) {
            return state.sliders
        },
    },

    mutations: {
        set_sliders(state, sliders) {
            state.sliders = sliders
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
    },
}

export default HomeModule;
