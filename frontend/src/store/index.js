import { createStore } from 'vuex';
import authModule from '@/store/auth.module';
import imageModule from '@/store/image.module';

export default createStore({
  state: {
  },
  getters: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
    auth: authModule,
    image: imageModule
  }
})
