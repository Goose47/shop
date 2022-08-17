import SecureComponent from "@/components/SecureComponent";
import DashboardPage from "@/pages/DashboardPage";
import ProductListPage from "@/pages/Products/ProductListPage";
import ProductEditPage from "@/pages/Products/ProductEditPage";
import ProductViewPage from "@/pages/Products/ProductViewPage";
import ProductAddPage from "@/pages/Products/ProductAddPage";
import UserListPage from "@/pages/Users/UserListPage";
import UserEditPage from "@/pages/Users/UserEditPage";
import UserViewPage from "@/pages/Users/UserViewPage";
import UserAddPage from "@/pages/Users/UserAddPage";
import PublicComponent from "@/components/PublicComponent";
import RegisterPage from "@/pages/Auth/RegisterPage";
import LoginPage from "@/pages/Auth/LoginPage";
import NotFoundPage from "@/pages/NotFoundPage";


export default [
  {
    path: '',
    component: SecureComponent,
    meta: {requiresAuth: true},
    children: [
      {
        name: "dashboard",
        path: "/dashboard",
        component: DashboardPage
      },
      {
        name: "products.list",
        path: "/products",
        component: ProductListPage
      },
      {
        name: "products.edit",
        path: "/products/:id/edit",
        component: ProductEditPage
      },
      {
        name: "products.view",
        path: "/products/:id",
        component: ProductViewPage
      },
      {
        name: "products.add",
        path: "products/create",
        component: ProductAddPage
      },
      {
        name: "users.list",
        path: "/users",
        component: UserListPage
      },
      {
        name: "users.edit",
        path: "/users/:id/edit",
        component: UserEditPage
      },
      {
        name: "users.view",
        path: "/users/:id",
        component: UserViewPage
      },
      {
        name: "users.add",
        path: "/users/create",
        component: UserAddPage
      }
    ]
  },
  {
    path: '',
    component: PublicComponent,
    meta: {blockedForAuthenticated: true},
    children: [
      // {
      //   name: "register",
      //   path: "/register",
      //   component: RegisterPage
      // },
      {
        name: "login",
        path: "/login",
        component: LoginPage
      }
    ]
  },
  {
    name: '404',
    path: '/:catchAll(.*)',
    component: NotFoundPage
  }
]