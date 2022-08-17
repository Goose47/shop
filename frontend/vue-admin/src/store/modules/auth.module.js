import authService from "@/services/auth.service";
import router from "@/router";

const authModule = {
    state: () => ({
        user: {
            id: 0,
            full_name: '',
            phone_number: '',
            email: '',
        }
    }),
    getters: {

    },
    mutations: {
        setUser(state, data) {
            state.user = {
                id: data.id,
                full_name: data.full_name,
                email: data.email,
                phone: data.phone
            }
        }
    },
    actions: {
        async login({ commit }, data) {
            const res = await authService.login(data)
            return !!(res && res.data);

        },
        async logout({ commit }) {
          const res = await authService.logout()

          if(res && res.data.success){
            commit('setUser', {
              id: 0,
              full_name: '',
              phone_number: '',
              email: '',
            })

            router.push({name: 'login'})
          }
        },
        async getUser({ commit }) {
            const res = await authService.user()

            if (res && res.data) {
                commit('setUser', res.data)
            }
        },
        async isLoggedIn({state, dispatch}) {
            if(state.user.id === 0) {
                await dispatch('getUser')
                if(state.user.id === 0) {
                    return false
                }
            }
            return true
        }
    },
    namespaced: true
}

export default authModule