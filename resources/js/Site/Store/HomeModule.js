// import { API } from '@app/API'

const HomeModule = {
    state: {
        data: [],
    },

    getters: {
        data(state) {
            return state.data
        },
    },

    mutations: {
        set_data(state, data) {
            state.data = data
        },
    },

    actions: {
        load_data({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get('https://rickandmortyapi.com/api/character/?page=19')
                    .then((res) => {
                        commit('set_data', res)
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
