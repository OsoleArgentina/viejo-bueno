import API_ADMIN from '@admin/API';

const ContactoModule = {
    state: {
        contacto: [],
    },

    getters: {
        contacto(state) {
            return state.contacto
        },
    },

    mutations: {
        set_contacto(state, contacto) {
            state.contacto = contacto
        },
    },

    actions: {
        get_contacto({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_contacto)
                    .then((res) => {
                        commit('set_contacto', res.data.records)
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

export default ContactoModule;
