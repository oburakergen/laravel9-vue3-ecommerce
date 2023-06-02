import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import vuetify from './plugins/vuetify'
import infiniteScroll from 'vue-infinite-scroll';


const app = createApp(App).use(router).use(store).use(vuetify).use(infiniteScroll).mount("#app");