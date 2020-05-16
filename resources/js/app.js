require('./bootstrap');

import Vue from 'vue';
import App from './App.vue';
import VueResource from 'vue-resource';
import VeeValidate from 'vee-validate';

//  main custom css file
import './../css/custom_bootstrap.min.css'

import BootstrapVue from 'bootstrap-vue'
// original bootstrap
// import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// all css libs on appland theme
import 'boxicons/css/boxicons.min.css'
import 'owl.carousel/dist/assets/owl.carousel.min.css'
import 'venobox/venobox/venobox.min.css'
import 'aos/dist/aos.css'
import '@icon/icofont/icofont.css'
import './../css/style.css'


// vue bootstrap datepicker
// https://www.npmjs.com/package/vue-bootstrap-datetimepicker
// http://eonasdan.github.io/bootstrap-datetimepicker/Options/#inline
// https://github.com/ankurk91/vue-bootstrap-datetimepicker
import datePicker from 'vue-bootstrap-datetimepicker';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

Vue.use(datePicker);

//https://www.npmjs.com/package/vue-loading-overlay
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
Vue.use(Loading);

// routing
import VueRouter from 'vue-router';
import Routes from './routes'

// font awesome
import {library} from '@fortawesome/fontawesome-svg-core';
import {faCoffee} from '@fortawesome/free-solid-svg-icons';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import {fab} from '@fortawesome/free-brands-svg-icons';

library.add(fab);
library.add(faCoffee);
Vue.component('fa', FontAwesomeIcon);

Vue.use(VeeValidate, {
    // validity: true
});

Vue.use(BootstrapVue);
Vue.use(VueResource);
Vue.use(VueRouter);

Vue.config.productionTip = false;
Vue.http.options.emulateJSON = true;

Vue.http.options.root = 'http://cretro.io';

// datetime converter
Vue.use(require('vue-moment'));

const router = new VueRouter({
    mode: 'history',
    routes: Routes
});


// https://scotch.io/tutorials/handling-authentication-in-vue-using-vuex
// handle unauthenticated request
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (window.Laravel.is_authenticated) {
            next();
            return;
        }
        next('/sign-in');
    } else {
        next();
    }
});

Vue.http.headers.common['X-CSRF-TOKEN'] =
    document.querySelector('meta[name="csrf-token"]').getAttribute('content');

Vue.prototype.$authStatus =
    document.querySelector('input[name="login-status"]').getAttribute('data-login-status');

// export const bus = new Vue();
const app = new Vue({
    el: '#app',
    render: h => h(App),
    router: router,
});
