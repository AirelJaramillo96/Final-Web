/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
import alvue from '@myshell/alvue';
import { ServerTable } from 'vue-tables-2';

import alv from '@myshell/alvue';
import Vue from 'vue';

Vue.use(alvue);
Vue.use(ServerTable);

Vue.component('index-device', require('./components/IndexDevice').default);
Vue.component('create-device', require('./components/CreateDevice').default);

import DevicesIndex from "./components/Devices/DevicesIndex";
import IndexDevice from "./components/IndexDevice";
import CreateDevice from "./components/CreateDevice";



Vue.prototype.route = window.route;
Vue.prototype.user = window.user;

Vue.mixin({
        methods: {
            $route: route,
        },
        data() {
            return {
                auth: window.user
            }
        }
    }
);


const app = new Vue({
    el: '#app',
    components:{
        DevicesIndex,
        IndexDevice,
        CreateDevice

    }
});
