require('./bootstrap');
// Require Vue
import Vue from 'vue'
import 'vuetify/dist/vuetify.min.css'
window.Vue = require('vue').default;

import '@mdi/font/css/materialdesignicons.css'


import vuetify from './vuetify';
Vue.use(vuetify);

import router from './router';
Vue.use(router);

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);

import VueToastr from "vue-toastr";
Vue.use(VueToastr);


// REGISTRO DE COMPONENTES
Vue.component('content-component', require('./components/ContentComponent.vue').default);

const app = new Vue({
    el: '#app',
    vuetify,
    router,
});
