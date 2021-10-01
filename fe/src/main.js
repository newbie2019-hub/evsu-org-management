import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import Toast from "vue-toastification";
import VueFileAgent from 'vue-file-agent';
import DatePicker from 'vue2-datepicker';
import 'vue-file-agent/dist/vue-file-agent.css';

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueFileAgent)
Vue.use(DatePicker)

import './assets/css/style.css'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import "vue-toastification/dist/index.css";
import 'bootstrap-icons/font/bootstrap-icons.css'
import vresponse from './assets/js/vresponse/index'
import 'vue2-datepicker/index.css';
Vue.config.productionTip = false

Vue.mixin(vresponse)

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.use(Toast, {
    position: "top-right",
    timeout: 3000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    showCloseButtonOnHover: false,
    hideProgressBar: true,
    closeButton: false,
    icon: true,
    rtl: false,
    maxToasts: 4,
    transition: "Vue-Toastification__fade",
    newestOnTop: true
});

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')