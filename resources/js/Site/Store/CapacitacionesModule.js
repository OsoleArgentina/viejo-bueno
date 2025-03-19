import API_ADMIN from '@admin/API';

const CapacitacionesModule = {
    state: {
        capacitaciones: [],
    },

    getters: {
        capacitaciones(state) {
            return state.capacitaciones
        },
    },

    mutations: {
        set_capacitaciones(state, capacitaciones) {
            state.capacitaciones = capacitaciones
        },
    },

    actions: {
        get_capacitaciones({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_capacitaciones)
                    .then((res) => {
                        commit('set_capacitaciones', res.data.records)
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

export default CapacitacionesModule;
