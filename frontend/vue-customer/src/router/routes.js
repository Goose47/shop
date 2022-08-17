import NotFoundPage from "@/pages/NotFoundPage";
import PublicComponent from "@/components/PublicComponent";
import UnauthenticatedComponent from "@/components/UnauthenticatedComponent";
import RegisterPage from "@/pages/Auth/RegisterPage";
import LoginPage from "@/pages/Auth/LoginPage";
import ProductListPage from "@/pages/products/ProductListPage";
import PassThroughComponent from "@/components/PassThroughComponent"
import DashboardPage from "@/pages/DashboardPage";
import CartPage from "@/pages/CartPage";
import AccountPage from "@/pages/AccountPage";

export default [
  {
    path: '',
    component: PublicComponent,
    children: [
      {
        path: '',
        component: PassThroughComponent,
        children: [
          // Public routes
          {
            name: 'products.list',
            path: '',
            component: ProductListPage
          },
        ]
      },
      {
        path: '',
        component: PassThroughComponent,
        meta: {requiresAuth: true},
        children: [
          //secured routes
          {
            name: 'cart',
            path: '/cart',
            component: CartPage
          },
          {
            name: 'account',
            path: '/me',
            component: AccountPage
          },
        ]
      }
    ]
  },
  {
    path: '',
    component: UnauthenticatedComponent,
    meta: {blockedForAuthenticated: true},
    children: [
      {
        name: "register",
        path: "/register",
        component: RegisterPage
      },
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