import { createRouter, createWebHistory } from 'vue-router'
import store from '@/store/index';
import routes from "@/router/routes.js";

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach(async (to, from) => {
  let isLoggedIn = await store.dispatch('auth/isLoggedIn')
  if(to.meta.requiresAuth && !isLoggedIn) {
    return {
      name: 'login'
    }
  }
  if(to.meta.blockedForAuthenticated && isLoggedIn) {
    return {
      name: 'dashboard'
    }
  }
})

export default router
