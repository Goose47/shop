import SecureComponent from "@/components/SecureComponent";
import Dashboard from "@/pages/Dashboard";
import ProductList from "@/pages/Products/ProductList";
import ProductEdit from "@/pages/Products/ProductEdit";
import ProductView from "@/pages/Products/ProductView";
import ProductAdd from "@/pages/Products/ProductAdd";
import UserList from "@/pages/Users/UserList";
import UserEdit from "@/pages/Users/UserEdit";
import UserView from "@/pages/Users/UserView";
import UserAdd from "@/pages/Users/UserAdd";
import PublicComponent from "@/components/PublicComponent";
import Register from "@/pages/Auth/Register";
import Login from "@/pages/Auth/Login";
import TestComponent from "@/pages/Test"


export default [
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
        name: "products.add",
        path: "products/create",
        component: ProductAdd
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
      {
        name: "users.add",
        path: "/users/create",
        component: UserAdd
      },
      {
        name: "test",
        path: "/test",
        component: TestComponent
      }
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