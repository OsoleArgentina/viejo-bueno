import API_ADMIN from '@admin/API';

const MetadatosModule = {
    state: {
        metadatos: [],
    },

    getters: {
        metadatos(state) {
            return state.metadatos
        },
    },

    mutations: {
        set_metadatos(state, metadatos) {
            state.metadatos = metadatos
        },
    },

    actions: {
        get_metadatos({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_metadatos)
                    .then((res) => {
                        commit('set_metadatos', res.data.records)
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

export default MetadatosModule;
