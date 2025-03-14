import API_ADMIN from '@admin/API';

const AuthModule = {
    state: {
        admin: [],  
        all_admins: []
    },

    getters: {
        admin(state) {
            return state.admin;  
        },
        all_admins(state) {
            return state.all_admins;  
        },
    },

    mutations: {
        set_admin(state, data) {
            state.admin = data;  
        },
        set_all_admins(state, data) {
            state.all_admins = data;  
        },
    },

    actions: {
        load_user_data({ commit }) {
            const user_data = document.querySelector('meta[name="user-data"]').getAttribute('content');
            
            if (user_data) {
                const parsed_data = JSON.parse(user_data);  
                commit('set_admin', parsed_data);  
            }
        },
        get_admins({commit}){
            return new Promise((resolve, reject) => {
                axios
                    .get(API_ADMIN.get_admins)
                    .then((res) => {
                        commit('set_all_admins', res.data.records)
                        resolve(res);
                    })
                    .catch((error) => {
                        console.log(error)
                        reject(error);
                    });
            });
        }
    },
}

export default AuthModule;
