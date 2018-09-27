

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('user-register', require('./components/User_Register.vue'));
Vue.component('users', require('./components/Users.vue'));

// Components of admin
const admin_dashboard = new Vue({
    el: '#admin_dashboard',
});

const user_register = new Vue({
    el: '#user_register',
});

const users = new Vue({
    el: '#users',
});



