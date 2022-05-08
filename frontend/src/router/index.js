import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from "@/pages/Dashboard";
import ProductList from "@/pages/Products/ProductList";
import UserList from "@/pages/Users/UserList";
import Register from "@/pages/Auth/Register";
import Login from "@/pages/Auth/Login";
import SecureComponent from "@/components/SecureComponent";
import PublicComponent from "@/components/PublicComponent";
import store from '@/store/index';
import ProductEdit from "@/pages/Products/ProductEdit";
import ProductView from "@/pages/Products/ProductView";
import UserEdit from "@/pages/Users/UserEdit";
import UserView from "@/pages/Users/UserView";

const routes = [
  {
    path: '',
    component: SecureComponent,
    meta: {requiresAuth: true},
    children: [
      {
        name: "dashboard",
        path: "/dashboard",
        component: Dashboard
      },
      {
        name: "products.index",
        path: "/products",
        component: ProductList
      },
      {
        name: "products.edit",
        path: "/products/:id/edit",
        component: ProductEdit
      },
      {
        name: "products.view",
        path: "/products/:id",
        component: ProductView
      },
      {
        name: "users.index",
        path: "/users",
        component: UserList
      },
      {
        name: "users.edit",
        path: "/users/:id/edit",
        component: UserEdit
      },
      {
        name: "users.view",
        path: "/users/:id",
        component: UserView
      },
    ]
  },
  {
    path: '',
    component: PublicComponent,
    meta: {blockedForAuthenticated: true},
    children: [
      {
        name: "register",
        path: "/register",
        component: Register
      },
      {
        name: "login",
        path: "/login",
        component: Login
      }
    ]
  }
]

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
