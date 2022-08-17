import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import UIcomponents from "@/components/UI";

axios.defaults.withCredentials = true;
axios.defaults.credentials = "include"

const app = createApp(App)

app.use(store).use(router).mount('#app')

for (let component of UIcomponents) {
  app.component(component.name, component)
}
