import API_ADMIN from '@admin/API';

const PopUpModule = {
    state: {
        popup: [],
    },

    getters: {
        popup(state) {
            return state.popup
        },
    },

    mutations: {
        set_popup(state, popup) {
            state.popup = popup
        },
    },

    actions: {
        get_popup({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_popup)
                    .then((res) => {
                        commit('set_popup', res.data.records)
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

export default PopUpModule;
