const AuthModule = {
    state: {
        admin: [],  
    },

    getters: {
        admin(state) {
            return state.admin;  
        },
    },

    mutations: {
        set_admin(state, data) {
            state.admin = data;  
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
    },
}

export default AuthModule;
