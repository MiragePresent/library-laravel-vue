import Vue from 'vue';
import Vuetify from 'vuetify';
import Notifications from 'vue-notification';
import 'material-design-icons-iconfont/dist/material-design-icons.css'

// Store
import store from './store';


// Components
import BooksTable from './components/BooksTable';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = Vue;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(Vuetify);
Vue.use(Notifications);

const app = new Vue({
    store,
    components: {
        BooksTable,
    }
});

window.onload = () => {
    app.$mount('#app');
};
